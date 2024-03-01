<?php

class Product {

    private $db;

    public function __construct() { 
        $this->db = new Database();
    }

    public function create($title, $description, $featured_img, $sample_img) {
        $this->db->query("INSERT INTO products (title, description, featured_img, sample_img) VALUES (:title, :description, :featured_img, :sample_img)");
        $this->db->bind(":title", $title);
        $this->db->bind(":description", $description);
        $this->db->bind(":featured_img", $featured_img);
        $this->db->bind(":sample_img", $sample_img);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getProductById($id){
        $this->db->query("SELECT * FROM products WHERE id = :id");
        $this->db->bind(":id", $id);
        return $this->db->singleResult();
    }

    public function getProductSampleImageById($id) {
        $this->db->query("SELECT sample_img FROM products WHERE id = :id LIMIT 1");
        $this->db->bind(":id", $id);
        return $this->db->singleResult();
    }

    public function getProductByName($name){
        $this->db->query("SELECT * FROM products WHERE title LIKE :title");
        $keyword = "%" . $name . "%"; //add wildcards
        $this->db->bind(":title", $keyword);
        return $this->db->resultSet();
    }

    public function getAllProducts() {
        $this->db->query("SELECT * FROM products");
        return $this->db->resultSet();
    }

    public function deleteProductById($id){
        $this->db->query("DELETE FROM products WHERE id = :id");
        $this->db->bind(":id", $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
