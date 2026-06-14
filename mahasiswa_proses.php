<?php
require "koneksi.php";

if (isset($_POST['tambah'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $id_prodi = $_POST['id_prodi'];

   
    $cek_nim = mysqli_query($conn, "SELECT nim FROM mahasiswa WHERE nim = '$nim'");
    
    if (mysqli_num_rows($cek_nim) > 0) {
       
        echo "<script>alert('Error: NIM $nim sudah terdaftar!'); window.history.back();</script>";
    } else {
        
        $query = "INSERT INTO mahasiswa (nim, nama, id_prodi) VALUES ('$nim', '$nama', '$id_prodi')";
        
        if (mysqli_query($conn, $query)) {
            header("location:mahasiswa.php?pesan=sukses");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>