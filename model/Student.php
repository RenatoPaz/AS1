<?php
class Student {
    private $conn;
    private $table = "students";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $sql = "SELECT id, student_name, student_id, email FROM {$this->table} ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($name, $studentId, $email) {
        $sql = "INSERT INTO {$this->table} (student_name, student_id, email) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $name, $studentId, $email);
        return $stmt->execute();
    }

    public function deleteById($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}