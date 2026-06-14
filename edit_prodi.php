<?php
require "koneksi.php";
include "_header.php";
include "_menu.php";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $data = mysqli_query($conn, "SELECT * FROM prodi WHERE id='$id'");
    $row = mysqli_fetch_assoc($data);
}

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
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Card untuk membungkus form -->
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Ubah Data Program Studi</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
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
                                <option value="D3" <?= ($row['jenjang'] == 'D3') ? 'selected' : ''; ?>>D3</option>
                                <option value="S1" <?= ($row['jenjang'] == 'S1') ? 'selected' : ''; ?>>S1</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="prodi.php" class="btn btn-secondary">Batal</a>
                            <button type="submit" name="submit" class="btn btn-success px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "_footer.php"; ?>