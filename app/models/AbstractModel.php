<?php

// étabilir la connection avec la basse de données 

abstract class AbstractModel
{
    protected $pdo;
    public function __construct()
    {
        $this->pdo=Database::getInstance()->getPdo();
    }
}