<?php

class DB
{
    private $host;
    private $db;
    private $user;
    private $password;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->db = 'movies';
        $this->user = 'root';
        $this->password = '';
    }

    function connect()
    {        
        $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db;
        try {
            $pdo = new PDO($connection, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            print_r("Error connection: " . $e->getMessage());
        }
    }
}