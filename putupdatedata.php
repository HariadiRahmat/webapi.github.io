<?php
session_start();

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "supermarket";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have input fields like $_POST['Invoice_ID'], $_POST['Branch'], etc.

    $invoice_id = $_POST['Invoice_ID'];
    $branch = $_POST['Branch'];
    $city = $_POST['City'];
    $customer_type = $_POST['CustomerType'];
    $gender = $_POST['Gender'];
    $product_line = $_POST['ProductLine'];
    $unit_price = $_POST['UnitPrice'];
    $quantity = $_POST['Quantity'];
    $tax = $_POST['Tax'];
    $total = $_POST['Total'];
    $date = $_POST['Date'];
    $time = $_POST['Time'];
    $payment = $_POST['Payment'];
    $cogs = $_POST['COGS'];
    $gross_margin = $_POST['GrossMargin'];
    $gross_income = $_POST['GrossIncome'];
    $rating = $_POST['Rating'];

    // Prepare update query
    $sql = "UPDATE your_table_name SET 
            Invoice_ID='$invoice_id', 
            Branch='$branch', 
            City='$city', 
            Customer_type='$customer_type', 
            Gender='$gender', 
            Product_line='$product_line', 
            Unit_price='$unit_price', 
            Quantity='$quantity', 
            Tax_5_percen='$tax', 
            Total='$total', 
            Date='$date', 
            Time='$time', 
            Payment='$payment', 
            Cogs='$cogs', 
            Gross_margin_percentage='$gross_margin', 
            Gross_income='$gross_income', 
            Rating='$rating' 
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $response = array("status" => array("code" => 200, "description" => "Data updated successfully"));
        echo json_encode($response);
    } else {
        $response = array("status" => array("code" => 500, "description" => "Failed to update data: " . $conn->error));
        echo json_encode($response);
    }
}

$conn->close();
