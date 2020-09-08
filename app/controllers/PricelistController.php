<?php

class PricelistController
{

// Partie pour l'utilisateur avec le statut d'administrateur 


// Une fonction permets de créer et sauvegarder dans la basse de données les éléments de liste de prix  

    public function createAction()
    {

        if(!UserSession::getInstance()->isAdmin())
        {
            return ["redirect" => "batitom_devis_calculate"];
        }

        if(!$_POST)
        {
            return [
                "template" =>
                    [
                        "folder" => "pricelist",
                        "file" => "create",
                    ], 

                "neededScripts" =>
                    [
                        "FormValidator.class.js",
                    ],
            ];
        }    
                
        elseif (isset($_POST["title"]) &&
                isset($_POST["description"]))
        {
            $title = trim($_POST["title"]);
            $description = trim($_POST["description"]);



            $model = new PricelistModel();
            $id = $model->create($title, $description, $_POST["prix"], $_POST["bym2"], $_POST["dontFurniture"]);



            Flashbag::getInstance()->addMessage("bien ajoutter");

            return ["redirect" => "batitom_pricelist_create"];
        }
        else
        {
            die("donnée invalides") ;
        }


    }
    
// Une fonction permets d'afficher tous les éléments de liste de prix de la basse de données
    public function showAllAction()
    {
        if(!UserSession::getInstance()->isAdmin())
        {
            return ["redirect" => "resto_home_main"];
        }
        $model = new PricelistModel(); 
        $allPrices = $model->findAll(); 

// Récupére de la de base de données toutes les options de questions qui sont liées aux éléments de liste de prix particuliers         

        $questionModel = new FormquestionModel(); 
        $byPriceAllQuestions = $questionModel->findAllByPrice(); 

        $allQuestions = []; 

        foreach ($byPriceAllQuestions as $question) {

        $allQuestions[$question["pricelist_id"]][] = $question; 
        }

        return [
        "template"=>
            [
                "folder"=>'pricelist', 
                'file'=>'showAll', 
            ], 

            "allPrices" => $allPrices,  
            'allQuestions' => $allQuestions,
        ]; 
    }

// La mise à jour des options disponibles dans les questions du formulaire     

public function updateAction() 
{

    if(!UserSession::getInstance()->isAdmin())
    {
        return ["redirect" => "batitom_devis_calculate"];
    }


    if (isset ($_GET['id']) && ctype_digit($_GET['id']))
    {
       
        $priceModel = new pricelistModel;
        $price = $priceModel->find($_GET['id']) ;
       

        if (!$price) {
            return [redirect=> "batitom_devis_calculate"]; 
        }

        return [
            "template" =>
                [
                    "folder" => "pricelist",
                    "file" => "update",
                ],
            "price" => $price, 

            "neededScripts" =>
                        [
                            "FormValidator.class.js",
                        ],    
        ];

    }

    elseif(isset($_POST["title"]) 
    && isset($_POST["description"]) 
    && isset($_POST['id']) && ctype_digit($_POST['id']))
    {
        $title = trim($_POST["title"]);
        $description = trim($_POST["description"]);
        $id = $_POST['id'];

        $model = new PricelistModel(); 
        $price = $model->find($_POST['id']); 
        $model->update($_POST['id'], $title, $description,  $_POST["bym2"], $_POST["dontFurniture"],  $_POST["prix"] ); 

        Flashbag::getInstance()->addMessage("prix bien mis a jour");
        return ["redirect" => "batitom_pricelist_showall"];
    }
       
}

public function delateAction()  {

    if(!UserSession::getInstance()->isAdmin())
        {
            return ["redirect" => "batitom_devis_calculate"];
        }

        if (isset($_GET['id']) && ctype_digit($_GET['id']))
        {
            $model = new PricelistModel(); 
            $model->delate($_GET['id']); 

            return ["redirect" => "batitom_pricelist_showall"];
        }

}


}
