<?php

/**
 * User Model
 * Handles authentication for students
 */

class User extends Model {
    protected $table = 'siswa';
    
    /**
     * Authenticate user by NIS and password
     */
    public function authenticate($nis, $password) {
        $user = $this->findByNis($nis);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }
    
    /**
     * Find user by NIS
     */
    public function findByNis($nis) {
        $stmt = $this->db->prepare("
            SELECT s.*, k.nama_kelas, k.kompetensi_keahlian
            FROM {$this->table} s
            LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
            WHERE s.nis = :nis
            LIMIT 1
        ");
        $stmt->execute(['nis' => $nis]);
        return $stmt->fetch();
    }
    
    /**
     * Create new user with hashed password
     */
    public function createUser($data) {
        // Hash password before storing
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        
        return $this->create($data);
    }
    
    /**
     * Update user password
     */
    public function updatePassword($id, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        return $this->update($id, ['password' => $hashedPassword], 'id_siswa');
    }
}
