<?php
// auth.php - Halaman tunggal untuk Login & Signup
$page = isset($_GET['page']) ? $_GET['page'] : 'login';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background: #f8fafc; height: 100vh; display: flex; align-items: center; }
        .auth-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
    </style>
</head>
<body class="container">

    <div class="card auth-card mx-auto p-4">
        <?php if ($page == 'login'): ?>
            <h3 class="fw-bold text-center mb-4">Login SIAKAD</h3>
            <form action="proses_login.php" method="POST">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                <p class="text-center text-muted">Belum punya akun? <a href="auth.php?page=signup">Daftar</a></p>
            </form>

        <?php elseif ($page == 'signup'): ?>
            <h3 class="fw-bold text-center mb-4">Buat Akun</h3>
            <form action="proses_signup.php" method="POST">
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100 mb-3">Daftar</button>
                <p class="text-center text-muted">Sudah punya akun? <a href="auth.php?page=login">Login</a></p>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>