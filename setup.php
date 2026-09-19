<?php
// HAPUS FILE INI SETELAH SETUP SELESAI!
$action = $_GET['action'] ?? '';
chdir(__DIR__);

if ($action === 'key') {
    echo '<pre>'.shell_exec('php artisan key:generate 2>&1').'</pre>';
} elseif ($action === 'migrate') {
    echo '<pre>'.shell_exec('php artisan migrate --force 2>&1').'</pre>';
} elseif ($action === 'freshdb') {
    echo '<pre>'.shell_exec('php artisan migrate:fresh --force 2>&1').'</pre>';
} elseif ($action === 'storage') {
    echo '<pre>'.shell_exec('php artisan storage:link 2>&1').'</pre>';
} elseif ($action === 'clearconfig') {
    echo '<pre>'.shell_exec('php artisan config:clear 2>&1').'</pre>';
    echo '<pre>'.shell_exec('php artisan cache:clear 2>&1').'</pre>';
    echo '<pre>'.shell_exec('php artisan config:cache 2>&1').'</pre>';
} elseif ($action === 'optimize') {
    echo '<pre>'.shell_exec('php artisan optimize 2>&1').'</pre>';
    echo '<pre>'.shell_exec('php artisan filament:optimize 2>&1').'</pre>';
    echo '<pre>'.shell_exec('php artisan config:cache 2>&1').'</pre>';
    echo '<pre>'.shell_exec('php artisan route:cache 2>&1').'</pre>';
} elseif ($action === 'permission') {
    echo '<pre>'.shell_exec('chmod -R 775 storage 2>&1').'</pre>';
    echo '<pre>'.shell_exec('chmod -R 775 bootstrap/cache 2>&1').'</pre>';
} else {
    echo '<h2>KPM Group Setup</h2>';
    echo '<a href="?action=key">1. Generate App Key</a><br><br>';
    echo '<a href="?action=freshdb">2. Fresh Migrate Database</a><br><br>';
    echo '<a href="?action=storage">3. Storage Link</a><br><br>';
    echo '<a href="?action=permission">4. Set Permission</a><br><br>';
    echo '<a href="?action=clearconfig">5. Clear Config</a><br><br>';
    echo '<a href="?action=optimize">6. Optimize</a><br><br>';
}