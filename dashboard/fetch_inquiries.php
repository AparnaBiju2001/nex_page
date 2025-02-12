<?php
header('Content-Type: application/json');
require_once "db.php"; // Include the database connection

$sql = "SELECT name, email, phone, comment, inquiry_type, statuss FROM inquiries;
";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>
