<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegehub_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo 'Database connection failed';
    exit;
}

// Get material ID from request
$materialId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($materialId <= 0) {
    echo 'Invalid material ID';
    exit;
}

// Get file path from database
$sql = "SELECT file_path, file_name FROM study_materials WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $materialId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo 'Material not found';
    exit;
}

$row = $result->fetch_assoc();
$filePath = $row['file_path'];
$fileName = $row['file_name'];

// Check if file exists
if (!file_exists($filePath)) {
    echo 'File not found on server';
    exit;
}

// Set headers for download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
header('Content-Length: ' . filesize($filePath));
header('Pragma: no-cache');
header('Expires: 0');

// Read and output file
readfile($filePath);

$stmt->close();
$conn->close();
?>
