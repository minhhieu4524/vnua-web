<?php
include 'ketnoi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO products (name, price, quantity) VALUES ('$name', '$price', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        header("Location: danhsach.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
</head>
<body style="font-family: Arial; margin: 30px;">
    <h2>Thêm Sản Phẩm Mới</h2>
    <form method="POST">
        <p>Tên sản phẩm: <br><input type="text" name="name" required></p>
        <p>Giá: <br><input type="number" name="price" required></p>
        <p>Số lượng: <br><input type="number" name="quantity" required></p>
        <p><button type="submit">Lưu</button> <a href="danhsach.php">Quay lại</a></p>
    </form>
</body>
</html>