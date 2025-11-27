<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (empty($title) || empty($description)) {
        echo json_encode(['status' => 'error', 'message' => 'Title and description are required']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO notices (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Notice added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add notice']);
    }

    $stmt->close();
}
?>
