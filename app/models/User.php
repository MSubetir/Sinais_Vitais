<?php
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->query('INSERT INTO users (name, lat, lon, email, nascimento, telefone, rua, numero, cidade, estado, cep) VALUES(:name, :lat, :lon, :email, :nascimento, :telefone, :rua, :numero, :cidade, :estado, :cep)');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':lat', $data['lat']);
        $this->db->bind(':lon',  $data['lon']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':nascimento', $data['nascimento']);
        $this->db->bind(':telefone', $data['telefone']);
        $this->db->bind(':rua', $data['rua']);
        $this->db->bind(':numero', $data['numero']);
        $this->db->bind(':cidade', $data['cidade']);
        $this->db->bind(':estado', $data['estado']);
        $this->db->bind(':cep', $data['cep']);

        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function users_list() {
        $this->db->query('SELECT * FROM users');

        $result = $this->db->resultSet();
        return $result;
    }

    public function one_user($id) {
        $this->db->query('SELECT * FROM users where IdUser = :id');
        $this->db->bind(':id', $id);
        
        $result = $this->db->single();
        return $result;
    }

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');

        $this->db->bind(':email', $email);

        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
