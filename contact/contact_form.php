<?php

header('Content-Type: application/json');

// Database connection
$host = "localhost";  // Change if needed
$user = "root";       // Change to your database username
$pass = "";           // Change to your database password
$dbname = "project_form_db"; // Change to your database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]));
}

// Validate and sanitize input
$name = isset($_POST['mf-first-name']) ? trim($_POST['mf-first-name']) : '';
$email = isset($_POST['mf-email']) ? trim($_POST['mf-email']) : '';
$telephone = isset($_POST['mf-telephone']) ? trim($_POST['mf-telephone']) : '';
$comment = isset($_POST['mf-comment']) ? trim($_POST['mf-comment']) : '';
$inquiry_type = isset($_POST['mf-select']) ? trim($_POST['mf-select']) : '';

// Server-side validation
if (empty($name) || empty($email) || empty($telephone) || empty($comment) || empty($inquiry_type)) {
    echo json_encode(["status" => "error", "message" => "All fields are required."]);
    exit;
}

// Email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email format."]);
    exit;
}

// Prepared statement to insert data
$stmt = $conn->prepare("INSERT INTO contact_form (name, email, telephone, comment, inquiry_type) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $telephone, $comment, $inquiry_type);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Your inquiry has been submitted successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error submitting inquiry: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
