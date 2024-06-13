<?php
session_start();

$loginError = '';
$registerError = '';
$conn = null; // Inisialisasi variabel koneksi

if (isset($_POST['login'])) {
    // Proses login
} elseif (isset($_POST['register'])) {
    // Proses registrasi
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];

    // Inisialisasi koneksi
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

    // Check if the username already exists
    $sql = "SELECT * FROM user WHERE username='$newUsername'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $registerError = "Username already exists";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO user (username, password) VALUES ('$newUsername', '$newPassword')";
        if ($conn->query($sql) === TRUE) {
            // Registration successful, redirect to login page

            header("Location: user_login.php"); // Ganti 'login.php' dengan nama file login Anda
            exit(); // Pastikan tidak ada output tambahan yang disertakan di halaman
        } else {
            $registerError = "Error: " . $sql . "<br>" . $conn->error;
        }
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


    <!-- Registration form -->
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-white" style="border-radius: 1rem;">

                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                                <p class="text-white-50 mb-5">Create a new account</p>

                                <form action="" method="post" enctype="multipart/form-data">
                                    <input class="form-control my-5" type="text" placeholder="New Username" aria-label="default input example" name="new_username" required>
                                    <input class="form-control my-5" type="password" placeholder="New Password" aria-label="default input example" name="new_password" required>

                                    <?php
                                    if (!empty($registerError)) {
                                        echo '<p style="color:red;">' . $registerError . '</p>';
                                    }
                                    ?>

                                    <input class="btn btn-outline-light btn-lg px-4" type="submit" name="register" value="Register">
                                </form>

                                <div>
                                    <div class="mt-4">
                                        <a href="user_register.php" style="color: white; text-decoration: none;">
                                            <span style="transition: color 0.3s;">Sudah memiliki akun? login sekarang</span>
                                        </a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Registration form end -->




</body>

</html>