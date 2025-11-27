<?php
header('Content-Type: application/json');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

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

// Get material ID
$materialId = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($materialId <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid material ID']);
    exit;
}

// Get file path
$sql = "SELECT file_path, uploaded_by FROM study_materials WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $materialId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Material not found']);
    exit;
}

$row = $result->fetch_assoc();
$filePath = $row['file_path'];
$uploadedBy = $row['uploaded_by'];

// Check if user is the uploader
if ($uploadedBy != $_SESSION['user_id']) {
    echo json_encode(['status' => 'error', 'message' => 'You can only delete your own materials']);
    exit;
}

// Delete from database
$deleteSql = "DELETE FROM study_materials WHERE id = ?";
$deleteStmt = $conn->prepare($deleteSql);
$deleteStmt->bind_param("i", $materialId);

if ($deleteStmt->execute()) {
    // Delete file from server
    if (file_exists($filePath)) {
        unlink($filePath);
    }
    echo json_encode(['status' => 'success', 'message' => 'Material deleted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete material']);
}

$stmt->close();
$deleteStmt->close();
$conn->close();
?>
