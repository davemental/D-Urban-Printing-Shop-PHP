<?php

class Quote {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function saveContactRequest($name, $email, $contact_number, $message) {
        $this->db->query("INSERT INTO qoute_request (name, email, contact_number, details) VALUES (:name, :email, :contact_number, :details)");
        $this->db->bind(":name", $name);
        $this->db->bind(":email", $email);
        $this->db->bind(":contact_number", $contact_number);
        $this->db->bind(":details", $message);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function saveSendInquiryRequest($name, $email, $contact_number, $company, $address, $product, $quantity, $details, $file_name) {
        $this->db->query("INSERT INTO qoute_request (name, email, contact_number, company, address, product, quantity, details, file_name) VALUES (:name, :email, :contact_number, :company, :address, :product, :quantity, :details, :file_name)");
        $this->db->bind(":name", $name);
        $this->db->bind(":email", $email);
        $this->db->bind(":contact_number", $contact_number);
        $this->db->bind(":company", $company);
        $this->db->bind(":address", $address);
        $this->db->bind(":product", $product);
        $this->db->bind(":quantity", $quantity);
        $this->db->bind(":details", $details);
        $this->db->bind(":file_name", $file_name);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllQuotes() {
        $this->db->query("SELECT * FROM qoute_request ORDER BY read_status ASC, id DESC");
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

    public function getRowUnreadRequest() {
        $this->db->query("SELECT COUNT(*) AS rowCount FROM qoute_request WHERE read_status = 0");
        return $this->db->singleResult();
    }

    public function updateStatusById($id) {
        $this->db->query("UPDATE qoute_request SET read_status = 1 WHERE id = :id");
        $this->db->bind(":id", $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}