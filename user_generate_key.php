<?php
$username = $_POST['username'];
$password = $_POST['password'];

$servername = "localhost";
$db_username = "root"; // Ganti dengan username database Anda
$db_password = ""; // Ganti dengan password database Anda
$dbname = "supermarket";

$token = md5($username . $password);

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cek user
$sql = "UPDATE user SET api_key='$token' WHERE username='$username' AND password='$password'";
if ($conn->query($sql) === TRUE) {
    echo "Token API anda: " . $token;
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
