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
    <title>Form POST Data</title>
    <link rel="stylesheet" href="homestyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap' rel='stylesheet' type='text/css'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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


    <div class="container mt-5">
        <h2 class="mb-4">Tambah data</h2>
        <form id="dataForm" action="postinsertdata.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoiceID">Invoice ID:</label>
                        <input type="text" class="form-control" id="invoiceID" name="Invoice_ID" required>
                    </div>

                    <div class="form-group">
                        <label for="branch">Branch:</label>
                        <select class="form-control" id="branch" name="Branch" required>
                            <option value="Mandalay">Mandalay</option>
                            <option value="Naypyitaw">Naypyitaw</option>
                            <option value="Yangon">Yangon</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="city">City:</label>
                        <select class="form-control" id="city" name="City" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="customerType">Customer Type:</label>
                        <select class="form-control" id="customerType" name="Customer_type" required>
                            <option value="Member">Member</option>
                            <option value="Normal">Normal</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="gender" name="Gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="productLine">Product Line:</label>
                        <input type="text" class="form-control" id="productLine" name="Product_line" required>
                    </div>

                    <div class="form-group">
                        <label for="unitPrice">Unit Price:</label>
                        <input type="number" class="form-control" id="unitPrice" name="Unit_price" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="Quantity" required>
                    </div>

                    <div class="form-group">
                        <label for="tax">Tax (5%):</label>
                        <input type="number" class="form-control" id="tax" name="Tax_5_percen" step="0.01" required>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="total">Total:</label>
                        <input type="number" class="form-control" id="total" name="Total" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="Date" required>
                    </div>

                    <div class="form-group">
                        <label for="time">Time:</label>
                        <input type="time" class="form-control" id="time" name="Time" required>
                    </div>

                    <div class="form-group">
                        <label for="payment">Payment:</label>
                        <select class="form-control" id="payment" name="Payment" required>
                            <option value="Ewallet">Ewallet</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cogs">COGS:</label>
                        <input type="number" class="form-control" id="cogs" name="Cogs" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="grossMargin">Gross Margin (%):</label>
                        <input type="number" class="form-control" id="grossMargin" name="Gross_margin_percentage" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="grossIncome">Gross Income:</label>
                        <input type="number" class="form-control" id="grossIncome" name="Gross_income" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <input type="number" class="form-control" id="rating" name="Rating" min="1" max="10" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fungsi untuk mengirim data ke PHP
            function postData(event) {
                event.preventDefault(); // Menghentikan pengiriman formulir default

                var apiKey = 'f6fdffe48c908deb0f4c3bd36c032e72'; //API KEY
                var url = 'postinsertdata.php'; // url untuk mengeksekusi proses insert data melalui metode POST

                // Mengambil nilai dari setiap elemen formulir
                var invoiceID = document.getElementById('invoiceID').value;
                var branch = document.getElementById('branch').value;
                var city = document.getElementById('city').value;
                var customerType = document.getElementById('customerType').value;
                var gender = document.getElementById('gender').value;
                var productLine = document.getElementById('productLine').value;
                var unitPrice = document.getElementById('unitPrice').value;
                var quantity = document.getElementById('quantity').value;
                var tax = document.getElementById('tax').value;
                var total = document.getElementById('total').value;
                var date = document.getElementById('date').value;
                var time = document.getElementById('time').value;
                var payment = document.getElementById('payment').value;
                var cogs = document.getElementById('cogs').value;
                var grossMargin = document.getElementById('grossMargin').value;
                var grossIncome = document.getElementById('grossIncome').value;
                var rating = document.getElementById('rating').value;

                // Data yang akan dikirim sebagai POST
                var data = {
                    "Invoice_ID": invoiceID,
                    "Branch": branch,
                    "City": city,
                    "Customer_type": customerType,
                    "Gender": gender,
                    "Product_line": productLine,
                    "Unit_price": unitPrice,
                    "Quantity": quantity,
                    "Tax_5_percen": tax,
                    "Total": total,
                    "Date": date,
                    "Time": time,
                    "Payment": payment,
                    "Cogs": cogs,
                    "Gross_margin_percentage": grossMargin,
                    "Gross_income": grossIncome,
                    "Rating": rating
                };

                var xhr = new XMLHttpRequest();
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('key', apiKey); // Mengatur header untuk API key

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        if (responseData.status.code === 200) {
                            alert('Data successfully posted!');
                        } else {
                            alert('Error: ' + responseData.status.description);
                        }
                    } else {
                        alert('Request failed. Status: ' + xhr.status);
                    }
                };

                xhr.send(JSON.stringify(data)); // Mengirim data dalam format JSON
            }

            // Menangkap acara submit formulir
            var form = document.getElementById('dataForm');
            form.addEventListener('submit', postData);
        });
    </script>

</body>

</html>