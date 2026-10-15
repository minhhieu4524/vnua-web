-- Tạo cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS tra_sua_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tra_sua_db;

-- 1. Bảng sản phẩm (món trà sữa)
CREATE TABLE IF NOT EXISTS sanpham (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ten_mon VARCHAR(255) NOT NULL,
    gia INT NOT NULL
);

-- 2. Bảng đơn hàng của khách
CREATE TABLE IF NOT EXISTS donhang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ten_khach VARCHAR(255) NOT NULL,
    sdt VARCHAR(20) NOT NULL,
    dia_chi TEXT NOT NULL,
    tong_tien INT NOT NULL,
    trang_thai VARCHAR(50) DEFAULT 'Chờ xác nhận',
    ngay_dat DATETIME NOT NULL
);

-- 3. Bảng chi tiết đơn hàng
CREATE TABLE IF NOT EXISTS chitiet_donhang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donhang_id INT,
    san_pham_id INT,
    so_luong INT
);

-- 4. Bảng tài khoản admin
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

-- Thêm tài khoản admin mẫu (User: admin / Pass: 123456)
INSERT INTO admin (username, password) VALUES ('admin', '123456');

-- Thêm danh sách món trà sữa mẫu
INSERT INTO sanpham (ten_mon, gia) VALUES 
('Trà sữa truyền thống', 25000),
('Trà sữa trân châu đường đen', 30000),
('Hồng trà kem cheese', 35000),
('Trà sữa matcha đậu đỏ', 32000),
('Trà sữa khoai môn', 30000),
('Lục trà lài lô hội', 28000),
('Trà sữa chocolate', 33000),
('Sữa tươi trân châu đường đen', 35000),
('Trà trái cây nhiệt đới', 35000),
('Hồng trà sữa trân châu trắng', 28000);

-- Thêm dữ liệu đơn hàng mẫu (có các trạng thái khác nhau và mốc thời gian đa dạng để test thống kê)
INSERT INTO donhang (ten_khach, sdt, dia_chi, tong_tien, trang_thai, ngay_dat) VALUES 
('Nguyễn Văn An', '0987654321', 'Khu A, Trâu Quỳ, Gia Lâm, Hà Nội', 60000, 'Hoàn thành', NOW() - INTERVAL 1 DAY),
('Trần Thị Bình', '0912345678', 'Khu B, Học viện Nông nghiệp', 35000, 'Hoàn thành', NOW() - INTERVAL 2 DAY),
('Lê Hoàng Cường', '0933221144', 'Đường Ngô Xuân Quảng, Gia Lâm', 90000, 'Đang giao hàng', NOW() - INTERVAL 3 HOUR),
('Phạm Thị Dung', '0977889900', 'Tòa S1.01 Vinhomes Ocean Park', 65000, 'Chờ xác nhận', NOW()),
('Hoàng Văn Em', '0905111222', 'Cổ Bi, Gia Lâm, Hà Nội', 32000, 'Hoàn thành', NOW() - INTERVAL 5 DAY),
('Vũ Minh Hiếu', '0966554433', 'Khu Vô Niệm, Nam Định', 105000, 'Hoàn thành', NOW() - INTERVAL 10 DAY),
('Đỗ Thị Mai', '0944332211', 'Đa Tốn, Gia Lâm, Hà Nội', 56000, 'Đã hủy', NOW() - INTERVAL 15 DAY);

-- Thêm chi tiết đơn hàng tương ứng cho các đơn hàng mẫu phía trên
INSERT INTO chitiet_donhang (donhang_id, san_pham_id, so_luong) VALUES 
(1, 2, 2),
(2, 3, 1),
(3, 9, 2),
(4, 4, 1),
(4, 1, 1),
(5, 4, 1),
(6, 10, 3),
(7, 6, 2);