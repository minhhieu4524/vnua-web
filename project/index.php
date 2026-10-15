<?php
include 'ketnoi.php';

// Xử lý tìm kiếm món
$tu_khoa = "";
if (isset($_GET['tukhoa'])) {
    $tu_khoa = $_GET['tukhoa'];
    $sql = "SELECT * FROM sanpham WHERE ten_mon LIKE '%$tu_khoa%'";
} else {
    $sql = "SELECT * FROM sanpham";
}
$result = $conn->query($sql);

// Xử lý khi khách bấm đặt món
$thong_bao = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_khach = $_POST['ten_khach'];
    $sdt = $_POST['sdt'];
    $dia_chi = $_POST['dia_chi'];
    $san_pham_id = $_POST['san_pham_id'];
    $so_luong = $_POST['so_luong'];

    // Lấy giá món
    $res_gia = $conn->query("SELECT gia FROM sanpham WHERE id = $san_pham_id");
    $row_gia = $res_gia->fetch_assoc();
    $tong_tien = $row_gia['gia'] * $so_luong;

    // Lưu vào bảng đơn hàng
    $sql_dh = "INSERT INTO donhang (ten_khach, sdt, dia_chi, tong_tien, trang_thai, ngay_dat) 
               VALUES ('$ten_khach', '$sdt', '$dia_chi', $tong_tien, 'Chờ xác nhận', NOW())";
    
    if ($conn->query($sql_dh) === TRUE) {
        $donhang_id = $conn->insert_id;
        // Lưu chi tiết đơn hàng
        $conn->query("INSERT INTO chitiet_donhang (donhang_id, san_pham_id, so_luong) VALUES ($donhang_id, $san_pham_id, $so_luong)");
        $thong_bao = "Đặt hàng thành công! Mã đơn hàng của bạn là: #$donhang_id";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tiệm Trà Sữa Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="font-family: Arial; margin: 30px;">
    <h2> MENU TRÀ SỮA</h2>
    <a href="tra-cuu.php">🔍 Tra cứu đơn hàng bằng SĐT</a> | 
    <a href="admin/dang-nhap.php" target="_blank">  Đăng nhập Quản trị</a>
    <hr>

    <!-- Form tìm kiếm món -->
    <form method="GET" style="margin-bottom: 20px;">
        <input type="text" name="tukhoa" placeholder="Nhập tên món cần tìm..." value="<?php echo $tu_khoa; ?>" style="padding: 5px; width: 250px;">
        <button type="submit" style="padding: 5px 10px;">Tìm kiếm</button>
        <?php if(!empty($tu_khoa)) echo '<a href="index.php">Tất cả món</a>'; ?>
    </form>

    <?php if(!empty($thong_bao)) echo "<p style='color: green;'><b>$thong_bao</b></p>"; ?>

    <!-- Danh sách món -->
    <table border="1" cellpadding="10" cellspacing="0">
        <tr style="background: #f2f2f2;">
            <th>Tên món</th>
            <th>Giá tiền</th>
            <th>Hành động đặt mua</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><b>" . $row['ten_mon'] . "</b></td>";
                echo "<td>" . number_format($row['gia']) . " đ</td>";
                echo "<td>
                        <form method='POST' style='margin:0;'>
                            <input type='hidden' name='san_pham_id' value='".$row['id']."'>
                            SL: <input type='number' name='so_luong' value='1' min='1' style='width: 40px;'> 
                            Họ tên: <input type='text' name='ten_khach' required placeholder='Tên bạn'>
                            SĐT: <input type='text' name='sdt' required placeholder='Số điện thoại'>
                            Địa chỉ: <input type='text' name='dia_chi' required placeholder='Địa chỉ nhận'>
                            <button type='submit' style='background: #ff6600; color: white; border: none; padding: 5px 10px;'>Đặt món</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3' align='center'>Không tìm thấy món phù hợp!</td></tr>";
        }
        ?>
    </table>
</body>
</html>