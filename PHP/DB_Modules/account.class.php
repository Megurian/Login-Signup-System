<?php
require_once 'database.php';

class User {
    public $username = '';
    public $email = '';
    public $first_name = '';
    public $last_name = '';
    public $password = '';
    public $salt = '';

    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function userSignup() {
        $sql = "INSERT INTO user (username, email, first_name, last_name, password, salt) VALUES (:username, :email, :first_name, :last_name, :password, :salt);";

        $prepQuery = $this->db->connect()->prepare($sql);

        $prepQuery->bindParam(':username', $this->username);
        $prepQuery->bindParam(':email', $this->email);
        $prepQuery->bindParam(':first_name', $this->first_name);
        $prepQuery->bindParam(':last_name', $this->last_name);
        $prepQuery->bindParam(':password', $this->password);
        $prepQuery->bindParam(':salt',$this->salt);

        if($prepQuery->execute()) {
            return true;
        } else {
            return false;
        }
    }


}

/* $obj = new User();
$obj->addUser(); */