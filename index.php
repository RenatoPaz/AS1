<?php
session_start();

// --- Include required files ---
require_once __DIR__ . "/config/Database.php";

require_once __DIR__ . "/model/User.php";
require_once __DIR__ . "/model/Student.php";

require_once __DIR__ . "/controller/Usercontroller.php";
require_once __DIR__ . "/controller/Studentcontroller.php";

// --- Create DB connection ---
$db = new Database();
$conn = $db->connect();

// --- Create controllers ---
$userController = new Usercontroller($conn);
$studentController = new Studentcontroller($conn);

// --- Simple router ---
$action = $_GET["action"] ?? "";

// If user is not logged in, only allow login/register actions
$isLoggedIn = isset($_SESSION["user_id"]);

if (!$isLoggedIn) {
    if ($action === "register") {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userController->register();
        } else {
            require __DIR__ . "/view/Register.php";
        }
        exit;
    }

    // default to login
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $userController->login();
    } else {
        require __DIR__ . "/view/Login.php";
    }
    exit;
}

// --- Logged in routes ---
switch ($action) {
    case "logout":
        $userController->logout();
        break;

    case "createStudent":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $studentController->create();
        } else {
            header("Location: index.php");
        }
        break;

    case "deleteStudent":
        $studentController->delete();
        break;

    case "main":
    default:
        // show main page with list of students
        $studentController->index();
        break;
}