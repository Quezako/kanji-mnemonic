# Kanji-Back Deployment Guide

## Deployment Options

### Option 1: SSH Deployment (Linux/Mac servers with SSH)
```bash
chmod +x deploy.sh
./deploy.sh production server.com username /var/www/kanji-back
```

### Option 2: FTP Deployment (Windows/Shared hosting with FTP only)

#### Setup:
1. Create configuration file:
```bash
python deploy_ftp.py deploy_config.json
```

2. Edit `deploy_config.json` with your FTP credentials:
```json
{
  "ftp_host": "ftp.your-domain.com",
  "ftp_user": "your_ftp_username",
  "ftp_pass": "your_ftp_password",
  "ftp_path": "/public_html/kanji-back",
  "environment": "production"
}
```

3. Run deployment:
```bash
python deploy_ftp.py deploy_config.json
```

#### After FTP Upload:

Since FTP can't execute commands, you need to do these steps manually:

**Via SSH/Shell Access (if available):**
```bash
cd /public_html/kanji-back
tar -xzf kanji-back-YYYYMMDD-HHMMSS.tar.gz
composer install --no-dev --optimize-autoloader
chmod -R 775 tmp/ logs/
rm -rf tmp/cache/*
rm kanji-back-YYYYMMDD-HHMMSS.tar.gz
```

**Via Web Interface/Control Panel:**
- Use file manager to extract the `.tar.gz` file
- Or upload a simple extraction PHP script:

```php
<?php
// extract.php - Upload and access via browser
// WARNING: Delete this file after use for security!

if ($_POST['extract'] ?? false) {
    $archive = '/path/to/kanji-back-YYYYMMDD-HHMMSS.tar.gz';
    
    if (function_exists('shell_exec')) {
        shell_exec("cd " . dirname($archive) . " && tar -xzf " . basename($archive));
        echo "✓ Extracted successfully";
    } else {
        echo "✗ shell_exec not available";
    }
} else {
    ?>
    <form method="post">
        <button type="submit" name="extract" value="1">Extract Archive</button>
    </form>
    <?php
}
?>
```

## What Gets Deployed

**Included:**
- ✓ All source code (`src/`)
- ✓ Configuration files (`config/`)
- ✓ Public files (`webroot/`)
- ✓ Application files (`bin/`, `index.php`)
- ✓ composer.json & composer.lock

**Excluded (to save space):**
- ✗ vendor/ (re-installed on server with `composer install --no-dev`)
- ✗ .git (version control)
- ✗ tests/ (test files)
- ✗ tmp/cache/* (temporary cache)
- ✗ tmp/logs/* (log files)
- ✗ node_modules (not used)

## Expected Deployment Size

- Local development: ~250-300 MB (with vendor/)
- FTP archive: ~15-25 MB (without vendor/)
- After extraction & composer: ~100-150 MB

## Post-Deployment Checklist

After uploading and extracting on your server:

- [ ] Run `composer install --no-dev --optimize-autoloader`
- [ ] Check file permissions on `tmp/` and `logs/` (should be writable)
- [ ] Verify PHP version is 8.0+ (check phpinfo.php)
- [ ] Test API endpoint: `http://your-domain/kanji-back/chmn?hanzi=%E5%92%B2`
- [ ] Check application logs for errors: `tmp/logs/error.log`
- [ ] Set up database connection if needed
- [ ] Delete deployment scripts for security

## Troubleshooting

### "Permission denied" errors
The FTP user needs write access to these directories:
- `tmp/` - for cache and temporary files
- `logs/` - for error logs

Contact your hosting provider to set proper permissions.

### "Command not found: composer"
Some hosting providers don't have Composer available. Options:
1. Install dependencies locally, upload vendor/ folder (bigger file)
2. Contact hosting provider to install Composer
3. Use pre-built optimized autoloader

### Blank page or 500 error
1. Check `tmp/logs/error.log` for detailed error messages
2. Verify PHP version: `<?php phpinfo(); ?>`
3. Check required PHP extensions: intl, pdo_mysql, etc.
4. Verify database credentials in `config/database.php`

### JSON API returns HTML error page
- Check file permissions
- Verify `.htaccess` is in webroot/
- Ensure mod_rewrite is enabled on Apache
- Check browser console for actual error message

## Security Notes

⚠️ **Important:**
1. Don't commit `deploy_config.json` with real credentials
2. Delete extraction scripts after deployment
3. Keep `config/.env.local` out of version control
4. Regularly update dependencies: `composer update --no-dev`
5. Check logs regularly for suspicious activity

## Environment-Specific Configuration

For different environments (dev, staging, production), create separate config files:

```bash
deploy_ftp_production.json
deploy_ftp_staging.json
deploy_ftp_dev.json
```

Then deploy with:
```bash
python deploy_ftp.py deploy_ftp_production.json
```
