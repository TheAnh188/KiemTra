-- Create database
CREATE DATABASE IF NOT EXISTS ql_nhansu;
USE ql_nhansu;

-- Create PHONGBAN table
CREATE TABLE IF NOT EXISTS phongban (
    Ma_Phong varchar(2) PRIMARY KEY,
    Ten_Phong varchar(30) NOT NULL
);

-- Create NHANVIEN table
CREATE TABLE IF NOT EXISTS nhanvien (
    Ma_NV varchar(3) PRIMARY KEY,
    Ten_NV varchar(100) NOT NULL,
    Phai varchar(3),
    Noi_Sinh varchar(200),
    Ma_Phong varchar(2),
    Luong int,
    FOREIGN KEY (Ma_Phong) REFERENCES phongban(Ma_Phong)
);

-- Create users table for authentication
CREATE TABLE IF NOT EXISTS users (
    id int AUTO_INCREMENT PRIMARY KEY,
    username varchar(50) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    fullname varchar(100) NOT NULL,
    email varchar(100),
    role varchar(10) NOT NULL
);

-- Insert sample data
INSERT INTO phongban (Ma_Phong, Ten_Phong) VALUES
('QT', 'Quản Trị'),
('TC', 'Tài Chính'),
('KT', 'Kỹ Thuật');

INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES
('A01', 'Nguyễn thị Hải', 'NU', 'Hà Nội', 'TC', 600),
('A02', 'Trần văn Chính', 'NAM', 'Bình Định', 'QT', 500),
('A03', 'Lê Trần bạch Yến', 'NU', 'TP HCM', 'TC', 700),
('A04', 'Trần anh Tuấn', 'NAM', 'Hà Nội', 'KT', 800),
('B01', 'Trần thanh Mai', 'NU', 'Hải Phòng', 'TC', 800),
('B02', 'Trần thị thu Thủy', 'NU', 'TP HCM', 'KT', 700),
('B03', 'Nguyễn Thị Nở', 'NU', 'Ninh Bình', 'KT', 400);

-- Insert admin user (password: admin123)
INSERT INTO users (username, password, fullname, email, role) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin@example.com', 'admin');
