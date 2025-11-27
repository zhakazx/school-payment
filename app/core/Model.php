<?php

/**
 * Base Model Class
 * Provides database connection and common query methods
 */

class Model {
    protected $db;
    protected $table;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Find all records
     */
    public function findAll($orderBy = 'id') {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY {$orderBy}");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Find record by ID
     */
    public function findById($id, $column = 'id') {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$column} = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    /**
     * Create new record
     */
    public function create($data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute($data);
    }
    
    /**
     * Update record
     */
    public function update($id, $data, $idColumn = 'id') {
        $setParts = [];
        foreach (array_keys($data) as $key) {
            $setParts[] = "{$key} = :{$key}";
        }
        $setClause = implode(', ', $setParts);
        
        $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$idColumn} = :id";
        $data['id'] = $id;
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
    
    /**
     * Delete record
     */
    public function delete($id, $column = 'id') {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE {$column} = :id");
        return $stmt->execute(['id' => $id]);
    }
    
    /**
     * Execute custom query
     */
    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    /**
     * Get last insert ID
     */
    public function lastInsertId() {
        return $this->db->lastInsertId();
    }
}
