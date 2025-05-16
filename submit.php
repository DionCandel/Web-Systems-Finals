<?php
$host = 'localhost';
$db = 'landing_page';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$message = htmlspecialchars(trim($_POST['message']));

if (empty($name) || empty($email)) {
    echo "Please fill in all required fields.";
    exit;
}

$sql = "INSERT INTO submissions (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    echo "Thank you! Your submission was successful.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>