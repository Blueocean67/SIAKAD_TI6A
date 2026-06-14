<?php
require "koneksi.php";

// Disamakan dengan link di mahasiswa.php yang pakai ?hapus=...
if (isset($_GET['hapus'])) {
    // Variabel diganti jadi $nim sesuai kolom di database kamu
    $nim = mysqli_real_escape_string($conn, $_GET['hapus']);

    // Cek data berdasarkan NIM
    $cek = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");

    if (mysqli_num_rows($cek) > 0) {

        // Eksekusi hapus berdasarkan NIM
        $hapus = mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim='$nim'");

        if ($hapus) {
            echo "
            <script>
                alert('Data mahasiswa berhasil dihapus!');
                window.location='mahasiswa.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Gagal menghapus data!');
                window.location='mahasiswa.php';
            </script>";
        }

    } else {
        echo "
        <script>
            alert('Data tidak ditemukan!');
            window.location='mahasiswa.php';
        </script>";
    }

} else {
    // Tampilan error tetap seperti permintaanmu
    echo "
    <div style='
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
        font-family:Arial;
        background:#f8fafc;
    '>
        <div style='
            background:white;
            padding:30px;
            border-radius:18px;
            box-shadow:0 12px 30px rgba(0,0,0,0.08);
            text-align:center;
        '>
            <h2 style='color:#dc2626;'>Data Tidak Ditemukan</h2>
            <p style='color:#64748b;'>Permintaan hapus tidak valid.</p>
            <a href='mahasiswa.php' style='
                display:inline-block;
                margin-top:15px;
                padding:10px 20px;
                background:#2563eb;
                color:white;
                text-decoration:none;
                border-radius:12px;
            '>Kembali</a>
        </div>
    </div>";
}
?>