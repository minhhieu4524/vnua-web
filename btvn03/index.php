<?php
include 'ketnoi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
</head>
<body style="font-family: Arial; margin: 30px;">
    <h2>DANH SÁCH SẢN PHẨM</h2>
    <p><a href="create.php">+ Thêm sản phẩm mới</a></p>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr style="background-color: #f2f2f2;">
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Hành động</th>
        </tr>
        <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . number_format($row["price"]) . " đ</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td>
                        <a href='update.php?id=" . $row["id"] . "'>Sửa</a> | 
                        <a href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Bạn có chắc muốn xóa?\")'>Xóa</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center;'>Không có sản phẩm nào</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>