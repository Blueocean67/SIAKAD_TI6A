<?php 
require "koneksi.php";

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM prodi WHERE id = '$id'");
    header("location:prodi.php?pesan=hapus_sukses");
    exit;
}

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $kode = $_POST['kode'];
    $jenjang = $_POST['jenjang'];
    mysqli_query($conn, "INSERT INTO prodi (nama, kode, jenjang) VALUES ('$nama', '$kode', '$jenjang')");
    header("location:prodi.php?pesan=tambah_sukses");
    exit;
}

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
                                    
                                    if ($j == 'D3') {
                                        $bCls = 'bg-warning-subtle text-warning'; $ket = 'Ahli Madya';
                                    } elseif ($j == 'S1') {
                                        $bCls = 'bg-success-subtle text-success'; $ket = 'Sarjana';
                                    } elseif ($j == 'S2') {
                                        $bCls = 'bg-info-subtle text-info'; $ket = 'Magister';
                                    } else {
                                      
                                        $bCls = 'bg-secondary-subtle text-secondary'; $ket = 'Setting Jenjang di Edit';
                                    }
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
            <form action="" method="POST">
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