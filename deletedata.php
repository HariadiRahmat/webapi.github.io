<?php
// Header hasil berbentuk json     
header("Content-Type: application/json");

// Tangkap metode akses 
$method = $_SERVER['REQUEST_METHOD'];

// Tangkap key dari header
$headers = apache_request_headers();
$apiKey = isset($headers['key']) ? $headers['key'] : '';

// Variabel hasil 
$result = array();

// Cek metode 
if ($method == 'DELETE') {

    // Cek apakah API key sesuai
    if ($apiKey) {
        // Koneksi database 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "supermarket";

        // Create connection 
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Cek koneksi 
        if ($conn->connect_error) {
            $result['status'] = [
                "code" => 500,
                "description" => 'Koneksi Gagal: ' . $conn->connect_error
            ];
        } else {
            // Cek keberadaan API key di database
            $stmt = $conn->prepare("SELECT * FROM user WHERE api_key=?");
            $stmt->bind_param("s", $apiKey);
            $stmt->execute();
            $result_query = $stmt->get_result();

            if ($result_query->num_rows > 0) {
                // Jika API key sesuai
                $id = $_GET['id']; // Fetch ID from URL parameter

                // Buat query 
                $sql = "DELETE FROM data_supermarket WHERE id='$id'";

                // Eksekusi query 
                if ($conn->query($sql) === TRUE) {
                    $result['status'] = [
                        "code" => 200,
                        "description" => '1 Data Deleted'
                    ];
                    $result['results'] = [
                        "id" => $id
                    ];
                } else {
                    $result['status'] = [
                        "code" => 500,
                        "description" => 'Error: ' . $conn->error
                    ];
                }
            } else {
                // Jika API key tidak sesuai
                $result['status'] = [
                    "code" => 401,
                    "description" => 'Unauthorized: Invalid API Key'
                ];
            }
            $conn->close(); // Tutup koneksi 
        }
    } else {
        // Jika tidak ada API key
        $result['status'] = [
            "code" => 401,
            "description" => 'Unauthorized: API Key is missing'
        ];
    }
} else {
    // Jika metode tidak valid
    $result['status'] = [
        "code" => 400,
        "description" => 'Method Not Valid'
    ];
}

// Tampilan dalam format json     
echo json_encode($result);
