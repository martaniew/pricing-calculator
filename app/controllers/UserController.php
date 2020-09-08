<?php



class UserController

{

     public function createAction()
    {

        if(!$_POST)
        {
            return
                [
                    "template" =>
                        [
                            "folder" => "user",
                            "file" => "create",
                        ],

                    "neededScripts" =>
                        [
                            "FormValidator.class.js",
                        ],

                ];
        }
        elseif (isset($_POST["name"])
            && isset($_POST["forname"])
            && isset($_POST["numTel"])
            && isset($_POST["email"]) && filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)
            && isset($_POST["pwd"]) && strlen($_POST["pwd"]) >= 8
            && isset($_POST["pwd-confirm"])
            && $_POST["pwd"] === $_POST["pwd-confirm"]
        )
        {
            $pwdClear = $_POST["pwd"];
            $name = trim($_POST["name"]);
            $forname = trim($_POST["forname"]);
            $numTel = trim($_POST["numTel"]);
            $email = $_POST["email"];

            $model = new UserModel();

// une tentative de créer l'utilisateur dans le base de données
            try {

                $userId = $model->create($pwdClear, $name, $forname, $numTel, $email);

            }
            
// attraper et afficher l'erreur générée lors de la tentative de créer l'utilisateur

            catch (DomainException $e)
            {
                Flashbag::getInstance()->addMessage($e->getMessage());
                return ["redirect" => "batitom_user_create"];
            }

            if(session_status() == PHP_SESSION_NONE)
            {
                session_start();
            }

// Si l'utlisateur vient de la dernière étape de création du devis, la fonction récoupere le devis Id stocké dans la session et 
//puis sauvegarde le nouveau User ID créé dans le tableau "devis" 

            if (isset($_SESSION['devisId']))

            {
                $devisId = $_SESSION['devisId'];
                var_dump($devisId, $userId);
                $model = new DevisModel();
                $model->findDevisIDtoAddUserId($devisId, $userId); 
              
                Flashbag::getInstance()->addMessage("Votre compte a bien été créé ! Vous pouvez vous connecter pour consulter votre devis");

                return ["redirect" => "batitom_user_login"];

            }

            Flashbag::getInstance()->addMessage("Votre compte a bien été créé ! Tu peux se connecter");

            return ["redirect" => "batitom_user_login"];
        }

        else
        {

            Flashbag::getInstance()->addMessage("donnée POST invalides pour l'inscription");
            return ["redirect" => "batitom_user_create"];

        }

    }



    public function loginAction()
    {
        if(!$_POST)

        {
            return
                [
                    "template" =>
                        [
                            "folder" => "user",
                            "file" => "login",
                        ],

                    "neededScripts" =>
                        [
                            "FormValidator.class.js",
                        ],
                ];
        }

        else
        {
            if(!isset($_POST["email"]) || !isset($_POST["pwd"]))
            {
                Flashbag::getInstance()->addMessage(" No!");
            }

// Vérification si la paire constituée du  mot de passe et du nom d'utilisateur existe dans la basse de données
            $model = new UserModel();
            try
            {
                $user = $model->findUserAndCheckPassword($_POST["email"], ($_POST["pwd"]));
            }
// attraper et afficher l'erreur générée pendant la tentative de la vérification 
            catch (DomainException $e)

            {
                Flashbag::getInstance()->addMessage($e->getMessage());
                return ["redirect" => "batitom_user_login"];
            }

// établir "user session" et récupérer les données d'utilisateur qui vient de se connecter

            UserSession::getInstance()->create($user['id'], $user['forname'], $user['name'],$user['email'], $user['isAdmin']);

// Si l'utlisateur vient de la dernière étape de création de devis, 
// fonction récoupère le devis Id stocké dans la session et puis sauvegarde le User ID de utilisateur qui vient de se connecter dans le tableau "devis". 

            if(session_status() == PHP_SESSION_NONE)
            {
                session_start();
            }

            if (isset($_SESSION['devisId']))

            {   $devisId = $_SESSION['devisId'];
                UserSession::getInstance()->getId();
                $model = new DevisModel();
                $model->findDevisIDtoAddUserId($devisId, $user['id']);

                return ["redirect" => "batitom_devis_show"];

            }

            return ["redirect" => "batitom_devis_showAll"];


        }
    }

    public function logoutAction()
    {
        UserSession::getInstance()->kill();
        return["redirect"=> "batitom_devis_calculate"];
    }
}




