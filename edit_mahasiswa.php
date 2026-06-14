<?php
require "koneksi.php";
include "_header.php"; 
include "_menu.php";

// 1. Ambil data mahasiswa berdasarkan NIM (karena tabel kita pakai NIM sebagai primary)
if (isset($_GET['nim'])) {
    $nim = mysqli_real_escape_string($conn, $_GET['nim']);
    $data = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");
    $row = mysqli_fetch_assoc($data);
}

// 2. Ambil daftar prodi untuk pilihan dropdown
$tampil_prodi = mysqli_query($conn, "SELECT * FROM prodi ORDER BY nama ASC");

// 3. Proses Update Data
if (isset($_POST['submit'])) {
    $nim_lama = mysqli_real_escape_string($conn, $_POST['nim_lama']);
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $id_prodi = mysqli_real_escape_string($conn, $_POST['id_prodi']);

    $query = "UPDATE mahasiswa SET nama='$nama', id_prodi='$id_prodi' WHERE nim='$nim_lama'";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Berhasil Diubah!'); window.location='mahasiswa.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header bg-primary text-white p-3">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Ubah Data Mahasiswa</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <!-- Input Hidden untuk kunci NIM -->
                        <input type="hidden" name="nim_lama" value="<?= $row['nim']; ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold">NIM</label>
                            <input type="text" name="nim" class="form-control bg-light" value="<?= $row['nim']; ?>" readonly>
                            <small class="text-muted">NIM tidak dapat diubah.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?= $row['nama']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Program Studi</label>
                            <select name="id_prodi" class="form-select" required>
                                <option value="">-- Pilih Program Studi --</option>
                                <?php while($p = mysqli_fetch_array($tampil_prodi)) { ?>
                                    <option value="<?= $p['id']; ?>" <?= ($p['id'] == $row['id_prodi']) ? 'selected' : ''; ?>>
                                        <?= $p['nama']; ?> (<?= $p['jenjang']; ?>)
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                                    
                        <div class="d-flex justify-content-between mt-4">
                            <a href="mahasiswa.php" class="btn btn-secondary px-4" style="border-radius: 10px;">Batal</a>
                            <button type="submit" name="submit" class="btn btn-primary px-4" style="border-radius: 10px;">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "_footer.php"; ?>