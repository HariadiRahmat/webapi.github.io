<?php
// Header hasil berbentuk json
header("Content-Type: application/json");

// Tangkap key dari header
$headers = apache_request_headers();
$key = isset($headers['key']) ? $headers['key'] : '';

// Variable hasil
$result = array();

// Start koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "supermarket";

// Memeriksa apakah kunci API disertakan dalam header
if (empty($key)) {
    $result['status'] = array("code" => 401, "description" => "Unauthorized: API key is missing");
    echo json_encode($result);
    exit; // Menghentikan eksekusi lebih lanjut jika kunci API tidak disertakan
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $result['status'] = array("code" => 500, "description" => "database connection error");
} else {
    // Cek user
    $stmt = $conn->prepare("SELECT * FROM user WHERE api_key=?");
    $stmt->bind_param("s", $key);
    $stmt->execute();
    $result_query = $stmt->get_result();

    if ($result_query->num_rows > 0) {
        // User valid, API key ditemukan di database
        $user = $result_query->fetch_assoc();

        // Jika kunci API cocok dengan yang ada di database
        if ($user['api_key'] === $key) {
            // Jika metode adalah GET
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                // Query untuk mengambil data
                $sql = "SELECT * FROM data_supermarket";

                // Eksekusi query
                $result_query = $conn->query($sql);

                // Jika query berhasil dieksekusi
                if ($result_query) {
                    // Masukkan hasil query ke dalam array result
                    $result['status'] = array("code" => 200, "description" => "request valid");
                    $result['results'] = $result_query->fetch_all(MYSQLI_ASSOC);
                } else {
                    // Jika terdapat kesalahan dalam eksekusi query
                    $result['status'] = array("code" => 500, "description" => "query execution error");
                }
            } else {
                // Jika metode selain GET
                $result['status'] = array("code" => 400, "description" => "method not allowed");
            }
        } else {
            // Jika kunci API tidak cocok dengan yang ada di database
            $result['status'] = array("code" => 400, "description" => "key not valid");
        }
    } else {
        // Jika kunci API tidak ditemukan di database
        $result['status'] = array("code" => 400, "description" => "key not found");
    }
}

// Tutup koneksi database
$conn->close();

// Tampilkan data dalam format JSON
echo json_encode($result);
