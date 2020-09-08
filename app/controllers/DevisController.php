<?php

// Création du devis  

class DevisController
{
    public function createAction()
    {
        
// Récupérer de la base de données les données qui servent à créer les options de radio buttons et checkbox dans le formulaire    
        if (!$_POST) 
        {
            $model = new DevisModel();
            $formQuestions = $model->findAllFormQuestions();

            if (!$_POST) {
                return [
                    "template" =>
                        [
                            "folder" => "devis",
                            "file" => "calculate",
                        ],
                    "neededScripts" =>
                        [
                            "devis.js",
                        ],

                    "formQuestions" => $formQuestions,
                ];

            }
        }
// Si l'utilisateur a déjà rempli le formulaire et l'a envoyé, la fonction vérifie quelles options  de chaque question étaient cochées par l' utilisateur. 
//les Id de toutes les options cochées par l'utilisateur sont stockés dans les tableaux séparément pour chaque pièce.   
        
    elseif ($_POST)
        {
            $QuestionIds = [];

            if (isset($_POST['question-sdb-supp-ids']) && count($_POST['question-sdb-supp-ids']) >= 1)
            {
                foreach ($_POST['question-sdb-supp-ids'] as $questionId)
                {
                    $QuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-sdb-rev-mur-ids']) && count($_POST['question-sdb-rev-mur-ids']) >= 1 )
            {
                foreach ($_POST['question-sdb-rev-mur-ids'] as $questionId)
                {
                    $QuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-sdb-no-mur-ids']) && count($_POST['question-sdb-no-mur-ids']) >= 1 )
            {
                foreach ($_POST['question-sdb-no-mur-ids'] as $questionId)
                {
                    $QuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-sdb-act-mur-ids']) && count($_POST['question-sdb-act-mur-ids']) >= 1 )
            {
                foreach ($_POST['question-sdb-act-mur-ids'] as $questionId)
                {
                    $QuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-sdb-et-mur-ids']) && count($_POST['question-sdb-et-mur-ids']) >= 1 )
            {
                foreach ($_POST['question-sdb-et-mur-ids'] as $questionId)
                {
                    $QuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-sdb-nov-mur-ids']) && count($_POST['question-sdb-nov-mur-ids']) >= 1 )
            {
                foreach ($_POST['question-sdb-nov-mur-ids'] as $questionId)
                {
                    $QuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-sdb-et-plaf-ids']) && count($_POST['question-sdb-et-plaf-ids']) >= 1 )
            {
                foreach ($_POST['question-sdb-et-plaf-ids'] as $questionId)
                {
                    $QuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-sdb-equip-ids']) && count($_POST['question-sdb-equip-ids']) >= 1 )
            {
                foreach ($_POST['question-sdb-equip-ids'] as $questionId)
                {
                    $QuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-sdb-vent-ids']) && count($_POST['question-sdb-vent-ids']) >= 1 )
            {
                foreach ($_POST['question-sdb-vent-ids'] as $questionId)
                {
                    $QuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-sdb-elec-ids']) && count($_POST['question-sdb-elec-ids']) >= 1 )
            {
                foreach ($_POST['question-sdb-elec-ids'] as $questionId)
                {
                    $QuestionIds[] = $questionId;
                }
            }

            $cuisQuestionIds = [];

            if (isset($_POST['question-cuis-rev-sol-ids']) && count($_POST['question-cuis-rev-sol-ids']) >= 1 )
            {
                foreach ($_POST['question-cuis-rev-sol-ids'] as $questionId)
                {
                    $cuisQuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-cuis-no-sol-ids']) && count($_POST['question-cuis-no-sol-ids']) >= 1 )
            {
                foreach ($_POST['question-cuis-no-sol-ids'] as $questionId)
                {
                    $cuisQuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-act-mur-cuis-ids']) && count($_POST['question-act-mur-cuis-ids']) >= 1 )
            {
                foreach ($_POST['question-act-mur-cuis-ids'] as $questionId)
                {
                    $cuisQuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-nov-mur-cuis-ids']) && count($_POST['question-nov-mur-cuis-ids']) >= 1 )
            {
                foreach ($_POST['question-nov-mur-cuis-ids'] as $questionId)
                {
                    $cuisQuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-et-plaf-cuis-ids']) && count($_POST['question-et-plaf-cuis-ids']) >= 1 )
            {
                foreach ($_POST['question-et-plaf-cuis-ids'] as $questionId)
                {
                    $cuisQuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-cuis-point-ids']) && count($_POST['question-cuis-point-ids']) >= 1 )
            {
                foreach ($_POST['question-cuis-point-ids'] as $questionId)
                {
                    $cuisQuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-cuis-elem-ids']) && count($_POST['question-cuis-elem-ids']) >= 1 )
            {
                foreach ($_POST['question-cuis-elem-ids'] as $questionId)
                {
                    $cuisQuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-cuis-point-en-eau-ids']) && count($_POST['question-cuis-point-en-eau-ids']) >= 1 )
            {
                foreach ($_POST['question-cuis-point-en-eau-ids'] as $questionId)
                {
                    $cuisQuestionIds[] = $questionId;
                }
            }

            $pdvQuestionIds = [];

            if (isset($_POST['question-pdv-rev-sol-ids']) && count($_POST['question-pdv-rev-sol-ids']) >= 1 )
            {
                foreach ($_POST['question-pdv-rev-sol-ids'] as $questionId)
                {
                    $pdvQuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-pdv-no-sol-ids']) && count($_POST['question-pdv-no-sol-ids']) >= 1 )
            {
                foreach ($_POST['question-pdv-no-sol-ids'] as $questionId)
                {
                    $pdvQuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-act-mur-pdv-ids']) && count($_POST['question-act-mur-pdv-ids']) >= 1 )
            {
                foreach ($_POST['question-act-mur-pdv-ids'] as $questionId)
                {
                    $pdvQuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-nov-mur-pdv-ids']) && count($_POST['question-nov-mur-pdv-ids']) >= 1 )
            {
                foreach ($_POST['question-nov-mur-pdv-ids'] as $questionId)
                {
                    $pdvQuestionIds[] = $questionId;
                }
            }

            if (isset($_POST['question-et-plaf-pdv-ids']) && count($_POST['question-et-plaf-pdv-ids']) >= 1 )
            {
                foreach ($_POST['question-et-plaf-pdv-ids'] as $questionId)
                {
                    $pdvQuestionIds[] = $questionId;
                }
            }

            $quantitiesByQuestionIds = [];

            foreach ($QuestionIds as $questionId)

            {
                $quantitiesByQuestionIds[$questionId] = $_POST["$questionId-quantity"];
            }

            $cuisQuantitiesByQuestionIds = [];


            foreach ($cuisQuestionIds as $questionId)

            {
                $cuisQuantitiesByQuestionIds[$questionId] = $_POST["$questionId-quantity-cuis"];

            }

            $pdvQuantitiesByQuestionIds = [];

            foreach ($pdvQuestionIds as $questionId)

            {
                $pdvQuantitiesByQuestionIds[$questionId] = $_POST["$questionId-quantity-pdv"];

            }

// Si le formulaire est envoyé par un utilisateur connecté, la fonction télécharge l'ID de l' utilisateur
// puis crêe un devis dans la base de données et le joindre avec id devis 
// Si le formulaire été envoyé par un utilisateur non connecté, la fonction crêe un devis dans la base de données sans id d'utilisateur,
// puis  établit la session pour stocker l'id du devis.               

            $model = new DevisModel();
            if (UserSession::getInstance()->isAuthenticated())
            {
                $userId = UserSession::getInstance()->getId();
                $devisId = $model->createDevis($userId);
            }
            else
            {
                $devisId = $model->createDevisNonAuth();
            }

            if(session_status() == PHP_SESSION_NONE)
            {
                session_start();
            }
            
            $_SESSION['devisId'] = $devisId;

// Création du lien entre un tableeu "devis" où id de devis est stocké
// et le tableau "devisdetail" où les id des options cochées par utilisateur sont stockés 
         
            $model = new DevisDetailsModel();
            $model->createDevisDetails($devisId, $quantitiesByQuestionIds, $cuisQuantitiesByQuestionIds, $pdvQuantitiesByQuestionIds);

            if (UserSession::getInstance()->isAuthenticated())
            {
                return ["redirect" => "batitom_devis_show"];
            }

            if (!UserSession::getInstance()->isAuthenticated())
            {
                Flashbag::getInstance()->addMessage("Votre estimation est prête ! La création de votre compte est nécessaire pour consulter votre estimation.");
                return ["redirect" => "batitom_user_create"];
            }
        }

        else {
            var_dump("donnés invalides");
        }

    }   
    

// une fonction affiche le devis sélectionné 

    public function showAction()
    {

// Selon comment l'utilisateur arrive sur la page, les détails de devis  sont récupèrés  de la base de données soit grâce à devis ID envoyé par méthode GET 
//en chaîne de requête (de la liste de tous le devis crées par utilisateur) soit grâce à devis ID stocké dans la session (redirection après envoyé le formulaire).
        if(isset($_GET['id']))
        {
            $devisId = $_GET['id'];
        }

        else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['devisId'])) {

                $devisId = $_SESSION['devisId'];
            }
        }

//Récupération des données nécessaires pour créer l'estimation  et l’afficher à utilisateur 

            $model = new DevisDetailsModel();
            $devisDetails = $model->findDevisDetails($devisId);

// Calcul du cout total de rénovation             

            $totalPrice = 0;
            foreach ($devisDetails as $devisDetail) {
                $totalPrice += $devisDetail['quantity'] * $devisDetail['price'];
            }

            return [
                "template" =>
                    [
                        "folder" => "devis",
                        "file" => "show",
                    ],
                "devisDetails" => $devisDetails,
                "totalPrice" => $totalPrice,

            ];
        }

// Afficher tous les devis préparés pour un utilisateur         

    public function showAllAction()
    {

        if (!UserSession::getInstance()->isAuthenticated()) {
            Flashbag::getInstance()->addMessage("Merci de vous connecter pour consulter votre devis.");
            return ["redirect" => "batitom_user_login"];
        }

        $userId = UserSession::getInstance()->getId();

        $model = new DevisModel();
        $AlldeviIds = $model->findAllDevis($userId);

        return [
            "template" =>
                [
                    "folder" => "devis",
                    "file" => "showAll",
                ],
            "AlldeviIds" => $AlldeviIds
        ];
    }

}