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

    function userLogin($email, $username, $password) {
        $sql = "SELECT * FROM user WHERE ";

        //decide whether username/email to use
        if(!is_null($email)) {
            $sql .= "email = :email LIMIT 1;";
            $prepQuery = $this->db->connect()->prepare($sql);
            $prepQuery->bindParam(':email', $email);
        } elseif (!is_null($username)) {
            $sql .= "username = :username LIMIT 1;";
            $prepQuery = $this->db->connect()->prepare($sql);
            $prepQuery->bindParam(':username', $username);
        } else {
            return false;
        }

        if($prepQuery->execute()) {
            $data = $prepQuery->fetch();
            if($data && password_verify($password, $data['password'])) {
                
                return true;
            }
        }

        return false; 
    }

    function fetchUser($email, $username){
        $sql = "SELECT * FROM user WHERE ";

        if(!is_null($email)) {
            $sql .= "email = :email LIMIT 1;";
            $prepQuery = $this->db->connect()->prepare($sql);
            $prepQuery->bindParam(':email', $email);
        } elseif (!is_null($username)) {
            $sql .= "username = :username LIMIT 1;";
            $prepQuery = $this->db->connect()->prepare($sql);
            $prepQuery->bindParam(':username', $username);
        } else {
            return false;
        }


        $data = null;
        if($prepQuery->execute()){
            $data = $prepQuery->fetch();
        }

        return $data;
    }
}

$obj = new User();
/* $obj->userLogin('eh202201078@wmsu.edu.ph', null ,'MegRyanPH244'); */
/* $obj->addUser(); */