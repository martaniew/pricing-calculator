<?php

// lier les view et les éléments de controler  ensamble et définir les urls de page particuliers 

class Router
{
    private $allRoutes =
        [
//            ------------ Home
            "/" =>
                [
                    "controller" => "Devis",
                    "method" => "create",
                    "name" => "batitom_devis_calculate",
                ],

//         -------------- Pricelist

            "/pricelist/create" =>
                [
                    "controller" => "Pricelist",
                    "method" => "create",
                    "name" => "batitom_pricelist_create",
                ],

           "/pricelist/showall" =>
                [
                    "controller" => "Pricelist",
                    "method" => "showall",
                    "name" => "batitom_pricelist_showall",
                ],    

            "/pricelist/update" =>
                [
                    "controller" => "Pricelist",
                    "method" => "update",
                    "name" => "batitom_pricelist_update",
                ],


            "/pricelist/delate" =>
                [
                    "controller" => "Pricelist",
                    "method" => "delate",
                    "name" => "batitom_pricelist_delate",
                ],    

//            -------------- FormQuestion

            "/formquestion/create" =>
                [
                    "controller" => "Formquestion",
                    "method" => "create",
                    "name" => "batitom_formquestion_create",
                ],

            "/formquestion/update" =>
                [
                    "controller" => "Formquestion",
                    "method" => "update",
                    "name" => "batitom_formquestion_update",
                ],

                "/formquestion/delate" =>
                [
                    "controller" => "Formquestion",
                    "method" => "delate",
                    "name" => "batitom_formquestion_delate",
                ],     
    
//            ------- Devis
            "/devis" =>
                [
                    "controller" => "Devis",
                    "method" => "create",
                    "name" => "batitom_devis_calculate",
                ],

            "/devis/show" =>
                [
                    "controller" => "Devis",
                    "method" => "show",
                    "name" => "batitom_devis_show",
                ],


            "/devis/showAll" =>
                [
                    "controller" => "Devis",
                    "method" => "showAll",
                    "name" => "batitom_devis_showAll",
                ],

//            ------- User

            "/insription" =>
                [
                    "controller" => "User",
                    "method" => "create",
                    "name" => "batitom_user_create",
                ],
            "/login" =>
                [
                    "controller" => "User",
                    "method" => "login",
                    "name" => "batitom_user_login",
                ],
            "/logout" =>
                [
                    "controller" => "User",
                    "method" => "logout",
                    "name" => "batitom_user_logout",
                ],
            "/register" =>
                [
                    "controller" => "User",
                    "method" => "register",
                    "name" => "batitom_user_register",
                ],


        ];

    private $rootURL;
    private $wwwPath;
    private $localhostPath;
    private $allUrls;
    private static $instance = null;




    private function __construct()
    {
        $this->rootURL = $_SERVER["SCRIPT_NAME"];
        $rootDir = dirname($this->rootURL);

        if($rootDir == "/")
        {
            $this->wwwPath =  "/www";
        }
        else
        {
            $this->wwwPath =  $rootDir."/www";
        }

        $this->localhostPath = $_SERVER["DOCUMENT_ROOT"];
        $this->allUrls = [] ;

        foreach ($this->allRoutes as $url => $route)
        {
            $this->allUrls[$route["name"]] = $url ;
        }
    }

    public function getWwwPath($absolute = false)
    {
        if($absolute)
        {
            return $this->localhostPath.$this->wwwPath;
        }
        else
        {
            return $this->wwwPath ;
        }
    }

    public function getRoute($requestPath)
    {
        if (isset($this->allRoutes[$requestPath]))
        {
            return $this->allRoutes[$requestPath];
        }
        else
        {
            throw new ErrorException("pas de route trouvée pour l'url:\"$requestPath\"") ;
        }
    }

    public function generateUrl($routeName)
    {
        if (isset($this->allUrls[$routeName]))
        {
            return $this->rootURL.$this->allUrls[$routeName];
        }

        else
        {
            throw new ErrorException ("Pas de route \" $routeName \" dans le router");
        }
    }

    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new Router();
        }
        return self::$instance;
    }
}

