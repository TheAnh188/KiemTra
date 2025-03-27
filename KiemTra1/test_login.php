<?php
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'models/UserModel.php';

$database = new Database();
$db = $database->getConnection();
$userModel = new UserModel($db);

$username = 'admin';
$password = 'admin123';

// Test 1: Kiểm tra kết nối database
echo "Test 1: Kiểm tra kết nối database\n";
if ($db) {
    echo "✓ Kết nối database thành công\n\n";
} else {
    echo "✗ Lỗi kết nối database\n\n";
}

// Test 2: Kiểm tra dữ liệu user trong database
echo "Test 2: Kiểm tra dữ liệu user\n";
$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "✓ Tìm thấy user trong database\n";
    echo "User data:\n";
    print_r($user);
    echo "\n";
} else {
    echo "✗ Không tìm thấy user trong database\n\n";
}

// Test 3: Kiểm tra xác thực password
echo "\nTest 3: Kiểm tra xác thực password\n";
if ($user) {
    echo "Stored password hash: " . $user['password'] . "\n";
    echo "Testing password: " . $password . "\n";
    if (password_verify($password, $user['password'])) {
        echo "✓ Password verify thành công\n";
    } else {
        echo "✗ Password verify thất bại\n";
    }
}

// Test 4: Thử đăng nhập hoàn chỉnh
echo "\nTest 4: Thử đăng nhập hoàn chỉnh\n";
$result = $userModel->authenticate($username, $password);
if ($result) {
    echo "✓ Đăng nhập thành công\n";
    print_r($result);
} else {
    echo "✗ Đăng nhập thất bại\n";
}
