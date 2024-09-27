<?php
require_once 'database.php';
require_once 'C:\xampp\htdocs\LoginSignup System\PHP\System Modules\functions.php';

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

    function userLogin($email = null, $username = null, $password) {
        $sql = "SELECT * FROM user WHERE ";

        if(!is_null($email)) {
            $sql .= "email = :email LIMIT 1;";
            $identifier = $email;
        } elseif (!is_null($username)) {
            $sql .= "username = :username LIMIT 1;";
            $identifier = $username;
        } else {
            return false;
        }

        $prepQuery = $this->db->connect()->prepare($sql);
        $prepQuery->bindParam(':identifier', $identifier);

        if($prepQuery->execute()) {
            $data = $prepQuery->fetch();
            if($data && password_verify(modifiedPasswordHashing($password, $data['salt']), $data['password'])) {
                return true;
            }
        }

        return false; 
    }
}

$obj = new User();
/* $obj->userLogin(null, 1 ,1); */
/* $obj->addUser(); */