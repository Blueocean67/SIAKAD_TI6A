<?php
require "koneksi.php";

// 1. LOGIKA HAPUS DATA (Tetap di sini supaya tidak pindah-pindah file)
if (isset($_GET['hapus'])) {
    $nim = mysqli_real_escape_string($conn, $_GET['hapus']);
    $delete = mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim = '$nim'");
    if ($delete) {
        // Setelah hapus, balik lagi ke mahasiswa.php
        header("location:mahasiswa.php?pesan=hapus_sukses");
        exit;
    }
}

// 2. LOGIKA TAMBAH DATA
if (isset($_POST['tambah'])) {
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $id_prodi = mysqli_real_escape_string($conn, $_POST['id_prodi']);

    $insert = mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama, id_prodi) VALUES ('$nim', '$nama', '$id_prodi')");
    if ($insert) {
        header("location:mahasiswa.php?pesan=tambah_sukses");
        exit;
    }
}

// Ambil semua data mahasiswa untuk tabel
$sql = "SELECT mahasiswa.*, prodi.nama AS nama_prodi, prodi.jenjang 
        FROM mahasiswa 
        LEFT JOIN prodi ON mahasiswa.id_prodi = prodi.id 
        ORDER BY mahasiswa.nim DESC";
$result = mysqli_query($conn, $sql);

// Ambil opsi prodi untuk dropdown modal tambah
$prodi_options = mysqli_query($conn, "SELECT * FROM prodi ORDER BY nama ASC");

include "_header.php";
include "_menu.php";
?>

<style>
    body { background: #f8fafc; }
    .data-card { border: none; border-radius: 22px; overflow: hidden; box-shadow: 0 12px 35px rgba(0,0,0,0.08); }
    .card-header-custom { background: linear-gradient(135deg, #2563eb, #1e40af); color: white; padding: 1.5rem; }
    .table-modern thead th { background: #f1f5f9; border: none; font-weight: 700; color: #334155; padding: 16px; }
    .table-modern td { padding: 16px; vertical-align: middle; }
    .badge-modern { padding: 8px 14px; border-radius: 50px; font-weight: 600; }
    .action-btn { width: 24px; height: 16px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; transition: .25s; }
</style>

<div class="container py-4">

    <!-- Notifikasi Pesan -->
    <?php if(isset($_GET['pesan'])): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <i class="bi bi-check-circle-fill me-2"></i>
            Data mahasiswa berhasil <?= $_GET['pesan'] == 'tambah_sukses' ? 'disimpan' : 'dihapus'; ?>!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card data-card">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1"><i class="bi bi-diagram-3-fill me-2"></i>Data Mahasiswa</h4>
                <small class="opacity-75">Kelola data mahasiswa dan program studi</small>
            </div>
            <button class="btn btn-light text-primary fw-bold px-4 shadow-sm" style="border-radius: 12px;" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg me-1"></i>Tambah Data
            </button>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-modern align-middle">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Program Studi</th>
                            <th>Jenjang</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><span class="badge bg-primary-subtle text-primary badge-modern"><?= $row["nim"]; ?></span></td>
                                    <td class="fw-semibold text-dark"><?= $row["nama"]; ?></td>
                                    <td><?= $row["nama_prodi"] ?? '<span class="text-danger">Prodi terhapus</span>'; ?></td>
                                    <td>
                                        <?php 
                                            $j = strtoupper(trim($row['jenjang'] ?? ''));
                                            if ($j == 'S1') { $color = 'success'; $ket = 'Sarjana'; }
                                            elseif ($j == 'D3') { $color = 'warning'; $ket = 'Ahli Madya'; }
                                            else { $color = 'secondary'; $ket = 'N/A'; }
                                        ?>
                                        <span class="badge bg-<?= $color; ?>-subtle text-<?= $color; ?> badge-modern">
                                            <?= ($row['jenjang'] ?: 'N/A') ?> - <?= $ket ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <!-- Tombol Edit: Mengarah ke file edit_mahasiswa.php kamu -->
                                        <a href="edit_mahasiswa.php?nim=<?= $row['nim']; ?>" class="btn btn-outline-warning action-btn me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <!-- Tombol Hapus: Mengarah ke file ini sendiri (mahasiswa.php) -->
                                        <a href="mahasiswa.php?hapus=<?= $row['nim']; ?>" class="btn btn-outline-danger action-btn" onclick="return confirm('Hapus data <?= $row['nama']; ?>?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i> Belum ada data.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0" style="border-radius: 22px;">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title fw-bold">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="mahasiswa.php" method="POST">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">NIM</label>
                        <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Program Studi & Jenjang</label>
                        <select name="id_prodi" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Prodi --</option>
                            <?php 
                            mysqli_data_seek($prodi_options, 0);
                            while($p = mysqli_fetch_assoc($prodi_options)): 
                            ?>
                                <option value="<?= $p['id']; ?>">
                                    <?= $p['nama']; ?> (<?= $p['jenjang']; ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 fw-bold rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn btn-primary px-4 fw-bold rounded-pill">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "_footer.php"; ?>