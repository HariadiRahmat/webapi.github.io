<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket Data Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="homestyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap' rel='stylesheet' type='text/css'>
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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_aksesapi.php">Akses API</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- layouting -->
    <div class="container mt-5 sm-md-lg">
        <div class="row">

            <div class="col-12 col-md-6 col-lg-4 mx-auto order-last order-md-first ">
                <h1 class="custom-heading">STATISTIK SUPERMARKET 2019</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus illum fugit commodi, mollitia eius expedita, consequatur minus doloremque voluptatum blanditiis inventore hic? Aspernatur quae ducimus iusto in, rerum deleniti quos consectetur necessitatibus, illo, neque velit?</p>

                <!-- <a id="btn" class="btn custom-button mb-5" href="#section1" role="button">Lihat statistik</a>
                -->
            </div>

            <div class=" mt-5 col-12 col-md-6 col-lg-8 mx-auto order-first order-md-last">
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
        <div class="container text-center ">
            <h1>Statistik Market 2019</h1>
        </div>
        <div class="container text-center ">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6 mx-auto">
                    <p>grafik 1</p>
                </div>
                <div>
                    <canvas id="myChart" width="200" height="50"></canvas>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 mb-5">
                <p>grafik 2</p>
            </div>
        </div>
        </div>
    </section>

    <!-- section grafik -->

    <!-- footer -->

    <div class="">
        <footer class="text-white text-center text-lg-start" style="background-color: #23242a;">
            <!-- Grid container -->
            <div class="container p-4">
                <!--Grid row-->
                <div class="row mt-4">
                    <!--Grid column-->
                    <div class="col-lg-8 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase mb-4">About company</h5>
                        <p>
                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                            voluptatum deleniti atque corrupti.
                        </p>
                        <p>
                            Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas
                            molestias.
                        </p>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase mb-4">Opening hours</h5>
                        <table class="table text-center text-white">
                            <tbody class="font-weight-normal">

                            </tbody>
                        </table>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                ©2019 Copyright Supermaret
            </div>
            <!-- Copyright -->
        </footer>




        <?php
        // Koneksi database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "supermarket";

        // Buat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Cek koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

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

        // Tutup koneksi
        $conn->close();
        ?>

        <script>
            // Mengambil data dari PHP dan menyimpannya ke dalam variabel JavaScript
            var productLines = <?php echo json_encode($productLines); ?>;
            var totalQuantities = <?php echo json_encode($totalQuantities); ?>;

            // Membuat chart menggunakan Chart.js
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: productLines,
                    datasets: [{
                        label: 'Total Quantity',
                        data: totalQuantities,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
</body>

</html>