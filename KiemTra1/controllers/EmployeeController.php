<?php
class EmployeeController {
    private $employeeModel;
    private $departmentModel;

    public function __construct($db) {
        $this->employeeModel = new EmployeeModel($db);
        $this->departmentModel = new DepartmentModel($db);
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/index.php?action=login");
            exit();
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $employees = $this->employeeModel->getAllEmployees($page);
        $totalEmployees = $this->employeeModel->getTotalEmployees();
        $totalPages = ceil($totalEmployees / ITEMS_PER_PAGE);

        require 'views/employee/index.php';
    }

    public function add() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: " . BASE_URL . "/index.php?action=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if ($this->employeeModel->createEmployee($_POST)) {
                    header("Location: " . BASE_URL . "/index.php?action=index");
                    exit();
                }
            } catch (PDOException $e) {
                $error = "Lỗi: " . $e->getMessage();
            }
        }

        $departments = $this->departmentModel->getAllDepartments();
        require 'views/employee/add.php';
    }

    public function edit() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: " . BASE_URL . "/index.php?action=login");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . BASE_URL . "/index.php?action=index");
            exit();
        }

        $employee = $this->employeeModel->getEmployeeById($_GET['id']);
        if (!$employee) {
            header("Location: " . BASE_URL . "/index.php?action=index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if ($this->employeeModel->updateEmployee($_GET['id'], $_POST)) {
                    header("Location: " . BASE_URL . "/index.php?action=index");
                    exit();
                }
            } catch (PDOException $e) {
                $error = "Lỗi: " . $e->getMessage();
            }
        }

        $departments = $this->departmentModel->getAllDepartments();
        require 'views/employee/edit.php';
    }

    public function delete() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: " . BASE_URL . "/index.php?action=login");
            exit();
        }

        if (isset($_GET['id'])) {
            try {
                $this->employeeModel->deleteEmployee($_GET['id']);
            } catch (PDOException $e) {
                // Handle error if needed
            }
        }

        header("Location: " . BASE_URL . "/index.php?action=index");
        exit();
    }
}
