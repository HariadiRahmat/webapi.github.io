<?php
// Menghubungkan ke database
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "supermarket";

// Membuat koneksi
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mendapatkan data penjualan berdasarkan gender dan kota
$sql = "SELECT city, gender, COUNT(*) AS totalSales FROM data_supermarket GROUP BY city, gender";
$result = $conn->query($sql);

// Inisialisasi array untuk menyimpan data
$cities = array();
$totalSalesMale = array();
$totalSalesFemale = array();

// Memasukkan data dari hasil query ke dalam array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cities[] = $row['city'];
        if ($row['gender'] == 'Male') {
            $totalSalesMale[] = $row['totalSales'];
            $totalSalesFemale[] = 0;
        } else {
            $totalSalesFemale[] = $row['totalSales'];
            $totalSalesMale[] = 0;
        }
    }
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <canvas id="myChart" width="400" height="400"></canvas>
    <script>
        // Mengambil data dari PHP dan menyimpannya dalam variabel JavaScript
        var cities = <?php echo json_encode($cities); ?>;
        var totalSalesMale = <?php echo json_encode($totalSalesMale); ?>;
        var totalSalesFemale = <?php echo json_encode($totalSalesFemale); ?>;

        // Membuat bar chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: cities,
                datasets: [{
                        label: 'Male',
                        data: totalSalesMale,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Female',
                        data: totalSalesFemale,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
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