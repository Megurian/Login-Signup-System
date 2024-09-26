<?php
require_once 'database.php';

class User {
    public $username = '';
    public $email = '';
    public $first_name = '';
    public $last_name = '';
    public $password = '';

    protected $db;

    function __construct() {
        $this->db = new Database();
    }
}