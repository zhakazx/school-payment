<?php

/**
 * Kelas Model
 * Handles class/grade data
 */

class Kelas extends Model {
    protected $table = 'kelas';
    
    /**
     * Get all classes
     */
    public function getAll() {
        return $this->findAll('nama_kelas ASC');
    }
    
    /**
     * Get by ID
     */
    public function getById($id) {
        return $this->findById($id, 'id_kelas');
    }
    
    /**
     * Get classes by competency
     */
    public function getByKompetensi($kompetensi) {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE kompetensi_keahlian = :kompetensi
            ORDER BY nama_kelas ASC
        ");
        $stmt->execute(['kompetensi' => $kompetensi]);
        return $stmt->fetchAll();
    }
    
    /**
     * Get student count for a class
     */
    public function getStudentCount($id) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as total
            FROM siswa
            WHERE id_kelas = :id
        ");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }
    
    /**
     * Create new class
     */
    public function createKelas($data) {
        return $this->create($data);
    }
    
    /**
     * Update class
     */
    public function updateKelas($id, $data) {
        return $this->update($id, $data, 'id_kelas');
    }
    
    /**
     * Delete class
     */
    public function deleteKelas($id) {
        // Check if class has students
        if ($this->getStudentCount($id) > 0) {
            return false; // Cannot delete class with students
        }
        return $this->delete($id, 'id_kelas');
    }
}
