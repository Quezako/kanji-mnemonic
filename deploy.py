#!/usr/bin/env python3
"""
Kanji-Back Deployment Script
Usage: python deploy.py <environment> <remote-host> <remote-user> <remote-path>
Example: python deploy.py production server.com deploy /var/www/kanji-back
"""

import os
import sys
import subprocess
import shutil
import tempfile
import datetime
import tarfile

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

def check_requirements():
    """Check if required tools are available"""
    required_tools = {
        'git': 'Git version control',
        'ssh': 'SSH client',
        'scp': 'SCP file transfer',
        'composer': 'PHP Composer',
    }
    
    missing = []
    for tool, desc in required_tools.items():
        if shutil.which(tool) is None:
            missing.append(f"{tool} ({desc})")
    
    if missing:
        print_error("Required tools not found:")
        for tool in missing:
            print(f"  - {tool}")
        return False
    
    print_success("All required tools found")
    return True

def check_git_status():
    """Ensure git working directory is clean"""
    try:
        result = subprocess.run(['git', 'diff-index', '--quiet', 'HEAD', '--'], 
                              capture_output=True)
        if result.returncode != 0:
            print_error("Uncommitted changes detected")
            subprocess.run(['git', 'status'])
            return False
        print_success("Git status clean")
        return True
    except Exception as e:
        print_error(f"Git check failed: {e}")
        return False

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
    
    print_success(f"Archive created: {archive_path}")
    return archive_path, archive_name

def upload_archive(archive_path, archive_name, remote_user, remote_host):
    """Upload archive to remote server"""
    print_info(f"Uploading {archive_name} to {remote_user}@{remote_host}")
    
    try:
        cmd = ['scp', archive_path, f"{remote_user}@{remote_host}:/tmp/{archive_name}"]
        subprocess.run(cmd, check=True)
        print_success("Upload complete")
        return True
    except subprocess.CalledProcessError as e:
        print_error(f"Upload failed: {e}")
        return False

def deploy_on_server(remote_user, remote_host, remote_path, archive_name):
    """Execute deployment commands on remote server"""
    print_info("Deploying on remote server...")
    
    deploy_commands = f"""
set -e

ARCHIVE_NAME="{archive_name}"
REMOTE_PATH="{remote_path}"
ARCHIVE_LOCATION="/tmp/$ARCHIVE_NAME"

echo "Step 1: Creating backup..."
if [ -d "$REMOTE_PATH" ]; then
    BACKUP_PATH="${{REMOTE_PATH}}.backup.$(date +%Y%m%d-%H%M%S)"
    cp -r "$REMOTE_PATH" "$BACKUP_PATH"
    echo "Backup created at: $BACKUP_PATH"
else
    mkdir -p "$REMOTE_PATH"
fi

echo "Step 2: Extracting archive..."
cd "$REMOTE_PATH"
tar -xzf "$ARCHIVE_LOCATION"

echo "Step 3: Installing PHP dependencies (production only)..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Step 4: Setting permissions..."
chmod -R 755 ./bin 2>/dev/null || true
chmod -R 755 ./webroot 2>/dev/null || true
chmod -R 775 ./tmp 2>/dev/null || true
chmod -R 775 ./logs 2>/dev/null || true

echo "Step 5: Clearing cache..."
rm -rf ./tmp/cache/* 2>/dev/null || true
rm -rf ./tmp/logs/* 2>/dev/null || true

echo "Step 6: Cleaning up archive..."
rm -f "$ARCHIVE_LOCATION"

echo "Deployment complete!"
"""
    
    try:
        ssh_cmd = ['ssh', f"{remote_user}@{remote_host}", deploy_commands]
        subprocess.run(ssh_cmd, check=True)
        print_success("Server deployment complete")
        return True
    except subprocess.CalledProcessError as e:
        print_error(f"Remote deployment failed: {e}")
        return False

def main():
    if len(sys.argv) < 5:
        print_error("Invalid arguments")
        print(f"Usage: {sys.argv[0]} <environment> <remote-host> <remote-user> <remote-path>")
        print(f"Example: {sys.argv[0]} production server.com deploy /var/www/kanji-back")
        sys.exit(1)
    
    environment = sys.argv[1]
    remote_host = sys.argv[2]
    remote_user = sys.argv[3]
    remote_path = sys.argv[4]
    
    print_header("Kanji-Back Deployment Script")
    print(f"Environment: {environment}")
    print(f"Remote Host: {remote_host}")
    print(f"Remote User: {remote_user}")
    print(f"Remote Path: {remote_path}\n")
    
    # Get project root
    project_root = os.path.dirname(os.path.abspath(__file__))
    
    # Change to project root
    os.chdir(project_root)
    
    # Step 1: Check requirements
    print_info("[1/5] Checking requirements...")
    if not check_requirements():
        sys.exit(1)
    print()
    
    # Step 2: Check git status
    print_info("[2/5] Checking git status...")
    if not check_git_status():
        sys.exit(1)
    print()
    
    # Step 3: Create archive
    print_info("[3/5] Creating deployment archive...")
    temp_dir = tempfile.mkdtemp()
    try:
        archive_path, archive_name = create_archive(project_root, temp_dir)
        print()
        
        # Step 4: Upload archive
        print_info("[4/5] Uploading to server...")
        if not upload_archive(archive_path, archive_name, remote_user, remote_host):
            sys.exit(1)
        print()
        
        # Step 5: Deploy on server
        print_info("[5/5] Deploying on server...")
        if not deploy_on_server(remote_user, remote_host, remote_path, archive_name):
            sys.exit(1)
        print()
        
    finally:
        # Cleanup
        print_info("Cleaning up temporary files...")
        shutil.rmtree(temp_dir, ignore_errors=True)
        print_success("Cleanup complete\n")
    
    print_header("Deployment Successful!")
    print_success(f"Application deployed to: {remote_path}")

if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        print("\nDeployment cancelled by user")
        sys.exit(1)
    except Exception as e:
        print_error(f"Unexpected error: {e}")
        sys.exit(1)
