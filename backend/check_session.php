<?php
session_start();

if (isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'success',
        'logged_in' => true,
        'user_name' => $_SESSION['user_name'],
        'user_email' => $_SESSION['user_email']
    ]);
} else {
    echo json_encode([
        'status' => 'success',
        'logged_in' => false
    ]);
}
?>
