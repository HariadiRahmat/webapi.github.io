<?php
//print_r($_FILES);
if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $data = file_get_contents($file_tmp);
    $path_parts = pathinfo($file_name);
    $ext = $path_parts['extension'];
    // $base64 = 'data:image/' . $type . ';base64,' .
    base64_encode($data);
    $base64 = base64_encode($data);
    // $de = base64_decode($base64);
    // echo '<img src="' . $de . '" />';
    // Prepare remote upload data
    $uploadRequest = array(
        'nim' => $_POST['nim'],
        'nama_mhs' => $_POST['nama_mhs'],
        'alamat' => $_POST['alamat'],
        'fileExtension' => $ext,
        'fileUpload' => $base64
    );
    // send request api
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://localhost/php-simpleapi/
prak8-imageupload/insertimagebase64.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $uploadRequest,
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}
36
?>
<form action="" method="POST" enctype="multipart/form-data">
    <p>
        <input type="text" name="nim" placeholder="nim"><br />
        <input type="text" name="nama_mhs" placeholder="nama_mhs"><br />
        <input type="text" name="alamat" placeholder="alamat"><br />
        <input type="file" name="image" /><br />
        <input type="submit" value="Upload">
    </p>
</form>