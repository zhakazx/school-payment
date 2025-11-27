<?php

/**
 * TahunAjaran Model
 * Handles academic year data
 */

class TahunAjaran extends Model {
    protected $table = 'tahun_ajaran';
    
    /**
     * Get all academic years
     */
    public function getAll() {
        return $this->findAll('id_tahun_ajaran DESC');
    }
    
    /**
     * Get active academic year
     */
    public function getActive() {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE status = 'aktif'
            LIMIT 1
        ");
        $stmt->execute();
        return $stmt->fetch();
    }
    
    /**
     * Get by ID
     */
    public function getById($id) {
        return $this->findById($id, 'id_tahun_ajaran');
    }
    
    /**
     * Create new academic year
     */
    public function createTahunAjaran($data) {
        return $this->create($data);
    }
    
    /**
     * Update academic year
     */
    public function updateTahunAjaran($id, $data) {
        return $this->update($id, $data, 'id_tahun_ajaran');
    }
    
    /**
     * Delete academic year
     */
    public function deleteTahunAjaran($id) {
        return $this->delete($id, 'id_tahun_ajaran');
    }
    
    /**
     * Set academic year as active (and deactivate others)
     */
    public function setActive($id) {
        // Start transaction
        $this->db->beginTransaction();
        
        try {
            // Deactivate all
            $stmt = $this->db->prepare("UPDATE {$this->table} SET status = 'non-aktif'");
            $stmt->execute();
            
            // Activate selected
            $stmt = $this->db->prepare("
                UPDATE {$this->table}
                SET status = 'aktif'
                WHERE id_tahun_ajaran = :id
            ");
            $stmt->execute(['id' => $id]);
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
