<?php
// Header hasil berbentuk json
header("Content-Type: application/json");

// Tangkap key dari header
$headers = apache_request_headers();
$key = isset($headers['key']) ? $headers['key'] : '';
$username = isset($headers['username']) ? $headers['username'] : '';

if (empty($key) || empty($username)) {
    echo json_encode(array("status" => array("code" => 400, "description" => "API key or username is missing")));
    exit;
}

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "supermarket";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);
// Check connection
if ($conn->connect_error) {
    die(json_encode(array("status" => array("code" => 500, "description" => "Database connection error"))));
}

// Debugging: Cek apakah key tertangkap
error_log("API Key: " . $key);
error_log("Username: " . $username);

// Cek user
$stmt = $conn->prepare("SELECT * FROM user WHERE api_key=?");
$stmt->bind_param("s", $key);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($user['username'] === $username) {
        // API key dan username valid, lanjutkan dengan logika Anda
        echo json_encode(array("status" => array("code" => 200, "description" => "Key and username valid")));
    } else {
        echo json_encode(array("status" => array("code" => 400, "description" => "Username not valid for provided API key")));
    }
} else {
    echo json_encode(array("status" => array("code" => 400, "description" => "Key not valid")));
}

$stmt->close();
$conn->close();
