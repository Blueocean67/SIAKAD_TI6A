<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; display: flex; justify-content: center; padding-top: 50px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Masuk</button>
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['login'])){
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);
    $found = false;
    foreach($users as $user){
        list($u, $p) = explode('|', $user);
        if($u == $_POST['username'] && password_verify($_POST['password'], $p)){
            $found = true; break;
        }
    }
    echo $found ? "<p style='text-align:center; color:green;'>Login Berhasil!</p>" : "<p style='text-align:center; color:red;'>Username/Password Salah</p>";
}
?>