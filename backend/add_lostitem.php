<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = trim($_POST['item_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $posted_by = trim($_POST['posted_by'] ?? '');

    if (empty($item_name) || empty($description) || empty($posted_by)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO lostfound (item_name, description, posted_by) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $item_name, $description, $posted_by);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Item posted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to post item']);
    }

    $stmt->close();
}
?>
