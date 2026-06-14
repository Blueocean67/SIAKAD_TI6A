<?php
require "koneksi.php";

if (isset($_POST['tambah'])) {
    
    $nama = $_POST['nama'];
    $kode = $_POST['kode'];
    $jenjang = $_POST['jenjang'];

    $query = "INSERT INTO prodi (nama, kode, jenjang) VALUES ('$nama', '$kode', '$jenjang')";
    
    if (mysqli_query($conn, $query)) {
        header("location:prodi.php?pesan=sukses");
    } else {
      
        echo "Error: " . mysqli_error($conn);
    }
}
?>