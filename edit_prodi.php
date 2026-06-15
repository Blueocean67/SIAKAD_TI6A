<?php
require "koneksi.php";
include "_header.php";
include "_menu.php";

// 1. AMBIL DATA LAMA BERDASARKAN ID UNTUK DITAMPILKAN DI FORM
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $data = mysqli_query($conn, "SELECT * FROM prodi WHERE id='$id'");
    $row = mysqli_fetch_assoc($data);
}

// 2. PROSES UPDATE DATA KETIKA TOMBOL SIMPAN DIKLIK
if (isset($_POST['submit'])) {
    $id      = $_POST['id'];
    $nama    = $_POST['nama'];
    $kode    = $_POST['kode'];
    $jenjang = $_POST['jenjang'];

    $query = "UPDATE prodi SET 
                nama='$nama', 
                kode='$kode', 
                jenjang='$jenjang' 
              WHERE id='$id'";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Prodi Berhasil Diubah!'); window.location='prodi.php';</script>";
        exit;
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
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Ubah Data Program Studi</h5>
                </div>
                <div class="card-body p-4">
                    <form action="edit_prodi.php?id=<?= $row['id']; ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Program Studi</label>
                            <input type="text" name="nama" class="form-control" value="<?= $row['nama']; ?>" placeholder="Contoh: Teknik Informatika" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kode Prodi</label>
                            <input type="text" name="kode" class="form-control" value="<?= $row['kode']; ?>" placeholder="Contoh: 01" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenjang</label>
                            <select name="jenjang" class="form-select" required>
                                <option value="">-- Pilih Jenjang --</option>
                                <option value="D3" <?= ($row['jenjang'] == 'D3') ? 'selected' : ''; ?>>D3 - Ahli Madya</option>
                                <option value="S1" <?= ($row['jenjang'] == 'S1') ? 'selected' : ''; ?>>S1 - Sarjana</option>
                                <option value="S2" <?= ($row['jenjang'] == 'S2') ? 'selected' : ''; ?>>S2 - Magister</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="prodi.php" class="btn btn-secondary px-4 rounded-pill">Batal</a>
                            <button type="submit" name="submit" class="btn btn-success px-4 rounded-pill">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "_footer.php"; ?>