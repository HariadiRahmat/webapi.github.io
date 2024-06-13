<?php
// data biasa
if (isset($_FILES['foto'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    // data gambar
    $file_name = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    // inisilisasi data gambar
    $data_gambar = file_get_contents($file_tmp);
    $data_parts = pathinfo($file_name);
    $data_extention = $data_parts['extension'];

    // ubah gambar menjadi string
    $gambar_base64 = base64_encode($data_gambar);

    $inputPost = array(
        'nim' => $nim,
        'nama' => $nama,
        'alamat' => $alamat,
        'stringfoto' => $gambar_base64,
        'extfoto' => $data_extention,

    );

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://localhost/apimhs/uploadfotobase64.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $inputPost,

    ));

    $responses = curl_exec($curl);

    curl_close($curl);
}
