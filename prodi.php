<?php 
require "koneksi.php";

// 1. PROSES HAPUS DATA (DENGAN PROTEKSI MAHASISWA)
if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($conn, $_GET['hapus']);
    
    // Cek apakah ada mahasiswa di prodi ini
    $queryCek = "SELECT COUNT(*) as total FROM mahasiswa WHERE id_prodi = '$id'";
    $resultCek = mysqli_query($conn, $queryCek);
    $dataCek   = mysqli_fetch_assoc($resultCek);

    if ($dataCek['total'] > 0) {
        // Jika ada mahasiswa, tampilkan error card bawaanmu
        echo "
        <!DOCTYPE html>
        <html lang='id'>
        <head>
            <title>Gagal Menghapus</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css'>
            <style>
                body { background: #f8fafc; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
                .alert-card { max-width: 520px; border: none; border-radius: 22px; box-shadow: 0 15px 40px rgba(0,0,0,0.08); overflow: hidden; }
                .alert-header { background: linear-gradient(135deg, #dc2626, #991b1b); color: white; padding: 1.5rem; }
                .btn-modern { border-radius: 14px; padding: 10px 20px; font-weight: 600; }
            </style>
        </head>
        <body>
            <div class='card alert-card'>
                <div class='alert-header'>
                    <h4 class='mb-0'><i class='bi bi-exclamation-triangle-fill me-2'></i>Gagal Menghapus</h4>
                </div>
                <div class='card-body p-4 text-center'>
                    <p class='text-muted fs-5'>Masih ada <strong>{$dataCek['total']}</strong> mahasiswa yang terdaftar pada program studi ini.</p>
                    <p class='text-secondary'>Pindahkan atau hapus data mahasiswa terlebih dahulu sebelum menghapus program studi.</p>
                    <a href='prodi.php' class='btn btn-danger btn-modern mt-3'><i class='bi bi-arrow-left me-2'></i>Kembali</a>
                </div>
            </div>
        </body>
        </html>";
        exit;
    } else {
        // Jika bersih, eksekusi hapus
        mysqli_query($conn, "DELETE FROM prodi WHERE id = '$id'");
        header("location:prodi.php?pesan=hapus_sukses");
        exit;
    }
}

// 2. PROSES TAMBAH DATA
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $kode = $_POST['kode'];
    $jenjang = $_POST['jenjang'];

    $query = "INSERT INTO prodi (nama, kode, jenjang) VALUES ('$nama', '$kode', '$jenjang')";

    if (mysqli_query($conn, $query)) {
        header("location:prodi.php?pesan=tambah_sukses");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// 3. AMBIL DATA UNTUK TABEL
$sql = "SELECT * FROM prodi ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

include "_header.php";
include "_menu.php";
?>

<style>
    body { background: #f8fafc; }
    .prodi-card { border: none; border-radius: 22px; overflow: hidden; box-shadow: 0 12px 35px rgba(0,0,0,0.07); }
    .card-header-custom { background: linear-gradient(135deg, #2563eb, #1e40af); color: white; padding: 1.8rem; }
    .table-modern thead th { background: #f1f5f9; border: none; color: #334155; font-weight: 700; padding: 16px; }
    .table-modern td { vertical-align: middle; padding: 16px; border-color: #eef2f7; }
    .badge-modern { padding: 8px 14px; border-radius: 50px; font-size: .85rem; font-weight: 600; }
</style>

<div class="container py-4">
    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <strong>Berhasil!</strong> Data prodi telah berhasil <?= $_GET['pesan'] == 'tambah_sukses' ? 'ditambahkan' : 'dihapus'; ?>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card prodi-card">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1"><i class="bi bi-mortarboard-fill me-2"></i>Program Studi</h4>
                <small class="opacity-75">Kelola data program studi kampus</small>
            </div>
            <button class="btn btn-light text-primary fw-bold px-4 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahProdi">Tambah</button>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-modern align-middle">
                    <thead>
                        <tr>
                            <th>Nama Prodi</th>
                            <th>Kode</th>
                            <th>Jenjang</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="fw-bold text-dark"><?= $row["nama"]; ?></td>
                                <td><span class="badge bg-primary-subtle text-primary badge-modern"><?= $row["kode"]; ?></span></td>
                                <td>
                                    <?php
                                    $j = strtoupper(trim($row["jenjang"])); 
                                    if ($j == 'D3') { $bCls = 'bg-warning-subtle text-warning'; $ket = 'Ahli Madya'; }
                                    elseif ($j == 'S1') { $bCls = 'bg-success-subtle text-success'; $ket = 'Sarjana'; }
                                    elseif ($j == 'S2') { $bCls = 'bg-info-subtle text-info'; $ket = 'Magister'; }
                                    else { $bCls = 'bg-secondary-subtle text-secondary'; $ket = 'Setting Jenjang di Edit'; }
                                    ?>
                                    <span class="badge <?= $bCls ?> badge-modern">
                                        <?= ($row["jenjang"] != "" && $row["jenjang"] != "--") ? $row["jenjang"] : "Kosong"; ?> - <?= $ket ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="edit_prodi.php?id=<?= $row["id"]; ?>" class="btn btn-outline-warning rounded-3 me-2"><i class="bi bi-pencil-square"></i></a>
                                    <a href="prodi.php?hapus=<?= $row["id"]; ?>" class="btn btn-outline-danger rounded-3" onclick="return confirm('Hapus?')"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahProdi" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title">Tambah Prodi Baru</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="prodi.php" method="POST">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Prodi</label>
                        <input type="text" name="nama" class="form-control" placeholder="Teknik Informatika" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode</label>
                        <input type="text" name="kode" class="form-control" placeholder="TI" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Jenjang</label>
                        <select name="jenjang" class="form-select" required>
                            <option value="" selected disabled>-- Pilih --</option>
                            <option value="D3">D3 - Ahli Madya</option>
                            <option value="S1">S1 - Sarjana</option>
    
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" name="tambah" class="btn btn-primary w-100 rounded-pill py-2">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "_footer.php"; ?>