<?php

class Visitors {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getRowCount() {
        $this->db->query("SELECT * FROM unique_visitors");
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function create($date, $ip) {
        $this->db->query("INSERT INTO unique_visitors (date, ip) VALUES (:date, :ip)");
        $this->db->bind(":date", $date);
        $this->db->bind(":ip", $ip);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findIpByDate($date) {
        $this->db->query("SELECT * FROM unique_visitors WHERE date = :date");
        $this->db->bind(":date", $date);
        return $this->db->singleResult();
    }

    public function update($ip, $date) {
        $this->db->query("UPDATE unique_visitors SET ip = :ip, views = (views + 1) WHERE date = :date");
        $this->db->bind(":ip", $ip);
        $this->db->bind(":date", $date);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAll() {
        $this->db->query("SELECT * FROM unique_visitors");
        return $this->db->singleResult();
    }
}