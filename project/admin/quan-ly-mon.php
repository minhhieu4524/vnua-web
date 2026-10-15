<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: dang-nhap.php"); exit(); }
include '../ketnoi.php';

// Thêm món
if (isset($_POST['them_mon'])) {
    $ten = $_POST['ten_mon'];
    $gia = $_POST['gia'];
    $conn->query("INSERT INTO sanpham (ten_mon, gia) VALUES ('$ten', $gia)");
}

// Xóa món
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $conn->query("DELETE FROM sanpham WHERE id = $id");
    header("Location: quan-ly-mon.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Quản lý thực đơn</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body style="font-family: Arial; margin: 20px;">
    <h2> Quản lý Món Trà Sữa</h2>
    <p>
        <a href="quan-ly-don.php">Quản lý đơn hàng</a> | 
        <a href="quan-ly-mon.php">Quản lý món</a> | 
        <a href="thong-ke.php">Thống kê doanh thu</a> | 
        <a href="dang-xuat.php">Đăng xuất</a>
    </p>
    <hr>

    <h3>Thêm món mới</h3>
    <form method="POST">
        Tên món: <input type="text" name="ten_mon" required> 
        Giá tiền: <input type="number" name="gia" required> 
        <button type="submit" name="them_mon">Thêm món</button>
    </form>

    <h3>Danh sách món hiện tại</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr style="background: #f2f2f2;">
            <th>ID</th>
            <th>Tên món</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
        <?php
        $mon = $conn->query("SELECT * FROM sanpham");
        while($m = $mon->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$m['id']."</td>";
            echo "<td>".$m['ten_mon']."</td>";
            echo "<td>".number_format($m['gia'])." đ</td>";
            echo "<td>
                    <a href='sua-mon.php?id=".$m['id']."'>Sửa</a> | 
                    <a href='quan-ly-mon.php?xoa=".$m['id']."' onclick='return confirm(\"Bạn chắc chắn muốn xóa?\")'>Xóa</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>