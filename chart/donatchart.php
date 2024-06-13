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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doughnut Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <canvas id="myChart" width="100" height="40"></canvas>
    <script>
        // Mengambil data dari PHP dan menyimpannya dalam variabel JavaScript
        var cities = <?php echo json_encode($cities); ?>;
        var totalSales = <?php echo json_encode($totalSales); ?>;

        // Membuat doughnut chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: cities,
                datasets: [{
                    label: 'Total Sales',
                    data: totalSales,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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