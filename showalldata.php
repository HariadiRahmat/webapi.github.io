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


if (isset($_POST['submit'])) {
    // You can handle form submission logic here if needed
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket Data</title>
    <!-- Tambahkan link CSS Bootstrap -->


    <link rel="stylesheet" href="homestyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap' rel='stylesheet' type='text/css'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body>
    <!-- nav -->
    <nav class="navbar navbar-expand-lg bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Supermarket</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="user_home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_aksesapi.php">Akses API</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Lihat Data</a>
                    </li>

                    <?php
                    // Periksa apakah pengguna telah login
                    if (isset($_SESSION['username'])) {
                        // Jika sudah login, tampilkan tombol logout
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="user_login.php">  <i class="fas fa-sign-out-alt"></i></a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- nav end -->

    <br>
    <div class="container">
        <h1 class="mt-5">Data Supermarket</h1>
        <button type="button" class="btn btn-primary" onclick="redirectToAddData()">Tambah</button>



        <div id="data-container" class="mt-4">
            <table class="table table-bordered table-hover ">
                <thead class="table-secondary">
                    <tr>
                        <th>ID</th>
                        <th>Invoice ID</th>
                        <th>Branch</th>
                        <th>City</th>
                        <th>Customer Type</th>
                        <th>Gender</th>
                        <th>Product Line</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Tax (5%)</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Payment</th>
                        <th>COGS</th>
                        <th>Gross Margin (%)</th>
                        <th>Gross Income</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="data-container">
                    <!-- Data akan ditampilkan di sini -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tambahkan script untuk jQuery dan Bootstrap JS (opsional, tapi direkomendasikan untuk beberapa komponen Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script untuk mengambil data dari API dan menampilkannya -->
    <script>
        // Fungsi untuk melakukan permintaan data ke API
        function fetchData() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'getalldata.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('key', 'f6fdffe48c908deb0f4c3bd36c032e72'); // API KEY

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var responseData = JSON.parse(xhr.responseText);
                    if (responseData.status.code === 200) {
                        displayData(responseData.results); // Panggil fungsi untuk menampilkan data
                    } else {
                        alert('Error: ' + responseData.status.description);
                    }
                } else {
                    alert('Request failed. Status: ' + xhr.status);
                }
            };

            xhr.send();
        }

        // Fungsi untuk menampilkan data ke dalam elemen HTML
        function displayData(data) {
            var tbody = document.querySelector('#data-container tbody');
            var html = '';

            data.forEach(function(item) {
                html += '<tr>';
                html += '<td>' + item.id + '</td>'; // Menambahkan kolom ID
                html += '<td>' + item.Invoice_ID + '</td>';
                html += '<td>' + item.Branch + '</td>';
                html += '<td>' + item.City + '</td>';
                html += '<td>' + item.Customer_type + '</td>';
                html += '<td>' + item.Gender + '</td>';
                html += '<td>' + item.Product_line + '</td>';
                html += '<td>' + item.Unit_price + '</td>';
                html += '<td>' + item.Quantity + '</td>';
                html += '<td>' + item.Tax_5_percen + '</td>';
                html += '<td>' + item.Total + '</td>';
                html += '<td>' + item.Date + '</td>';
                html += '<td>' + item.Time + '</td>';
                html += '<td>' + item.Payment + '</td>';
                html += '<td>' + item.Cogs + '</td>';
                html += '<td>' + item.Gross_margin_percentage + '</td>';
                html += '<td>' + item.Gross_income + '</td>';
                html += '<td>' + item.Rating + '</td>';
                html += '<td> <button class="btn btn-sm btn-danger" onclick="deleteData(' + item.id + ')">Delete</button></td>';
                html += '</tr>';

            });

            tbody.innerHTML = html;
        }

        // Panggil fungsi fetchData saat halaman dimuat
        window.onload = fetchData;

        function redirectToAddData() {
            window.location.href = 'adddata.php';
        }
        // Function to handle delete action
        function deleteData(id) {
            var confirmDelete = confirm('Are you sure you want to delete this record?');
            if (confirmDelete) {
                var xhr = new XMLHttpRequest();
                xhr.open('DELETE', 'deletedata.php?id=' + id, true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('key', 'f6fdffe48c908deb0f4c3bd36c032e72'); // API KEY

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        alert('Record deleted successfully');
                        fetchData(); // Refresh data after deletion
                    } else {
                        alert('Failed to delete record. Status: ' + xhr.status);
                    }
                };

                xhr.send();
            }
        }
    </script>


</body>

</html>