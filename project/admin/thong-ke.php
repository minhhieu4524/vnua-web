<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: dang-nhap.php"); exit(); }
include '../ketnoi.php';

// Thống kê theo tuần (7 ngày gần nhất) hoặc theo tháng (dùng hàm MONTH() / WEEK())
// Lấy tổng doanh thu đơn đã hoàn thành
$dt_thang = $conn->query("SELECT SUM(tong_tien) AS tong FROM donhang WHERE trang_thai = 'Hoàn thành' AND MONTH(ngay_dat) = MONTH(CURRENT_DATE())")->fetch_assoc()['tong'];
$dt_tuan = $conn->query("SELECT SUM(tong_tien) AS tong FROM donhang WHERE trang_thai = 'Hoàn thành' AND WEEK(ngay_dat, 1) = WEEK(CURRENT_DATE(), 1)")->fetch_assoc()['tong'];
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Thống kê doanh thu</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body style="font-family: Arial; margin: 20px;">
    <h2>📊 Thống Kê Doanh Thu</h2>
    <p>
        <a href="quan-ly-don.php">Quản lý đơn hàng</a> | 
        <a href="quan-ly-mon.php">Quản lý món</a> | 
        <a href="thong-ke.php">Thống kê doanh thu</a> | 
        <a href="dang-xuat.php">Đăng xuất</a>
    </p>
    <hr>

    <div style="display: flex; gap: 20px;">
        <div style="border: 1px solid #ccc; padding: 20px; background: #f9f9f9; width: 250px;">
            <h3>Doanh thu Tuần này</h3>
            <p style="font-size: 22px; color: green; font-weight: bold;"><?php echo number_format($dt_tuan ?? 0); ?> đ</p>
        </div>
        <div style="border: 1px solid #ccc; padding: 20px; background: #f9f9f9; width: 250px;">
            <h3>Doanh thu Tháng này</h3>
            <p style="font-size: 22px; color: blue; font-weight: bold;"><?php echo number_format($dt_thang ?? 0); ?> đ</p>
        </div>
    </div>
</body>
</html>