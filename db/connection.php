<?php

//file koneksi ke database
//memanggil file konfigurasi database
include 'config.php';

//menyambungkan ke database
$conn = mysqli_connect($host, $username, $password, $db);

//testing koneksi
//menampilkan pesan error apabila gagal melakukan koneksi
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

?>