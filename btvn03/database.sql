-- Tạo cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS shop_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE shop_db;

-- Tạo bảng sản phẩm
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert dữ liệu demo
INSERT INTO products (name, price, quantity, description) VALUES
('Laptop Gaming ASUS ROG', 25500000.00, 10, 'Laptop chuyên game cấu hình mạnh mẽ'),
('Điện thoại iPhone 15 Pro', 28990000.00, 15, 'Điện thoại cao cấp mới nhất từ Apple'),
('Bàn phím cơ không dây', 1450000.00, 50, 'Bàn phím cơ RGB switch cực êm'),
('Chuột Gaming Logitech', 890000.00, 30, 'Chuột không dây độ trễ siêu thấp');