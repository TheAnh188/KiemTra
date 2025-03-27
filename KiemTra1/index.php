<?php
session_start();
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'models/EmployeeModel.php';
require_once 'models/DepartmentModel.php';
require_once 'models/UserModel.php';
require_once 'controllers/EmployeeController.php';
require_once 'controllers/AuthController.php';

// Create database connection
$database = new Database();
$db = $database->getConnection();

// Initialize controllers
$employeeController = new EmployeeController($db);
$authController = new AuthController($db);

// Simple routing
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Route to appropriate controller action
switch ($action) {
    case 'login':
        $authController->login();
        break;
        
    case 'logout':
        $authController->logout();
        break;
        
    case 'add':
        $employeeController->add();
        break;
        
    case 'edit':
        $employeeController->edit();
        break;
        
    case 'delete':
        $employeeController->delete();
        break;
        
    case 'index':
    default:
        $employeeController->index();
        break;
}
