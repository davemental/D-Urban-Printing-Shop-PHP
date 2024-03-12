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

    public function updateProductSampleImage($id, $imgsStr) {
        $this->db->query("UPDATE products set sample_img = :imgsStr WHERE id = :id");
        $this->db->bind(":id", $id);
        $this->db->bind(":imgsStr", $imgsStr);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProduct($id, $title, $description, $featured_img, $sample_img) {
        $this->db->query("UPDATE products set title = :title, description = :description, featured_img = :featured_img, sample_img = :sample_img WHERE id = :id");
        $this->db->bind(":id", $id);
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

    public function updateProductTitleDescription($id, $title, $description) {
        $this->db->query("UPDATE products set title = :title, description = :description WHERE id = :id");
        $this->db->bind(":id", $id);
        $this->db->bind(":title", $title);
        $this->db->bind(":description", $description);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProductTitleDescriptionSimgs($id, $title, $description, $sample_images) {
        $this->db->query("UPDATE products set title = :title, description = :description, sample_img = :sample_img WHERE id = :id");
        $this->db->bind(":id", $id);
        $this->db->bind(":title", $title);
        $this->db->bind(":description", $description);
        $this->db->bind(":sample_img", $sample_images);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProductTitleDescriptionFimgs($id, $title, $description, $featured_img) {
        $this->db->query("UPDATE products set title = :title, description = :description, featured_img = :featured_img WHERE id = :id");
        $this->db->bind(":id", $id);
        $this->db->bind(":title", $title);
        $this->db->bind(":description", $description);
        $this->db->bind(":featured_img", $featured_img);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
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
