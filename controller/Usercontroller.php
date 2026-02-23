<?php
require_once __DIR__ . "/../model/User.php";

class Usercontroller {
    private $conn;
    private $userModel;

    public function __construct($db) {
        $this->conn = $db;
        $this->userModel = new User($db);
    }

    public function register() {
        $username = trim($_POST["username"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $password = $_POST["password"] ?? "";

        if ($username === "" || $email === "" || $password === "") {
            $_SESSION["error"] = "Please fill in all fields.";
            header("Location: index.php?action=register");
            exit;
        }

        // avoid duplicate email
        $existing = $this->userModel->findByEmail($email);
        if ($existing) {
            $_SESSION["error"] = "Email already registered. Please login.";
            header("Location: index.php");
            exit;
        }

        $ok = $this->userModel->register($username, $email, $password);

        if ($ok) {
            $_SESSION["success"] = "Account created! Please login.";
            header("Location: index.php");
            exit;
        }

        $_SESSION["error"] = "Registration failed. Try again.";
        header("Location: index.php?action=register");
        exit;
    }

    public function login() {
        $email = trim($_POST["email"] ?? "");
        $password = $_POST["password"] ?? "";

        if ($email === "" || $password === "") {
            $_SESSION["error"] = "Please enter email and password.";
            header("Location: index.php");
            exit;
        }

        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user["password"])) {
            $_SESSION["error"] = "Invalid email or password.";
            header("Location: index.php");
            exit;
        }

        // success
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        header("Location: index.php");
        exit;
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}