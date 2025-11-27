<?php

/**
 * Siswa Model
 * Handles student data
 */

class Siswa extends Model {
    protected $table = 'siswa';
    
    /**
     * Get all students with class information
     */
    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT s.*, k.nama_kelas, k.kompetensi_keahlian
            FROM {$this->table} s
            LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
            ORDER BY s.nama_lengkap ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Get student by ID with class information
     */
    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT s.*, k.nama_kelas, k.kompetensi_keahlian
            FROM {$this->table} s
            LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
            WHERE s.id_siswa = :id
            LIMIT 1
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    /**
     * Get students by class
     */
    public function getByKelas($id_kelas) {
        $stmt = $this->db->prepare("
            SELECT s.*, k.nama_kelas, k.kompetensi_keahlian
            FROM {$this->table} s
            LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
            WHERE s.id_kelas = :id_kelas
            ORDER BY s.nama_lengkap ASC
        ");
        $stmt->execute(['id_kelas' => $id_kelas]);
        return $stmt->fetchAll();
    }
    
    /**
     * Check if NIS already exists
     */
    public function nisExists($nis, $excludeId = null) {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE nis = :nis";
        $params = ['nis' => $nis];
        
        if ($excludeId) {
            $sql .= " AND id_siswa != :id";
            $params['id'] = $excludeId;
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        
        return $result['total'] > 0;
    }
    
    /**
     * Create new student
     */
    public function createSiswa($data) {
        // Hash password
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        
        return $this->create($data);
    }
    
    /**
     * Update student
     */
    public function updateSiswa($id, $data) {
        // Hash password if provided
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            // Remove password from update if empty
            unset($data['password']);
        }
        
        return $this->update($id, $data, 'id_siswa');
    }
    
    /**
     * Delete student
     */
    public function deleteSiswa($id) {
        return $this->delete($id, 'id_siswa');
    }
}
