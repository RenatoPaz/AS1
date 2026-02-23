<?php
class User {
    private $conn;
    private $table = "user";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $email, $passwordPlain) {
        $sql = "INSERT INTO {$this->table} (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        $hash = password_hash($passwordPlain, PASSWORD_DEFAULT);

        $stmt->bind_param("sss", $username, $email, $hash);
        return $stmt->execute();
    }

    public function findByEmail($email) {
        $sql = "SELECT id, username, email, password FROM {$this->table} WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc(); // returns array or null
    }
}