<?php

// class qui gère les messages pour l'utilisateur

class Flashbag

{

    private static $instance = null;


    private function __construct()
    {


        if (session_status()== PHP_SESSION_NONE)

        {
            session_start();
        }

        // si le tableau avec les messages n'existe pas encore dans le session on le crée

        if (!array_key_exists("flashbag", $_SESSION))
        {
            $_SESSION["flashbag"] = [];

        }

    }

    // Ajouter le message à la tableau

    public function addMessage($message)
    {
        $_SESSION["flashbag"][] = $message;
    }

    // Vider le tableau de vieux messages

    public function consumeAllMessages()
    {
        $allMessages = $_SESSION["flashbag"];
        $_SESSION["flashbag"] = [];
        return $allMessages;
    }



    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new Flashbag();
        }
        return self::$instance;

    }

}



