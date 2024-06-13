<?php
// Header hasil berbentuk json
header("Content-Type: application/json");

// Tangkap key dari URL parameter
$key = isset($_GET['key']) ? $_GET['key'] : '';
$username = isset($_GET['username']) ? $_GET['username'] : '';

if (empty($key) || empty($username)) {
    echo json_encode(array("status" => array("code" => 400, "description" => "API key or username is missing")));
    exit;
}

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "supermarket";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);
// Check connection
if ($conn->connect_error) {
    die(json_encode(array("status" => array("code" => 500, "description" => "Database connection error"))));
}

// Debugging: Cek apakah key dan username tertangkap
error_log("API Key: " . $key);
error_log("Username: " . $username);

// Cek user
$stmt = $conn->prepare("SELECT * FROM user WHERE api_key=? AND username=?");
$stmt->bind_param("ss", $key, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // API key dan username valid, lanjutkan dengan logika Anda
    echo json_encode(array("status" => array("code" => 200, "description" => "Key and username valid")));
} else {
    echo json_encode(array("status" => array("code" => 400, "description" => "Key or username not valid")));
}

$stmt->close();
$conn->close();
