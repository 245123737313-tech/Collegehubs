<?php
header('Content-Type: application/json');
session_start();

// Debug: Log session info
error_log('Session ID: ' . session_id());
error_log('Session user_id: ' . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'NOT SET'));
error_log('Session data: ' . print_r($_SESSION, true));

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    error_log('User not logged in - session user_id not set');
    echo json_encode(['status' => 'error', 'message' => 'Not logged in. Please login to upload materials']);
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

// Create uploads directory if it doesn't exist
$uploadDir = '../uploads/study_materials/';
if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        error_log('Failed to create upload directory: ' . $uploadDir);
        echo json_encode(['status' => 'error', 'message' => 'Failed to create upload directory']);
        exit;
    }
}
error_log('Upload directory: ' . $uploadDir . ' - Writable: ' . (is_writable($uploadDir) ? 'YES' : 'NO'));

// Check if file was uploaded
if (!isset($_FILES['file'])) {
    echo json_encode(['status' => 'error', 'message' => 'No file uploaded']);
    exit;
}

$file = $_FILES['file'];
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$semester = isset($_POST['semester']) ? intval($_POST['semester']) : 0;

// Validate inputs
if (empty($title)) {
    echo json_encode(['status' => 'error', 'message' => 'Title is required']);
    exit;
}

// Allowed file types
$allowedTypes = ['application/pdf', 'application/vnd.ms-powerpoint', 
                 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                 'application/msword',
                 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                 'text/plain'];

$allowedExtensions = ['pdf', 'ppt', 'pptx', 'doc', 'docx', 'txt'];

// Validate file
if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['status' => 'error', 'message' => 'File upload error']);
    exit;
}

// Check file size (max 50MB)
$maxSize = 50 * 1024 * 1024;
if ($file['size'] > $maxSize) {
    echo json_encode(['status' => 'error', 'message' => 'File size exceeds 50MB limit']);
    exit;
}

// Get file extension
$fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

// Validate file type
if (!in_array($fileExtension, $allowedExtensions)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid file type. Only PDF, PPT, PPTX, DOC, DOCX, and TXT are allowed']);
    exit;
}

// Generate unique filename
$uniqueFileName = time() . '_' . uniqid() . '.' . $fileExtension;
$filePath = $uploadDir . $uniqueFileName;

// Move uploaded file
if (!move_uploaded_file($file['tmp_name'], $filePath)) {
    error_log('Failed to move uploaded file from ' . $file['tmp_name'] . ' to ' . $filePath);
    echo json_encode(['status' => 'error', 'message' => 'Failed to save file. Check server permissions.']);
    exit;
}
error_log('File uploaded successfully to: ' . $filePath);

// Insert into database
$sql = "INSERT INTO study_materials (title, description, file_name, file_path, file_type, file_size, uploaded_by, subject, semester) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    unlink($filePath);
    echo json_encode(['status' => 'error', 'message' => 'Database error']);
    exit;
}

$stmt->bind_param("sssssiiis", $title, $description, $file['name'], $filePath, $fileExtension, $file['size'], $_SESSION['user_id'], $subject, $semester);

if ($stmt->execute()) {
    error_log('Material saved to database with ID: ' . $stmt->insert_id);
    echo json_encode([
        'status' => 'success',
        'message' => 'Material uploaded successfully',
        'material_id' => $stmt->insert_id
    ]);
} else {
    error_log('Database insert failed: ' . $stmt->error);
    unlink($filePath);
    echo json_encode(['status' => 'error', 'message' => 'Failed to save to database: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
