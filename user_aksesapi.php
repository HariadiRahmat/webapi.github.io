<?php
session_start();

$apiKey = '';

if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "supermarket";

    $token = md5($username . $password);

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Cek user dan update API key
    $sql = "UPDATE user SET api_key='$token' WHERE username='$username' AND password='$password'";
    if ($conn->query($sql) === TRUE) {
        $apiKey = $token;
    } else {
        $apiKey = "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="useraksesapi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



    <link rel="stylesheet" href="aksesapi.css">

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
                        <a class="nav-link" aria-current="page" href="user_home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Akses API</a>
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
    <div class="container  sm-md-lg">
        <div class="row">

            <div class="col-12 col-md-6 col-lg-4 mx-auto order-last order-md-first ">
                <h1 class="custom-heading">Selamat datang, developers!</h1>
                <p>Kami menyediakan RESTful API (Application Programming Interface) yang dapat Anda pakai untuk membuat berbagai macam aplikasi yang membutuhkan Supermarket. Supermarket diambil langsung dari web masing-masing kurir untuk menjaga akurasi data. Namun, jika Anda menemukan data yang tidak valid, silakan laporkan ke tim kami.

                </p>
                <form action="" method="post">
                    <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                    <input class="btn btn-primary custom-button" type="submit" name="submit" value="Dapatkan API Key">
                </form>
                <!-- form generate api end -->

                <?php if (!empty($apiKey)) { ?>
                    <div class="alert alert-success mt-3 custom-alert">Api :
                        <span id="apiKey"><?php echo $apiKey; ?></span>
                        <button class="copy-button" onclick="copyApiKey()">
                            <i class="fas fa-copy"></i> <!-- Ikon copy dari Font Awesome -->
                        </button>
                        <div id="copyMessage" class="copy-message" style="display: none;">API Key telah disalin ke clipboard!</div>
                    </div>
                <?php } ?>


                <!-- <a id="btn" class="btn custom-button mb-5" href="#section1" role="button">Lihat statistik</a>
                 -->
            </div>

            <div class=" col-12 col-md-6 col-lg-8 mx-auto order-first order-md-last">
                <img src="7100372.jpg" alt="banner" class="img-fluid">
            </div>
        </div>
    </div>
    <!-- layouting end -->












    <div class="container mt-5 pt-5">



        <h1>Dokumentasi API</h1>
        <p>Dalam rangka mempermudah Anda menggunakan API RajaOngkir serta menjalin kerja sama yang saling menguntungkan, kami menyusun petunjuk penggunaan API yang harus diikuti:

            Anda diperkenankan melakukan cache untuk hasil province, city, subdistrict, internationalOrigin, dan internationalDestination. Cache ini dapat Anda manfaatkan untuk membuat fitur auto-complete nama kota atau semisalnya.
            Endpoint selain yang disebut pada nomor 1, harus di-request secara langsung (tidak boleh di-cache) untuk mendapatkan hasil yang akurat.
            Dilarang menggunakan bot, cron, atau script otomatis yang melakukan request ke RajaOngkir tanpa action dari user. Seperti 'dumping' data ongkir, auto-update status nomor resi, dan lain-lain. Hal ini dapat memberatkan server ekspedisi sehingga berpengaruh pada semua user.</p>

        <main class="main" id="top">




            <div class="container">
                <h2>Request</h2>
                <div class="tab">
                    <div class="active" onclick="showTab(event, 'url')">URL</div>
                </div>
                <div class="content request d-flex " id="url">
                    <div style="margin-right: 20px;">
                        <p><strong>Method</strong></p>
                        <p>GET</p>
                    </div>
                    <div>
                        <p><strong>URL</strong></p>
                        <p>http://localhost/apisupermarketpbl/getalldata</p>
                    </div>
                </div>
                <h2>Response</h2>
                <div class="tab">
                    <div class="active" onclick="showTab(event, 'response-sukses')">Response sukses</div>
                    <div onclick="showTab(event, 'response-gagal')">Response gagal</div>
                </div>
                <div class="content response" id="response-sukses">
                    <pre>
{
   
    "status": {
        "code": 200,
        "description": "request valid"
    },
    "results": [
        {
            "id": "1",
            "Invoice_ID": "750-67-8428",
            "Branch": "A",
            "City": "Yangon",
            "Customer_type": "Member",
            "Gender": "Female",
            "Product_line": "Health and beauty",
            "Unit_price": "74.69",
            "Quantity": "7",
            "Tax_5_percen": "261",
            "Total": "5",
            "Date": "2019-01-05",
            "Time": "13:08:00",
            "Payment": "Ewallet",
            "Cogs": "522.83",
            "Gross_margin_percentage": "4761900000",
            "Gross_income": "261",
            "Rating": "9.1"
        },
}
                </pre>
                </div>
                <div class="content response hidden" id="response-gagal">
                    <pre>

  {
    "status": {
        "code": 400,
        "description": "key not valid"
    }
}
                </pre>
                </div>
            </div>

        </main>
    </div>


    <div class="mb-5 pb-5"></div>
    <div class="mb-5 pb-5"></div>



    <!-- footer -->
    <footer class="text-white text-center text-lg-start" style="background-color: #23242a;">
        <div class="container p-4">
            <div class="row mt-4">
                <div class="col-lg-8 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">About company</h5>
                    <p>Kami adalah perusahaan terkemuka dalam penyediaan solusi data dan analisis untuk industri ritel, khususnya supermarket. Sejak berdiri pada tahun 2018, kami berkomitmen membantu bisnis supermarket mengoptimalkan operasional mereka dengan menyediakan platform statistik yang intuitif dan andal.</p>
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
            ©2019 Copyright Supermarket
        </div>
    </footer>
    <!-- footer end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        function copyApiKey() {
            // Dapatkan elemen yang berisi API key
            var apiKeyElement = document.getElementById('apiKey');
            var apiKey = apiKeyElement.textContent;

            // Buat elemen teks sementara
            var tempInput = document.createElement('input');
            tempInput.value = apiKey;
            document.body.appendChild(tempInput);

            // Salin nilai dari elemen teks sementara ke clipboard
            tempInput.select();
            document.execCommand('copy');

            // Hapus elemen teks sementara
            document.body.removeChild(tempInput);

            // Beri feedback kepada pengguna bahwa API key telah disalin
            alert('API Key telah disalin ke clipboard!');
        }
    </script>
    <script>
        function showTab(event, tabId) {
            var tabs = document.querySelectorAll('.tab div');
            var contents = document.querySelectorAll('.content.response');

            tabs.forEach(tab => {
                tab.classList.remove('active');
            });

            contents.forEach(content => {
                content.classList.add('hidden');
            });

            event.currentTarget.classList.add('active');
            document.getElementById(tabId).classList.remove('hidden');
        }
    </script>

    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
</body>

</html>