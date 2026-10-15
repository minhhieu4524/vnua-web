<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: dang-nhap.php"); exit(); }
include '../ketnoi.php';

// Xử lý cập nhật trạng thái đơn hàng
if (isset($_POST['cap_nhat_trang_thai'])) {
    $id_dh = $_POST['donhang_id'];
    $trang_thai_moi = $_POST['trang_thai'];
    $conn->query("UPDATE donhang SET trang_thai = '$trang_thai_moi' WHERE id = $id_dh");
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body style="font-family: Arial; margin: 20px;">
    <h2>📋 Quản Lý Đơn Hàng</h2>
    <p>
        <a href="quan-ly-don.php">Quản lý đơn hàng</a> | 
        <a href="quan-ly-mon.php">Quản lý món (Thêm/Sửa/Xóa)</a> | 
        <a href="thong-ke.php">Thống kê doanh thu</a> | 
        <a href="dang-xuat.php">Đăng xuất</a>
    </p>
    <hr>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr style="background: #f2f2f2;">
            <th>Mã đơn</th>
            <th>Khách hàng</th>
            <th>SĐT</th>
            <th>Địa chỉ</th>
            <th>Tổng tiền</th>
            <th>Trạng thái hiện tại</th>
            <th>Hành động đổi trạng thái</th>
        </tr>
        <?php
        $ds = $conn->query("SELECT * FROM donhang ORDER BY id DESC");
        while ($row = $ds->fetch_assoc()) {
            echo "<tr>";
            echo "<td>#" . $row['id'] . "</td>";
            echo "<td>" . $row['ten_khach'] . "</td>";
            echo "<td>" . $row['sdt'] . "</td>";
            echo "<td>" . $row['dia_chi'] . "</td>";
            echo "<td>" . number_format($row['tong_tien']) . " đ</td>";
            echo "<td><b>" . $row['trang_thai'] . "</b></td>";
            echo "<td>
                    <form method='POST'>
                        <input type='hidden' name='donhang_id' value='".$row['id']."'>
                        <select name='trang_thai'>
                            <option value='Chờ xác nhận'>Chờ xác nhận</option>
                            <option value='Đang pha chế'>Đang pha chế</option>
                            <option value='Đang giao hàng'>Đang giao hàng</option>
                            <option value='Hoàn thành'>Hoàn thành</option>
                            <option value='Đã hủy'>Đã hủy</option>
                        </select>
                        <button type='submit' name='cap_nhat_trang_thai'>Cập nhật</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>