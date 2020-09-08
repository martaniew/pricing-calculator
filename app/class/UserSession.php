<?php

class UserSession
{
    private static $instance = null;

    private function __construct()
    {
        if (session_status()==PHP_SESSION_NONE)

        {
// Démarrage du module PHP de gestion des sessions.
            session_start();
        }
    }


// Construction de la session utilisateur.
    public function create($id, $forname, $name, $email, $isAdmin)
    {
        $_SESSION["user"]=[ 'id' => $id,
            'forname' => $forname,
            'name' => $name,
            'email' => $email,
            'isAdmin' => $isAdmin,
        ];
    }

// Destruction de l'ensemble de la session.
    public function kill()
    {

        $_SESSION =[];
        session_destroy();

    }

// Verification si l'utilisateur est connecté 

    public function isAuthenticated()
    {
        return isset($_SESSION["user"]);
    }


// Verification si l'utilisateur a le statut d'administateur      
    public function isAdmin()
    {
        if(!$this->isAuthenticated())
        {
            return false;
        }

        return $_SESSION["user"]["isAdmin"];
    }

// Récupération de donnes d'utilisateur qui est connecté        

    public function getId()
    {
        if(!$this->isAuthenticated())
        {
            return false;
        }

        return $_SESSION["user"]["id"];
    }


    public function getLastname()
    {
        if(!$this->isAuthenticated())
        {
            return false;
        }

        return $_SESSION["user"]["name"];
    }

    public function getForname()
    {
        if(!$this->isAuthenticated())
        {
            return false;
        }

        return $_SESSION["user"]["forname"];
    }

    public function getEmail()
    {
        if(!$this->isAuthenticated())
        {
            return false;
        }

        return $_SESSION["user"]["email"];
    }




    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new UserSession();
        }
        return self::$instance;
    }

}