<?php
include 'ketnoi.php';

$id = $_GET['id'];

$sql = "DELETE FROM products WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Lỗi xóa: " . $conn->error;
}

$conn->close();
?>