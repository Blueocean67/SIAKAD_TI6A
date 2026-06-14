<?php
require "koneksi.php";
include "_header.php";
include "_menu.php";

$sql = "SELECT * FROM mhs_has_prodi";
$result = mysqli_query($conn, $sql);
?>

<style>
    body {
        background: #f8fafc;
    }

    .data-card {
        border: none;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0,0,0,0.08);
    }

    .card-header-custom {
        background: linear-gradient(135deg, #2563eb, #1e40af);
        color: white;
        padding: 1.5rem;
    }

    .table-modern thead th {
        background: #f1f5f9;
        border: none;
        font-weight: 700;
        color: #334155;
        padding: 16px;
    }

    .table-modern tbody tr {
        transition: .25s;
    }

    .table-modern tbody tr:hover {
        background: #f8fbff;
    }

    .table-modern td {
        padding: 16px;
        vertical-align: middle;
    }

    .badge-modern {
        padding: 8px 14px;
        border-radius: 50px;
        font-weight: 600;
    }

    .empty-box {
        padding: 50px;
        color: #94a3b8;
    }
</style>

<div class="container py-4">

    <div class="card data-card">

        <div class="card-header-custom">
            <h4 class="fw-bold mb-1">
                <i class="bi bi-diagram-3-fill me-2"></i>Relasi Mahasiswa & Prodi
            </h4>
            <small class="opacity-75">
                Data relasi mahasiswa dengan program studi
            </small>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">

                <table class="table table-modern align-middle">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>ID Prodi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary badge-modern">
                                            <?= $row["nim"]; ?>
                                        </span>
                                    </td>

                                    <td class="fw-semibold">
                                        <?= $row["nama"]; ?>
                                    </td>

                                    <td>
                                        <span class="badge bg-success-subtle text-success badge-modern">
                                            <?= $row["id_prodi"]; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endwhile; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center empty-box">
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                    Tidak ada data
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>

            </div>
        </div>

    </div>

</div>

<?php include "_footer.php"; ?>