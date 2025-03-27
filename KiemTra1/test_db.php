<?php
require_once 'config/config.php';

try {
    $conn = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối database thành công!";
    
    // Test query
    $stmt = $conn->query("SELECT * FROM nhanvien");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "\n\nDữ liệu từ bảng nhanvien:\n";
    print_r($result);
    
} catch(PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}
