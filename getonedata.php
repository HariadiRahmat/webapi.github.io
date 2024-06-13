<?php
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$result = array();

if ($method == 'GET') {
    // Cek apakah API key disertakan dalam header
    $headers = apache_request_headers();
    $apiKey = isset($headers['key']) ? $headers['key'] : '';

    // Jika API key tidak ada
    if (!$apiKey) {
        $result['status'] = [
            'code' => 401,
            'description' => 'Unauthorized: API Key is missing'
        ];
        echo json_encode($result);
        exit;
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result['status'] = [
            'code' => 200,
            'description' => 'Request Valid'
        ];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "supermarket";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Prepared statement untuk menghindari SQL injection
        $sql = "SELECT * FROM data_supermarket WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $hasil_query = $stmt->get_result();

        // Mengambil hasil query
        if ($hasil_query->num_rows > 0) {
            $result['results'] = $hasil_query->fetch_all(MYSQLI_ASSOC);
        } else {
            $result['status'] = [
                'code' => 404,
                'description' => 'Data not found'
            ];
        }

        $stmt->close();
        $conn->close();
    } else {
        $result['status'] = [
            'code' => 400,
            'description' => 'Parameter Invalid'
        ];
    }
} else {
    $result['status'] = [
        'code' => 400,
        'description' => 'Request Not Valid'
    ];
}

echo json_encode($result);
