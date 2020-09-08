<?php

class Kernel
{
    private $viewData ;




    public function __construct()
    {
        
// autoriser les classes autoloading 
        spl_autoload_register([$this, "loadClass"]);
        $this->viewData = [];
    }

    public function loadClass($class)
    {
        if (substr($class, -10) == "Controller")
        {
            //  fiche de controller class
            $fileName="app/controllers/$class.php";
        }
        elseif (substr($class, -5) == "Model")
        {
            // fiche de model class
            $fileName =  "app/models/$class.php";
        }
        else
        {
            // l'autres fiches (dehor de MVC)
            $fileName="app/class/$class.php";
        }

        if(file_exists($fileName))
        {
            include $fileName;
        }
        else
        {
            throw new ErrorException("impossible de trouver la classe\"$class\" dans \"$fileName\"");
        }

    }

 //  connecter les method qui appartiennent aux class et le router  

    public function run()
    {
        if (isset($_SERVER["PATH_INFO"]))
        {
            $requestPath = $_SERVER["PATH_INFO"];
        }
        else
        {
            $requestPath ="/";
        }

        $router = Router::getInstance();
        $requestRoute = $router->getRoute($requestPath);

        $controllerName=$requestRoute["controller"]."Controller";
        $controller = new $controllerName();
        $methodName=$requestRoute["method"]."Action";

        if (method_exists($controller, $methodName))
        {
            $this->viewData = array_merge($this->viewData, (array)$controller->$methodName());
            $this->renderResponse();
        }
        else
        {
            throw new ErrorException("methode \" $methodName\" inconnue dans \" $controllerName\"") ;
        }


    }


    // permettre de créer les redirects (dans les methods) ou créér des liens vers les autres pages (dans les fiches phtml)

    public function renderResponse()
    {
        extract($this->viewData, EXTR_OVERWRITE);

        if(isset($template))
        {
            $templatePath = "www/views";
            $templatePath .= "/".$template["folder"];
            $templatePath .= "/".$template["file"];
            $templatePath .= "View.phtml";

            include "www/views/layout.phtml";
        }
        elseif(isset($redirect))
        {
            $redirectUrl = Router::getInstance()->generateUrl($redirect) ;
            header("Location:$redirectUrl");
            die() ;
        }
        else{
            throw new ErrorException("type de réponse inconnue") ;
        }
    }

}




