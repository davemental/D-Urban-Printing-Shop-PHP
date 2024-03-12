<?php

class imageCarousel {

    private $db;

    public function __construct() { 
        $this->db = new Database();
    }

    public function create($img_name, $user_id){
        $this->db->query("INSERT INTO image_carousel (img_name, user_id) VALUES (:img_name, :user_id)");
        $this->db->bind(":img_name", $img_name);
        $this->db->bind(":user_id", $user_id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllImage(){
        $this->db->query("SELECT * FROM image_carousel");
        return $this->db->resultSet();
    }

    public function deleteImageByName($img) {
        $this->db->query("DELETE FROM image_carousel WHERE img_name = :img_name");
        $this->db->bind(":img_name", $img);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}