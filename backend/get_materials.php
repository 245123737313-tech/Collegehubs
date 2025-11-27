<?php
header('Content-Type: application/json');
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegehub_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

// Get all materials with uploader information
$sql = "SELECT sm.id, sm.title, sm.description, sm.file_name, sm.file_type, sm.file_size, 
               sm.uploaded_date, sm.subject, sm.semester, u.name as uploaded_by_name
        FROM study_materials sm
        LEFT JOIN users u ON sm.uploaded_by = u.id
        ORDER BY sm.uploaded_date DESC";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode(['status' => 'error', 'message' => 'Query failed']);
    exit;
}

$materials = [];
while ($row = $result->fetch_assoc()) {
    $materials[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'description' => $row['description'],
        'file_name' => $row['file_name'],
        'file_type' => $row['file_type'],
        'file_size' => formatFileSize($row['file_size']),
        'uploaded_date' => date('d M Y H:i', strtotime($row['uploaded_date'])),
        'subject' => $row['subject'],
        'semester' => $row['semester'],
        'uploaded_by' => $row['uploaded_by_name']
    ];
}

echo json_encode(['status' => 'success', 'materials' => $materials]);
$conn->close();

function formatFileSize($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' B';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' B';
    } else {
        $bytes = '0 B';
    }
    return $bytes;
}
?>
