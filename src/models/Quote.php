<?php

class Quote {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllQuotes() {
        $this->db->query("SELECT * FROM qoute_request ORDER BY id ASC");
        return $this->db->resultSet();
    }

    public function findAllByNameProduct($key) {
        $this->db->query("SELECT * FROM qoute_request WHERE name LIKE '%$key%' OR product LIKE '%$key%' ORDER BY id ASC");
        return $this->db->resultSet();
    }

    public function findById($id) {
        $this->db->query("SELECT * FROM qoute_request WHERE id = $id");
        return $this->db->singleResult();
    }

    public function deleteQuoteById($id){
        $this->db->query("DELETE FROM qoute_request WHERE id = :id");
        $this->db->bind(":id", $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}