<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);

    if (empty($id)) {
        echo json_encode(['status' => 'error', 'message' => 'Item ID is required']);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM lostfound WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Item deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete item']);
    }

    $stmt->close();
}
?>
