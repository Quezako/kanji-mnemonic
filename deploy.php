<?php
/**
 * Kanji-Back Deployment Helper (PHP Version)
 * Upload this file to your server and access via browser
 * WARNING: Delete this file after deployment for security!
 */

set_time_limit(300); // 5 minutes timeout
ini_set('memory_limit', '256M');

class DeploymentHelper {
    private $uploadDir;
    private $logFile;
    
    public function __construct() {
        $this->uploadDir = __DIR__;
        $this->logFile = $this->uploadDir . '/deployment.log';
    }
    
    public function log($message) {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] $message\n";
        echo "<p>$message</p>";
        file_put_contents($this->logFile, $logEntry, FILE_APPEND);
    }
    
    public function extractArchive() {
        $files = glob($this->uploadDir . '/kanji-back-*.tar.gz');
        
        if (empty($files)) {
            $this->log("❌ No archive found. Upload kanji-back-YYYYMMDD-HHMMSS.tar.gz first");
            return false;
        }
        
        $archive = $files[0];
        $archiveName = basename($archive);
        
        $this->log("📦 Found archive: $archiveName");
        $this->log("⏳ Extracting...");
        
        // Check if tar/gzip is available
        if (!function_exists('shell_exec')) {
            $this->log("❌ shell_exec not available on this server");
            return $this->extractWithPhar($archive);
        }
        
        try {
            $output = shell_exec("cd " . escapeshellarg($this->uploadDir) . " && tar -xzf " . escapeshellarg($archive) . " 2>&1");
            
            if (file_exists($this->uploadDir . '/src')) {
                $this->log("✓ Archive extracted successfully");
                return true;
            } else {
                $this->log("❌ Extraction failed: " . ($output ?: "Unknown error"));
                return false;
            }
        } catch (Exception $e) {
            $this->log("❌ Error: " . $e->getMessage());
            return false;
        }
    }
    
    private function extractWithPhar($archive) {
        try {
            $this->log("📦 Using PHP Phar extractor...");
            $phar = new PharData($archive);
            $phar->extractTo($this->uploadDir);
            
            if (file_exists($this->uploadDir . '/src')) {
                $this->log("✓ Archive extracted with Phar");
                return true;
            }
        } catch (Exception $e) {
            $this->log("❌ Phar extraction failed: " . $e->getMessage());
        }
        return false;
    }
    
    public function runComposer() {
        $this->log("📦 Running Composer install...");
        
        if (!file_exists($this->uploadDir . '/composer.json')) {
            $this->log("❌ composer.json not found");
            return false;
        }
        
        // Check if composer exists
        $composerPath = trim(shell_exec('which composer 2>/dev/null') ?: shell_exec('where composer 2>nul'));
        
        if (empty($composerPath) && !file_exists('/usr/local/bin/composer')) {
            $this->log("⚠️  Composer not found. Trying with php...");
            $composerPath = 'php composer.phar';
        } else {
            $composerPath = $composerPath ?: 'composer';
        }
        
        try {
            $output = shell_exec("cd " . escapeshellarg($this->uploadDir) . " && " . $composerPath . " install --no-dev --optimize-autoloader 2>&1");
            
            if (strpos($output, 'Successfully installed') !== false || 
                strpos($output, 'Package operations') !== false ||
                strpos($output, 'No packages') !== false) {
                $this->log("✓ Composer install complete");
                return true;
            } else {
                $this->log("⚠️  Composer output: " . substr($output, 0, 500));
                return true; // Continue anyway
            }
        } catch (Exception $e) {
            $this->log("⚠️  Composer error (non-fatal): " . $e->getMessage());
            return true; // Continue anyway
        }
    }
    
    public function setPermissions() {
        $this->log("🔐 Setting permissions...");
        
        $dirs = [
            'tmp',
            'tmp/cache',
            'tmp/logs',
            'logs'
        ];
        
        foreach ($dirs as $dir) {
            $path = $this->uploadDir . '/' . $dir;
            if (is_dir($path)) {
                if (@chmod($path, 0775)) {
                    $this->log("✓ Permissions set for: $dir");
                } else {
                    $this->log("⚠️  Could not set permissions for: $dir (may need manual FTP fix)");
                }
            }
        }
        
        return true;
    }
    
    public function clearCache() {
        $this->log("🧹 Clearing cache...");
        
        $cacheDirs = [
            'tmp/cache',
            'tmp/logs'
        ];
        
        foreach ($cacheDirs as $dir) {
            $path = $this->uploadDir . '/' . $dir;
            if (is_dir($path)) {
                $files = glob($path . '/*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        @unlink($file);
                    }
                }
                $this->log("✓ Cleared: $dir");
            }
        }
        
        return true;
    }
    
    public function testDeployment() {
        $this->log("🧪 Testing deployment...");
        
        $checks = [
            'src/Application.php' => 'Application core',
            'config/app.php' => 'Configuration',
            'webroot/index.php' => 'Web root',
            'vendor/autoload.php' => 'Composer dependencies'
        ];
        
        foreach ($checks as $file => $desc) {
            $path = $this->uploadDir . '/' . $file;
            if (file_exists($path)) {
                $this->log("✓ $desc found");
            } else {
                $this->log("❌ $desc NOT found");
            }
        }
        
        return true;
    }
    
    public function cleanupArchive() {
        $this->log("🧹 Cleaning up...");
        
        $files = glob($this->uploadDir . '/kanji-back-*.tar.gz');
        foreach ($files as $file) {
            if (@unlink($file)) {
                $this->log("✓ Deleted: " . basename($file));
            }
        }
        
        return true;
    }
}

// HTML/CSS
$html = <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanji-Back Deployment</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 100%;
            padding: 40px;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .steps {
            background: #f5f5f5;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .step {
            margin: 10px 0;
            color: #555;
            font-size: 14px;
        }
        .step strong {
            color: #333;
        }
        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px 5px 10px 0;
            transition: transform 0.2s;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
        .output {
            background: #1e1e1e;
            color: #00ff00;
            padding: 15px;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            max-height: 300px;
            overflow-y: auto;
            margin: 20px 0;
            display: none;
        }
        .output.active {
            display: block;
        }
        p {
            margin: 5px 0;
        }
        .success { color: #00ff00; }
        .error { color: #ff4444; }
        .warning { color: #ffaa00; }
        .info { color: #44aaff; }
        .warning-box {
            background: #fff3cd;
            border: 1px solid #ffc107;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            font-size: 13px;
        }
        .success-box {
            background: #d4edda;
            border: 1px solid #28a745;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            font-size: 13px;
        }
        a {
            color: #667eea;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Kanji-Back Deployment</h1>
        <p class="subtitle">PHP Deployment Helper</p>
        
        <div class="warning-box">
            ⚠️ <strong>SECURITY WARNING:</strong> Delete this file (deploy.php) immediately after deployment!<br>
            Keep it on your server = security risk
        </div>
        
        <div class="steps">
            <div class="step"><strong>Step 1:</strong> Upload archive via FTP (kanji-back-YYYYMMDD-HHMMSS.tar.gz)</div>
            <div class="step"><strong>Step 2:</strong> Upload this file (deploy.php) via FTP</div>
            <div class="step"><strong>Step 3:</strong> Access deploy.php in your browser</div>
            <div class="step"><strong>Step 4:</strong> Click "Run Deployment" button below</div>
            <div class="step"><strong>Step 5:</strong> Delete deploy.php for security</div>
        </div>
        
        <form method="post">
            <button type="submit" name="action" value="extract">📦 Extract Archive</button>
            <button type="submit" name="action" value="full">🚀 Run Full Deployment</button>
            <button type="submit" name="action" value="test">🧪 Test Deployment</button>
            <button type="submit" name="action" value="cleanup">🧹 Cleanup</button>
        </form>
        
        <div class="output" id="output"></div>
    </div>
    
    <script>
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                document.getElementById('output').classList.add('active');
            });
        });
    </script>
</body>
</html>
HTML;

// Check if it's a POST request with action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $helper = new DeploymentHelper();
    
    echo $html;
    echo '<div class="output active">';
    
    $action = $_POST['action'];
    
    switch ($action) {
        case 'extract':
            $helper->extractArchive();
            break;
            
        case 'full':
            $helper->log("🚀 Starting full deployment...");
            if ($helper->extractArchive()) {
                $helper->runComposer();
                $helper->setPermissions();
                $helper->clearCache();
                $helper->testDeployment();
                echo '<div class="success-box" style="margin-top: 20px;">';
                echo '✅ <strong>Deployment Complete!</strong><br>';
                echo 'Your application is ready. Test it:<br>';
                echo '<a href="chmn?hanzi=%E5%92%B2" target="_blank">http://your-domain/kanji-back/chmn?hanzi=%E5%92%B2</a>';
                echo '</div>';
            }
            break;
            
        case 'test':
            $helper->testDeployment();
            break;
            
        case 'cleanup':
            $helper->cleanupArchive();
            break;
    }
    
    echo '</div>';
    return;
}

// Initial page load
echo $html;
?>
