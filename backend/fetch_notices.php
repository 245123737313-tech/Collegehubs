<?php
require_once 'connect.php';

$query = "SELECT id, title, description, date FROM notices ORDER BY date DESC";
$result = $conn->query($query);

$notices = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notices[] = $row;
    }
}

echo json_encode(['status' => 'success', 'data' => $notices]);
?>
