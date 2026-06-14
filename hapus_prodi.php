<?php
require "koneksi.php";

// Validasi ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: prodi.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

$queryCek = "SELECT COUNT(*) as total FROM mahasiswa WHERE id_prodi = '$id'";
$resultCek = mysqli_query($conn, $queryCek);
$dataCek   = mysqli_fetch_assoc($resultCek);

if ($dataCek['total'] > 0) {
    echo "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <title>Gagal Menghapus</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css'>
        <style>
            body {
                background: #f8fafc;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }

            .alert-card {
                max-width: 520px;
                border: none;
                border-radius: 22px;
                box-shadow: 0 15px 40px rgba(0,0,0,0.08);
                overflow: hidden;
            }

            .alert-header {
                background: linear-gradient(135deg, #dc2626, #991b1b);
                color: white;
                padding: 1.5rem;
            }

            .btn-modern {
                border-radius: 14px;
                padding: 10px 20px;
                font-weight: 600;
            }
        </style>
    </head>
    <body>

        <div class='card alert-card'>
            <div class='alert-header'>
                <h4 class='mb-0'>
                    <i class='bi bi-exclamation-triangle-fill me-2'></i>
                    Gagal Menghapus
                </h4>
            </div>

            <div class='card-body p-4 text-center'>
                <p class='text-muted fs-5'>
                    Masih ada <strong>{$dataCek['total']}</strong> mahasiswa yang terdaftar pada program studi ini.
                </p>

                <p class='text-secondary'>
                    Pindahkan atau hapus data mahasiswa terlebih dahulu sebelum menghapus program studi.
                </p>

                <a href='prodi.php' class='btn btn-danger btn-modern mt-3'>
                    <i class='bi bi-arrow-left me-2'></i>Kembali
                </a>
            </div>
        </div>

    </body>
    </html>";
    exit;
}

// Hapus prodi
$queryHapus = "DELETE FROM prodi WHERE id = '$id'";
$eksekusi   = mysqli_query($conn, $queryHapus);

if ($eksekusi) {
    header("Location: prodi.php?pesan=berhasil");
} else {
    header("Location: prodi.php?pesan=gagal");
}
exit;
?>