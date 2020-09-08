<?php

class FormquestionController

{

// Partie liée au cas où l'utilisateur a le statut d'administrateur 


// Fonction permets de créer et sauvegarder dans la base de données les options disponibles dans les questions 

    public function createAction()
    {
        if(!UserSession::getInstance()->isAdmin())
        {
            return ["redirect" => "batitom_devis_calculate"];
        }

// Récupération dans la base de données des éléments de liste de prix pour les lier avec les options (radio buttons et checkbox) disponibles dans les questions
        
        if (!$_POST) {
            $model = new PricelistModel();
            $allPrices = $model->displayAllToMakePriceList();

            return [
                "template" =>
                    [
                        "folder" => "formquestion",
                        "file" => "create",
                    ],

                "neededScripts" =>
                    [
                        "FormValidator.class.js",
                    ],



                "allPrices" => $allPrices,
            ];
        } elseif ($_POST) {
            if (isset($_POST["title"])
                && strlen(trim($_POST["title"])) >= 2
                && isset($_POST["category"])
                && strlen(trim($_POST["category"])) >= 3
                && isset($_POST['price-ids']) && count($_POST['price-ids']) >= 1
            ) {

                $title = trim($_POST["title"]);
                $category = trim($_POST["category"]);
        


                $priceIds = [];
                foreach ($_POST['price-ids'] as $priceId)
                {
                    $priceIds[$priceId] = $priceId ;
                }


                $model = new FormquestionModel();

                $questionId = $model->create($title, $category);

// Lier les questions Id avec les éléments de liste de prix

                $model->addPriceAndQuestion($questionId, $priceIds);

                Flashbag::getInstance()->addMessage("Le question a bien été créé");
                return [
                    "redirect" => "batitom_formquestion_create",
                ];

            } else {
                die("donnée invalides");
            }
        }

    }

// La mise a jour des options disponibles dans les questions du formulaire     

    public function updateAction() 
    {

        $questionModel = new FormquestionModel();
        $priceModel = new PricelistModel(); 

        if(!UserSession::getInstance()->isAdmin())
        {
            return ["redirect" => "batitom_devis_calculate"];
        }

        if (isset ($_GET['id']) && ctype_digit($_GET['id']))
        {

// Récupérer les données concernant l’option particulière pour préremplir le formulaire de mise à jour             
           
            $question = $questionModel->find($_GET['id']) ;
            $checkedprices = $priceModel->findCheckedPriceElements($_GET['id']) ;

           

            if (!$question) {
                return [redirect=> "batitom_devis_calculate"]; 
            }

            return [
                "template" =>
                    [
                        "folder" => "formquestion",
                        "file" => "update",
                    ],

                "neededScripts" =>
                    [
                        "FormValidator.class.js",
                    ],

                "question" => $question,
                "checkedprices" => $checkedprices, 

            ];
        }

// Sauvegarder la  mise à jour dans la base de données         

        elseif (isset($_POST["title"])
        && strlen(trim($_POST["title"])) >= 2
        && isset($_POST["question"])
        && isset($_POST['checkedprice_ids']) && count($_POST['checkedprice_ids']) >= 1
        && isset($_POST['id']) && ctype_digit($_POST['id'])) 
        {
      
// Comparer les éléments de liste de prix qui étaient déjà liés aux options de questions à ceux qui sont décochées par l'utilisateur

            $question = $questionModel->find($_POST['id']) ;
            $oldCheckedPrices = $priceModel->findScalarPriceIdsInQuestion($_POST['id']) ;
            $pricesToRemove = array_diff($oldCheckedPrices, $_POST['checkedprice_ids']) ;
            $questionModel->update($_POST['id'], $_POST["title"], $_POST["question"]);

            $priceIds = [];
                foreach ($_POST['checkedprice_ids'] as $priceId)
                {
                    $priceIds[$priceId] = $priceId ;
                }
           
                $questionModel->addPrices($_POST['id'], $priceIds);
                $questionModel->removePrices($_POST['id'], $pricesToRemove);   
         

           Flashbag::getInstance()->addMessage("Le question a bien été changé");
                return [
                    "redirect" => "batitom_devis_calculate",
                ];

        }
       
    }


    public function delateAction()  {

        if(!UserSession::getInstance()->isAdmin())
            {
                return ["redirect" => "batitom_devis_calculate"];
            }
    
            if (isset($_GET['id']) && ctype_digit($_GET['id']))
            {
                $model = new FormquestionModel(); 
                $model->delate($_GET['id']); 
    
           return ["redirect"=> "batitom_devis_calculate"];
            }
    
    }

    
}



