<?php
session_start();
include '../ketnoi.php';
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $res = $conn->query("SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    if ($res->num_rows == 1) {
        $_SESSION['admin'] = $user;
        header("Location: quan-ly-don.php");
        exit();
    } else {
        $error = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body style="font-family: Arial; margin: 50px;">
    <h2>🔐 Đăng nhập Quản trị Tiệm Trà Sữa</h2>
    <form method="POST">
        Tài khoản: <br><input type="text" name="username" required style="padding:5px;"><br><br>
        Mật khẩu: <br><input type="password" name="password" required style="padding:5px;"><br><br>
        <button type="submit" style="padding: 5px 15px;">Đăng nhập</button>
    </form>
    <p style="color: red;"><?php echo $error; ?></p>
</body>
</html>