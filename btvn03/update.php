<?php
include 'ketnoi.php';

$id = $_GET['id'];

// Lấy thông tin cũ của sản phẩm
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql_update = "UPDATE products SET name='$name', price='$price', quantity='$quantity' WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi cập nhật: " . $conn->error;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
</head>
<body style="font-family: Arial; margin: 30px;">
    <h2>Sửa Thông Tin Sản Phẩm</h2>
    <form method="POST">
        <p>Tên sản phẩm: <br><input type="text" name="name" value="<?php echo $row['name']; ?>" required></p>
        <p>Giá: <br><input type="number" name="price" value="<?php echo $row['price']; ?>" required></p>
        <p>Số lượng: <br><input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" required></p>
        <p><button type="submit">Cập nhật</button> <a href="index.php">Quay lại</a></p>
    </form>
</body>
</html>