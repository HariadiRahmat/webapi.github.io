<?php
session_start();

$loginError = '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

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

    // Cek user
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login berhasil, atur session dan arahkan ke halaman home
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("Location: user_home.php"); // Arahkan ke halaman home
        exit(); // Pastikan tidak ada output tambahan yang disertakan di halaman
    } else {
        $loginError = "Username atau password salah";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <!-- form login -->
    <section class="vh-100 gradient-custom">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card text-white" style="border-radius: 1rem;">

                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">


                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                    <input class="form-control my-5" type="text" placeholder="Username" aria-label="default input example" name="username" required>


                                    <input class="form-control my-5" type="text" placeholder="Password" aria-label="default input example" name="password" required>

                                    <?php

                                    if (!empty($loginError)) {
                                        echo '<p style="color:red;">' . $loginError . '</p>';
                                    }
                                    ?>

                                    <input class="btn btn-outline-light btn-lg px-4" type="submit" name="submit">

                                    <div class="mt-4">
                                        <a href="user_register.php" style="color: white; text-decoration: none;">
                                            <span style="transition: color 0.3s;">Belum memiliki akun? Daftar sekarang</span>
                                        </a>
                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- form login end -->




    






</body>

</html>