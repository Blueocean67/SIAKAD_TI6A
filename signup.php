<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; display: flex; justify-content: center; padding-top: 50px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Daftar Akun</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="signup">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</body>
</html>

<?php
if(isset($_POST['signup'])){
    $data = $_POST['username'] . "|" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "\n";
    file_put_contents('users.txt', $data, FILE_APPEND);
    echo "<p style='text-align:center;'>Berhasil daftar! Silakan login.</p>";
}
?>