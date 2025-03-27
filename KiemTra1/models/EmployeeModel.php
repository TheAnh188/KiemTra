<?php
class EmployeeModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllEmployees($page = 1, $itemsPerPage = ITEMS_PER_PAGE) {
        $offset = ($page - 1) * $itemsPerPage;
        $query = "SELECT n.*, p.Ten_Phong 
                  FROM nhanvien n 
                  LEFT JOIN phongban p ON n.Ma_Phong = p.Ma_Phong 
                  ORDER BY n.Ma_NV 
                  LIMIT :offset, :limit";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalEmployees() {
        $query = "SELECT COUNT(*) as total FROM nhanvien";
        return $this->db->query($query)->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getEmployeeById($id) {
        $query = "SELECT * FROM nhanvien WHERE Ma_NV = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createEmployee($data) {
        $query = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) 
                  VALUES (:ma_nv, :ten_nv, :phai, :noi_sinh, :ma_phong, :luong)";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':ma_nv' => $data['ma_nv'],
            ':ten_nv' => $data['ten_nv'],
            ':phai' => $data['phai'],
            ':noi_sinh' => $data['noi_sinh'],
            ':ma_phong' => $data['ma_phong'],
            ':luong' => $data['luong']
        ]);
    }

    public function updateEmployee($id, $data) {
        $query = "UPDATE nhanvien 
                  SET Ten_NV = :ten_nv,
                      Phai = :phai,
                      Noi_Sinh = :noi_sinh,
                      Ma_Phong = :ma_phong,
                      Luong = :luong
                  WHERE Ma_NV = :ma_nv";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':ma_nv' => $id,
            ':ten_nv' => $data['ten_nv'],
            ':phai' => $data['phai'],
            ':noi_sinh' => $data['noi_sinh'],
            ':ma_phong' => $data['ma_phong'],
            ':luong' => $data['luong']
        ]);
    }

    public function deleteEmployee($id) {
        $query = "DELETE FROM nhanvien WHERE Ma_NV = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
