<?php

class User {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create($username, $name, $email, $password){
        $this->db->query("INSERT INTO user_accounts (username, name, email, password) VALUES (:username, :name, :email, :password)");
        $this->db->bind(":username", $username);
        $this->db->bind(":name", $name);
        $this->db->bind(":email", $email);
        $this->db->bind(":password", md5($password));

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update($username, $name, $email, $password, $id) {
        $this->db->query("UPDATE user_accounts SET username = :username, name = :name, email = :email, password = :password WHERE id = :id");
        $this->db->bind(":username", $username);
        $this->db->bind(":name", $name);
        $this->db->bind(":email", $email);
        $this->db->bind(":password", md5($password));
        $this->db->bind(":id", $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllUser()
    {
        $this->db->query("SELECT * FROM user_accounts ORDER BY name ASC");
        return $this->db->resultSet();
    }

}