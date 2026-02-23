<?php
require_once __DIR__ . "/../model/Student.php";

class Studentcontroller {
    private $conn;
    private $studentModel;

    public function __construct($db) {
        $this->conn = $db;
        $this->studentModel = new Student($db);
    }

    public function index() {
        $students = $this->studentModel->getAll();
        require __DIR__ . "/../view/Main.php";
        exit;
    }

    public function create() {
        $name = trim($_POST["student_name"] ?? "");
        $studentId = trim($_POST["student_id"] ?? "");
        $email = trim($_POST["email"] ?? "");

        if ($name === "" || $studentId === "" || $email === "") {
            $_SESSION["error"] = "Please fill all student fields.";
            header("Location: index.php");
            exit;
        }

        $ok = $this->studentModel->create($name, $studentId, $email);

        if ($ok) {
            $_SESSION["success"] = "Student added!";
        } else {
            $_SESSION["error"] = "Failed to add student.";
        }

        header("Location: index.php");
        exit;
    }

    public function delete() {
        $id = intval($_GET["id"] ?? 0);

        if ($id <= 0) {
            $_SESSION["error"] = "Invalid student id.";
            header("Location: index.php");
            exit;
        }

        $ok = $this->studentModel->deleteById($id);

        if ($ok) {
            $_SESSION["success"] = "Student deleted!";
        } else {
            $_SESSION["error"] = "Failed to delete student.";
        }

        header("Location: index.php");
        exit;
    }
}