<?php
require_once 'database.php';

class User {
    public $username = 'EH202201078';
    public $email = 'eh202201078';
    public $first_name = 'Meg Ryan';
    public $last_name = 'Gomez';
    public $password = 'MegRyanPH244';

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function addUser() {
        $sql = "INSERT INTO user (username, email, first_name, last_name, password) VALUES (:username, :email, :first_name, :last_name, :password);";

        $prepQuery = $this->db->connect()->prepare($sql);

        $prepQuery->bindParam(':username', $this->username);
        $prepQuery->bindParam(':email', $this->email);
        $prepQuery->bindParam(':first_name', $this->first_name);
        $prepQuery->bindParam(':last_name', $this->last_name);
        $prepQuery->bindParam(':password', $this->password);

        if($prepQuery->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

/* $obj = new User();
$obj->addUser(); */