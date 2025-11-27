<?php
require_once 'connect.php';

$query = "SELECT id, item_name, description, posted_by, date FROM lostfound ORDER BY date DESC";
$result = $conn->query($query);

$items = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

echo json_encode(['status' => 'success', 'data' => $items]);
?>
