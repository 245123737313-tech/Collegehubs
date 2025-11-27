<?php
header('Content-Type: application/json');

$verification = [
    'php_version' => phpversion(),
    'php_version_ok' => version_compare(phpversion(), '7.0.0', '>='),
    'mysqli_extension' => extension_loaded('mysqli') ? 'Loaded' : 'Not Loaded',
    'mysqli_ok' => extension_loaded('mysqli'),
    'session_support' => extension_loaded('session') ? 'Enabled' : 'Disabled',
    'session_ok' => extension_loaded('session'),
    'file_uploads' => ini_get('file_uploads') ? 'Enabled' : 'Disabled',
    'max_upload_size' => ini_get('upload_max_filesize'),
    'post_max_size' => ini_get('post_max_size'),
];

// Test database connection
require_once 'config.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    $verification['database_connection'] = 'Failed: ' . $conn->connect_error;
    $verification['database_ok'] = false;
} else {
    $verification['database_connection'] = 'Connected';
    $verification['database_ok'] = true;
    
    // Check tables
    $tables = ['users', 'notices', 'lostfound'];
    $verification['tables'] = [];
    
    foreach ($tables as $table) {
        $result = $conn->query("SHOW TABLES LIKE '$table'");
        $verification['tables'][$table] = $result->num_rows > 0 ? 'Exists' : 'Missing';
    }
    
    $conn->close();
}

// Overall status
$verification['all_ok'] = 
    $verification['php_version_ok'] && 
    $verification['mysqli_ok'] && 
    $verification['session_ok'] && 
    $verification['database_ok'];

echo json_encode($verification, JSON_PRETTY_PRINT);
?>
