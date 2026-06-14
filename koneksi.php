<?php

// membuat koneksi dengan server mysql
$localhost = "localhost";
$uname = "root";
$pword = "";
$dbname = "db_siakad_ti6a";

$conn = mysqli_connect($localhost, $uname, $pword, $dbname);
// cek koneksi 
if (!$conn) {
    die("koneksi gagal; " . mysqli_connect_error());
}else {
    echo "koneksi berhasil";
}