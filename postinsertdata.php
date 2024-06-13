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
if ($method == 'POST') {

    // Parsing data input
    $data = json_decode(file_get_contents("php://input"), true);

    // Pengecekan parameter
    if (
        isset($data['Invoice_ID'])
        && isset($data['Branch'])
        && isset($data['City'])
        && isset($data['Customer_type'])
        && isset($data['Gender'])
        && isset($data['Product_line'])
        && isset($data['Unit_price'])
        && isset($data['Quantity'])
        && isset($data['Tax_5_percen'])
        && isset($data['Total'])
        && isset($data['Date'])
        && isset($data['Time'])
        && isset($data['Payment'])
        && isset($data['Cogs'])
        && isset($data['Gross_margin_percentage'])
        && isset($data['Gross_income'])
        && isset($data['Rating'])
    ) {

        // Tangkap parameter
        $invoiceID = $data['Invoice_ID'];
        $branch = $data['Branch'];
        $city = $data['City'];
        $customerType = $data['Customer_type'];
        $gender = $data['Gender'];
        $productLine = $data['Product_line'];
        $unitPrice = $data['Unit_price'];
        $quantity = $data['Quantity'];
        $tax = $data['Tax_5_percen'];
        $total = $data['Total'];
        $date = $data['Date'];
        $time = $data['Time'];
        $payment = $data['Payment'];
        $cogs = $data['Cogs'];
        $grossMargin = $data['Gross_margin_percentage'];
        $grossIncome = $data['Gross_income'];
        $rating = $data['Rating'];

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
            // Buat query
            $sql = "INSERT INTO data_supermarket 
                    (Invoice_ID, Branch, City, Customer_type, Gender, Product_line, 
                    Unit_price, Quantity, Tax_5_percen, Total, Date, Time, Payment, 
                    Cogs, Gross_margin_percentage, Gross_income, Rating) 
                    VALUES 
                    ('$invoiceID', '$branch', '$city', '$customerType', '$gender', '$productLine', 
                    '$unitPrice', '$quantity', '$tax', '$total', '$date', '$time', '$payment', 
                    '$cogs', '$grossMargin', '$grossIncome', '$rating')";

            // Eksekusi query
            if ($conn->query($sql) === TRUE) {
                $new_id = $conn->insert_id;
                $result['status'] = [
                    "code" => 200,
                    "description" => '1 Data Inserted'
                ];
                $result['results'] = [
                    "id" => $new_id,
                    "Invoice_ID" => $invoiceID,
                    "Branch" => $branch,
                    "City" => $city,
                    "Customer_type" => $customerType,
                    "Gender" => $gender,
                    "Product_line" => $productLine,
                    "Unit_price" => $unitPrice,
                    "Quantity" => $quantity,
                    "Tax_5_percen" => $tax,
                    "Total" => $total,
                    "Date" => $date,
                    "Time" => $time,
                    "Payment" => $payment,
                    "Cogs" => $cogs,
                    "Gross_margin_percentage" => $grossMargin,
                    "Gross_income" => $grossIncome,
                    "Rating" => $rating
                ];
            } else {
                $result['status'] = [
                    "code" => 500,
                    "description" => 'Error: ' . $conn->error
                ];
            }
            $conn->close(); // Tutup koneksi
        }
    } else {
        $result['status'] = [
            "code" => 400,
            "description" => 'Parameter Invalid'
        ];
    }
} else {
    $result['status'] = [
        "code" => 400,
        "description" => 'Method Not Valid'
    ];
}

// Tampilan dalam format JSON
echo json_encode($result);
