<?php
class AuthController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function login() {
        if (isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/index.php?action=index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($user = $this->userModel->authenticate($username, $password)) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header("Location: " . BASE_URL . "/index.php?action=index");
                exit();
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng";
            }
        }

        require 'views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL . "/index.php?action=login");
        exit();
    }
}
