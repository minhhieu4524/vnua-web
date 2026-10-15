<?php
include 'ketnoi.php';
$sdt = "";
$ket_qua = null;
if (isset($_GET['sdt'])) {
    $sdt = $_GET['sdt'];
    $ket_qua = $conn->query("SELECT * FROM donhang WHERE sdt = '$sdt' ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tra cứu đơn hàng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="font-family: Arial; margin: 30px;">
    <h2>🔍 Tra cứu đơn hàng</h2>
    <a href="index.php">⬅ Quay lại Menu</a>
    <br><br>
    <form method="GET">
        Nhập số điện thoại của bạn: <input type="text" name="sdt" value="<?php echo $sdt; ?>" required style="padding: 5px;">
        <button type="submit" style="padding: 5px 10px;">Tra cứu</button>
    </form>
    <br>

    <?php if(isset($_GET['sdt'])): ?>
        <h3>Kết quả cho SĐT: <?php echo $sdt; ?></h3>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr style="background: #f2f2f2;">
                <th>Mã đơn</th>
                <th>Người nhận</th>
                <th>Địa chỉ</th>
                <th>Tổng tiền</th>
                <th>Trạng thái đơn</th>
                <th>Thời gian đặt</th>
            </tr>
            <?php
            if ($ket_qua->num_rows > 0) {
                while($row = $ket_qua->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>#" . $row['id'] . "</td>";
                    echo "<td>" . $row['ten_khach'] . "</td>";
                    echo "<td>" . $row['dia_chi'] . "</td>";
                    echo "<td>" . number_format($row['tong_tien']) . " đ</td>";
                    echo "<td><span style='color: red;'><b>" . $row['trang_thai'] . "</b></span></td>";
                    echo "<td>" . $row['ngay_dat'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' align='center'>Không tìm thấy đơn hàng nào!</td></tr>";
            }
            ?>
        </table>
    <?php endif; ?>
</body>
</html>