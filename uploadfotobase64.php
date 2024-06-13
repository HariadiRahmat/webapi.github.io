<?php
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$result = array();

if ($method == 'POST') {
    // Mengecek apakah semua parameter yang diperlukan ada
    if (isset($_POST['nim']) && isset($_POST['nama']) && isset($_POST['alamat'])) {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];

        // tangkap foto
        $stringfoto = $_POST['stringfoto']; // foto dalam bentuk string
        $extfoto = $_POST['extfoto'];
        // foto string di ubah jadi gambar kembali
        $foto = base64_decode($stringfoto);

        //simpan gambar hasil decode base64
        file_put_contents('foto/' . $nim . '.' . $extfoto, $foto);
        // membuat nama foto 
        $nama_foto = $nim . '.' . $extfoto;

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kemahasiswaan";

        // Membuat koneksi ke database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Mengecek koneksi
        if ($conn->connect_error) {
            $result['status'] = [
                'code' => 500,
                'description' => 'Koneksi Gagal: ' . $conn->connect_error
            ];
        } else {
            // Membuat query untuk memasukkan data ke tabel mahasiswa
            $sql = "INSERT INTO mahasiswa (nim, nama, alamat, foto) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Periksa apakah statement berhasil dipersiapkan
            if ($stmt) {
                // Bind parameter ke statement
                $stmt->bind_param("ssss", $nim, $nama, $alamat, $nama_foto);

                // Mengeksekusi query
                if ($stmt->execute()) {
                    $result['status'] = [
                        'code' => 200,
                        'description' => 'Request Valid'
                    ];
                    $result['result'] = [
                        'nim' => $nim,
                        'nama' => $nama,
                        'alamat' => $alamat
                    ];
                } else {
                    $result['status'] = [
                        'code' => 500,
                        'description' => 'Error: ' . $stmt->error
                    ];
                }
                $stmt->close();
            } else {
                $result['status'] = [
                    'code' => 500,
                    'description' => 'Error: Unable to prepare statement'
                ];
            }
            $conn->close();
        }
    } else {
        $result['status'] = [
            'code' => 400,
            'description' => 'Parameter Invalid'
        ];
    }
} else {
    $result['status'] = [
        'code' => 400,
        'description' => 'Method Not Valid'
    ];
}

// Mengkonversi array PHP menjadi format JSON dan mengirimkannya kembali ke klien
echo json_encode($result);
