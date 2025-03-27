<?php
class DepartmentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllDepartments() {
        $query = "SELECT * FROM phongban ORDER BY Ten_Phong";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDepartmentById($id) {
        $query = "SELECT * FROM phongban WHERE Ma_Phong = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
