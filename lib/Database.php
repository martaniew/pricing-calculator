<?php

// Paramètres de configuration de la base de données



class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $this->pdo = new PDO
        (
            "mysql:host=localhost;port=3308;dbname=calculator_batitom_db;charset=UTF8",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new Database();
        }
        return self::$instance;
    }
}



