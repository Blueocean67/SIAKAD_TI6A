<?php
include "_header.php";
include "_menu.php";
require "koneksi.php";

// Hitung data
$jmlMahasiswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mahasiswa"))['total'];
$jmlProdi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM prodi"))['total'];
?>

<style>
    body {
        background: #f8fafc;
    }

    .hero-card {
        background: linear-gradient(135deg, #2563eb, #1e40af);
        border-radius: 24px;
        color: white;
        overflow: hidden;
        position: relative;
        box-shadow: 0 15px 40px rgba(37, 99, 235, 0.25);
    }

    .hero-card::before {
        content: "";
        position: absolute;
        top: -40px;
        right: -40px;
        width: 180px;
        height: 180px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }

    .hero-card::after {
        content: "";
        position: absolute;
        bottom: -60px;
        left: -60px;
        width: 220px;
        height: 220px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }

    .stat-card {
        border: none;
        border-radius: 22px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.07);
        transition: .3s ease;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(0,0,0,0.12);
    }

    .icon-box {
        width: 65px;
        height: 65px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .bg-soft-primary {
        background: #dbeafe;
        color: #2563eb;
    }

    .bg-soft-success {
        background: #dcfce7;
        color: #16a34a;
    }

    .welcome-card {
        border-radius: 22px;
        border: none;
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    }

    .quick-btn {
        border-radius: 14px;
        padding: 12px 18px;
        font-weight: 600;
        transition: .25s;
    }

    .quick-btn:hover {
        transform: scale(1.04);
    }
</style>

<div class="container py-4">

    <!-- Hero Section -->
    <div class="hero-card p-5 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="fw-bold mb-3">
                    Selamat Datang di SIAKAD TI-6A
                </h1>
                <p class="mb-4 opacity-75 fs-5">
                    Sistem Informasi Akademik modern untuk mengelola data mahasiswa dan program studi dengan cepat, rapi, dan efisien.
                </p>

                <a href="mahasiswa.php" class="btn btn-light text-primary px-4 py-2 rounded-pill fw-semibold me-2">
                    <i class="bi bi-people-fill me-2"></i>Data Mahasiswa
                </a>

                <a href="prodi.php" class="btn btn-outline-light px-4 py-2 rounded-pill fw-semibold">
                    <i class="bi bi-mortarboard-fill me-2"></i>Program Studi
                </a>
            </div>

            <div class="col-md-4 text-center">
                <i class="bi bi-laptop display-1 opacity-75"></i>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row g-4 mb-4">

        <div class="col-md-6">
            <div class="card stat-card p-4">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-soft-primary me-3">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Mahasiswa</h6>
                        <h2 class="fw-bold mb-0"><?= $jmlMahasiswa ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card stat-card p-4">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-soft-success me-3">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Program Studi</h6>
                        <h2 class="fw-bold mb-0"><?= $jmlProdi ?></h2>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="card welcome-card p-4">
        <h4 class="fw-bold text-primary mb-3">
            <i class="bi bi-info-circle-fill me-2"></i>Informasi Dashboard
        </h4>

        <p class="text-muted mb-4">
            Dashboard ini digunakan untuk mengelola data akademik kampus seperti data mahasiswa dan program studi secara terintegrasi.
        </p>

        <div class="d-flex flex-wrap gap-3">
            <a href="mahasiswa.php" class="btn btn-primary quick-btn">
                Kelola Mahasiswa
            </a>

            <a href="prodi.php" class="btn btn-success quick-btn">
                Kelola Prodi
            </a>
        </div>
    </div>

</div>

<?php
include "_footer.php";
?>