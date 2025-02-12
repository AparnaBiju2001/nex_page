<?php

$servername = "localhost";
$username = "root"; // Change if you have a different MySQL username
$password = ""; // Change if you have a MySQL password
$dbname = "project_form_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is received via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["mf-first-name"];
    $email = $_POST["mf-email"];   
    $phone = $_POST["mf-telephone"];
    $comment = $_POST["mf-comment"];
    $inquiry_type = $_POST["mf-select"];
    $statuss = $_POST["statuss"];


    // SQL query to insert data
    $sql = "INSERT INTO inquiries (name, email, phone, inquiry_type, comment, statuss) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $phone, $inquiry_type, $comment, $statuss);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Form submitted successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error submitting form!"]);
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>
