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
    <title>Home</title>
    <link rel="stylesheet" href="homestyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap' rel='stylesheet' type='text/css'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body>
    <h2> selamat datang <?php echo $_SESSION['username']; ?></h2>

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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_aksesapi.php">Akses API</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="showalldata.php">Lihat Data</a>
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

    <!-- layouting -->
    <div class="container mt-5 sm-md-lg">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-5 mx-auto order-last order-md-first ">
                <h1 class="custom-heading">Statistik Supermarket 2019</h1>
                <p>Kami adalah platform online yang menyediakan data dan analisis terkait operasi dan performa supermarket. Platform ini mengumpulkan dan menampilkan berbagai statistik penting seperti penjualan harian, tingkat persediaan produk, tren pembelian, dan perilaku konsumen. Dengan menggunakan data dari sistem point of sale (POS), inventaris, dan program loyalitas pelanggan, situs ini memberikan wawasan berharga bagi manajer toko dan pemilik bisnis. </p>
            </div>

            <div class=" mt-5 col-12 col-md-6 col-lg- mx-auto order-first order-md-last">
                <img src="20945567.jpg" alt="banner" class="img-fluid">
            </div>
        </div>
    </div>
    <!-- layouting end -->

    <div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#4a4ced" fill-opacity="1" d="M0,0L120,21.3C240,43,480,85,720,96C960,107,1200,85,1320,74.7L1440,64L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
        </svg>
    </div>

    <!-- section grafik -->
    <section id="section1" class="section1">
        <div class="container text-center">
            <h1 class="mb-5">Statistik Market 2019</h1>
        </div>
        <div class="container text-center">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6 mx-auto" style="margin-top: 20px; margin-bottom: 20px;">
                    <div>
                        <canvas id="myChart" width="200" height="190"></canvas>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 mb-5" style="margin-top: 20px; margin-bottom: 20px;">
                    <div>
                        <canvas id="donatChart" width="50" height="50"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- section grafik end -->

    <!-- footer -->
    <footer class="text-white text-center text-lg-start" style="background-color: #23242a;">
        <div class="container p-4">
            <div class="row mt-4">
                <div class="col-lg-8 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">About company</h5>
                    <p>
                        Kami adalah perusahaan terkemuka dalam penyediaan solusi data dan analisis untuk industri ritel, khususnya supermarket. Sejak berdiri pada tahun 2018, kami berkomitmen membantu bisnis supermarket mengoptimalkan operasional mereka dengan menyediakan platform statistik yang intuitif dan andal.
                    </p>

                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Quick Link</h5>
                    <table class="table text-center text-white">
                        <tbody class="font-weight-normal">
                            <ul>
                                <li> <a href="user_home.php" style="color: white; text-decoration: none;">Home</a></li>
                                <li><a href="user_aksesapi.php" style="color: white; text-decoration: none;">Akses API</a></li>
                            </ul>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            ©2019 Copyright Supermaret
        </div>
    </footer>
    <!-- footer end -->

    <?php
    // Query untuk mendapatkan data yang akan ditampilkan di chart
    $sql = "SELECT product_line, SUM(quantity) AS total_quantity FROM data_supermarket GROUP BY product_line";
    $result = $conn->query($sql);

    // Inisialisasi array untuk menyimpan data
    $productLines = array();
    $totalQuantities = array();

    // Memasukkan data dari hasil query ke dalam array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productLines[] = $row['product_line'];
            $totalQuantities[] = $row['total_quantity'];
        }
    }


    // Query untuk mendapatkan data penjualan berdasarkan kota
    $sql = "SELECT city, COUNT(*) AS totalSales FROM data_supermarket GROUP BY city";
    $result = $conn->query($sql);

    // Inisialisasi array untuk menyimpan data
    $cities = array();
    $totalSales = array();

    // Memasukkan data dari hasil query ke dalam array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cities[] = $row['city'];
            $totalSales[] = $row['totalSales'];
        }
    }


    // Tutup koneksi
    $conn->close();
    ?>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- bar chart -->

    <script>
        // Mengambil data dari PHP dan menyimpannya ke dalam variabel JavaScript
        var productLines = <?php echo json_encode($productLines); ?>;
        var totalQuantities = <?php echo json_encode($totalQuantities); ?>;

        // Membuat chart menggunakan Chart.js
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: productLines.map(function(label) {
                    return label.split('\n'); // Split the label into two lines
                }),
                datasets: [{
                    label: 'Total Quantity',
                    data: totalQuantities,
                    backgroundColor: [
                        'rgba(255, 255, 255, 0.2)',

                        // Add more colors if there are more product lines
                    ],
                    borderColor: [
                        'rgba(255, 255, 255)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white' // Color of the y-axis labels
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)' // Color of the y-axis grid lines
                        }
                    },
                    x: {
                        ticks: {
                            color: 'white' // Color of the x-axis labels
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)' // Color of the x-axis grid lines
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Color of the legend text
                        }
                    }
                }
            }
        });
    </script>
    <!-- bar chart end -->

    <!-- Donat chart -->
    <script>
        // Mengambil data dari PHP dan menyimpannya dalam variabel JavaScript
        var cities = <?php echo json_encode($cities); ?>;
        var totalSales = <?php echo json_encode($totalSales); ?>;

        // Membuat doughnut chart
        var ctx = document.getElementById('donatChart').getContext('2d');
        var donatChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: cities,
                datasets: [{
                    label: 'Total Sales',
                    data: totalSales,
                    backgroundColor: [
                        'rgba(234, 130, 118)',

                        'rgba(20,12,126,255)',
                        'rgba(152,178,244,255)'

                    ],
                    borderColor: [
                        'rgba(255, 255, 255)'

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                aspectRatio: 1, // Set aspect ratio to 1:1
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white' // Color of the y-axis labels
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)' // Color of the y-axis grid lines
                        }
                    },
                    x: {
                        ticks: {
                            color: 'white' // Color of the x-axis labels
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)' // Color of the x-axis grid lines
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Color of the legend text
                        }
                    }
                }
            }
        });
    </script>
    <!-- Donat chart end -->



</body>

</html>