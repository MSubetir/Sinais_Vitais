<?php
class Page {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function users_list() {
        $this->db->query('SELECT * FROM users');

        $result = $this->db->resultSet();
        $count = $this->db->rowCount();
        return [$result,$count];
    }
    
    public function users_count() {
        $this->db->query('SELECT COUNT(IdUser) as max FROM users');

        $result = $this->db->resultSet();
        return $result;
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM access WHERE username = :username');

        $this->db->bind(':username', $username);
        $row = $this->db->single();
        if (!is_object($row)) {
            return false;
        }

        $hashedPassword = $row->password;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }
}
