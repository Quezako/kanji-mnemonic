#!/usr/bin/env python3
"""
Kanji-Back Deployment Script (FTP Version)
Usage: python deploy_ftp.py <config-file>
Example: python deploy_ftp.py deploy_config.json
"""

import os
import sys
import json
import ftplib
import shutil
import tempfile
import datetime
import tarfile
from pathlib import Path

class Colors:
    RED = '\033[0;31m'
    GREEN = '\033[0;32m'
    YELLOW = '\033[1;33m'
    BLUE = '\033[0;34m'
    NC = '\033[0m'

def print_header(msg):
    print(f"{Colors.YELLOW}{'='*50}{Colors.NC}")
    print(f"{Colors.YELLOW}{msg}{Colors.NC}")
    print(f"{Colors.YELLOW}{'='*50}{Colors.NC}")

def print_success(msg):
    print(f"{Colors.GREEN}✓ {msg}{Colors.NC}")

def print_error(msg):
    print(f"{Colors.RED}✗ {msg}{Colors.NC}")

def print_info(msg):
    print(f"{Colors.BLUE}ℹ {msg}{Colors.NC}")

def load_config(config_file):
    """Load FTP configuration from JSON file"""
    if not os.path.exists(config_file):
        print_error(f"Config file not found: {config_file}")
        return None
    
    try:
        with open(config_file, 'r') as f:
            config = json.load(f)
        
        # Validate required fields
        required = ['ftp_host', 'ftp_user', 'ftp_pass', 'ftp_path']
        missing = [k for k in required if k not in config]
        
        if missing:
            print_error(f"Missing config fields: {', '.join(missing)}")
            return None
        
        print_success(f"Config loaded from: {config_file}")
        return config
    except json.JSONDecodeError as e:
        print_error(f"Invalid JSON in config file: {e}")
        return None

def create_archive(project_root, temp_dir):
    """Create deployment archive excluding unnecessary files"""
    exclude_patterns = {
        'vendor/',
        '.git',
        '.gitignore',
        'node_modules',
        'tests/',
        '.env.local',
        '.env.example',
        '*.log',
        'tmp/cache/*',
        'tmp/logs/*',
        '.DS_Store',
        'deploy.sh',
        'deploy.py',
        'deploy_ftp.py',
        'deploy_config.json',
        '__pycache__',
        '*.pyc',
        '.vscode',
        '.idea',
    }
    
    timestamp = datetime.datetime.now().strftime('%Y%m%d-%H%M%S')
    archive_name = f"kanji-back-{timestamp}.tar.gz"
    archive_path = os.path.join(temp_dir, archive_name)
    
    print_info(f"Creating archive: {archive_name}")
    
    with tarfile.open(archive_path, "w:gz") as tar:
        for root, dirs, files in os.walk(project_root):
            # Modify dirs in-place to skip excluded directories
            dirs[:] = [d for d in dirs if d not in exclude_patterns and 
                      not any(os.path.relpath(os.path.join(root, d), project_root).startswith(ep.rstrip('/*')) 
                             for ep in exclude_patterns)]
            
            for file in files:
                file_path = os.path.join(root, file)
                arcname = os.path.relpath(file_path, project_root)
                
                # Skip excluded files
                if any(arcname.startswith(ep.rstrip('/*')) or arcname.endswith(ep.lstrip('*')) 
                      for ep in exclude_patterns):
                    continue
                
                try:
                    tar.add(file_path, arcname=arcname)
                except Exception as e:
                    print_error(f"Failed to add {file}: {e}")
    
    file_size_mb = os.path.getsize(archive_path) / (1024 * 1024)
    print_success(f"Archive created: {archive_path} ({file_size_mb:.2f} MB)")
    return archive_path, archive_name

def upload_ftp(archive_path, archive_name, config):
    """Upload archive via FTP"""
    print_info(f"Connecting to FTP: {config['ftp_host']}")
    
    try:
        # Connect to FTP
        ftp = ftplib.FTP(config['ftp_host'])
        ftp.login(config['ftp_user'], config['ftp_pass'])
        print_success(f"Connected to FTP server")
        
        # Passive mode (sometimes needed for certain hosting)
        ftp.set_pasv(True)
        
        # Navigate to remote path
        print_info(f"Navigating to: {config['ftp_path']}")
        try:
            ftp.cwd(config['ftp_path'])
        except ftplib.all_errors as e:
            print_error(f"Cannot navigate to {config['ftp_path']}: {e}")
            ftp.quit()
            return False
        
        # Upload file
        print_info(f"Uploading {archive_name}...")
        file_size_mb = os.path.getsize(archive_path) / (1024 * 1024)
        print(f"  File size: {file_size_mb:.2f} MB")
        
        with open(archive_path, 'rb') as f:
            ftp.storbinary(f'STOR {archive_name}', f)
        
        print_success(f"Upload complete: {archive_name}")
        
        # Create deployment info file
        info_content = f"""Deployment Info
================
Date: {datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')}
Archive: {archive_name}
Instructions:
1. SSH to server or use file manager
2. Extract: tar -xzf {archive_name}
3. Delete archive: rm {archive_name}
4. Run: composer install --no-dev --optimize-autoloader
5. Set permissions: chmod -R 775 tmp/ logs/
"""
        info_filename = f"DEPLOY_INFO.txt"
        ftp.storbinary(f'STOR {info_filename}', 
                      __import__('io').BytesIO(info_content.encode()))
        print_success(f"Deployment info created: {info_filename}")
        
        # List files on server
        print_info("Files on server:")
        ftp.retrlines('LIST', lambda x: print(f"  {x}"))
        
        ftp.quit()
        return True
        
    except ftplib.all_errors as e:
        print_error(f"FTP error: {e}")
        return False
    except Exception as e:
        print_error(f"Unexpected error: {e}")
        return False

def create_sample_config():
    """Create a sample configuration file"""
    sample_config = {
        "ftp_host": "ftp.example.com",
        "ftp_user": "your_ftp_username",
        "ftp_pass": "your_ftp_password",
        "ftp_path": "/public_html/kanji-back",
        "environment": "production"
    }
    
    config_file = "deploy_config.json"
    with open(config_file, 'w') as f:
        json.dump(sample_config, f, indent=2)
    
    print_success(f"Sample config created: {config_file}")
    print("Please edit the file with your FTP credentials")
    return False

def main():
    print_header("Kanji-Back FTP Deployment Script")
    
    # Check for config file argument
    if len(sys.argv) < 2:
        print_error("No config file provided")
        print(f"Usage: {sys.argv[0]} <config-file>")
        print(f"Example: {sys.argv[0]} deploy_config.json\n")
        
        print_info("Creating sample configuration file...")
        create_sample_config()
        print("\nPlease edit deploy_config.json and run again")
        sys.exit(1)
    
    config_file = sys.argv[1]
    
    # Load configuration
    config = load_config(config_file)
    if not config:
        sys.exit(1)
    print()
    
    # Get project root
    project_root = os.path.dirname(os.path.abspath(__file__))
    os.chdir(project_root)
    
    print_info(f"FTP Host: {config['ftp_host']}")
    print_info(f"FTP Path: {config['ftp_path']}")
    print_info(f"Environment: {config.get('environment', 'production')}\n")
    
    # Confirm before proceeding
    response = input(f"{Colors.YELLOW}Continue with deployment? (yes/no): {Colors.NC}")
    if response.lower() != 'yes':
        print("Deployment cancelled")
        sys.exit(0)
    print()
    
    # Step 1: Create archive
    print_info("[1/3] Creating deployment archive...")
    temp_dir = tempfile.mkdtemp()
    try:
        archive_path, archive_name = create_archive(project_root, temp_dir)
        print()
        
        # Step 2: Upload via FTP
        print_info("[2/3] Uploading via FTP...")
        if not upload_ftp(archive_path, archive_name, config):
            sys.exit(1)
        print()
        
        # Step 3: Print instructions
        print_info("[3/3] Deployment instructions...\n")
        
        instructions = f"""
{Colors.GREEN}{'='*60}{Colors.NC}
{Colors.GREEN}Upload Complete!{Colors.NC}
{Colors.GREEN}{'='*60}{Colors.NC}

Archive uploaded: {archive_name}
Location: {config['ftp_path']}/{archive_name}

{Colors.YELLOW}Manual Steps Required:{Colors.NC}

1. {Colors.BLUE}Connect via FTP or file manager{Colors.NC}
   Navigate to: {config['ftp_path']}

2. {Colors.BLUE}SSH/Shell access (if available){Colors.NC}
   cd {config['ftp_path']}
   
   Extract archive:
   tar -xzf {archive_name}
   
   Install dependencies:
   composer install --no-dev --optimize-autoloader
   
   Set permissions:
   chmod -R 775 tmp/
   chmod -R 775 logs/
   
   Clear cache:
   rm -rf tmp/cache/*
   
   Delete archive (optional):
   rm {archive_name}

3. {Colors.BLUE}Via HTTP (if your host supports it){Colors.NC}
   Access: http://your-domain/kanji-back/
   Should see JSON API responses

{Colors.YELLOW}Troubleshooting:{Colors.NC}
- If permissions error: FTP user needs write access to tmp/ and logs/
- If blank page: Check PHP version (needs 8.0+) and extensions
- Check error logs: logs/error.log

{Colors.YELLOW}Backup:{Colors.NC}
Old deployment backed up as: kanji-back.backup.TIMESTAMP
"""
        print(instructions)
        
    finally:
        # Cleanup
        print_info("Cleaning up temporary files...")
        shutil.rmtree(temp_dir, ignore_errors=True)
        print_success("Cleanup complete\n")
    
    print_header("FTP Upload Successful!")

if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print("\nDeployment cancelled by user")
        sys.exit(1)
    except Exception as e:
        print_error(f"Unexpected error: {e}")
        import traceback
        traceback.print_exc()
        sys.exit(1)
