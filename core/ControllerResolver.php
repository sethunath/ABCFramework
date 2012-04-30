<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerResolver
 * @author nauphal
 */
class ControllerResolver {
    //put your code here
    private $requestUri ;
    private $uriParts ;
    function __construct() {
        $this->setRequestUri($_SERVER['REQUEST_URI']);
        $this->uriParts = ControllerResolver::getUriParts();
    }

    public function getRequestUri() {
        return $this->requestUri;
    }

    public function setRequestUri($requestUri) {
        $this->requestUri = $requestUri;
    }
    
    public function resolveController(){
        $class_name = $this->uriParts[1]."Controller";
        if(!file_exists("controllers/".$class_name.".php")){
            throw new Exception("File for Controller $class_name Not Found");
        }
        else{
            require_once "controllers/".$class_name.".php";
        }
        if(!class_exists($class_name)){
            throw new Exception("Controller $class_name Not Found");
        }
        $controller = new $class_name($this->uriParts);
        if(isset($this->uriParts[2]))
            $action = $this->uriParts[2]."Action";
        else
            $action = "indexAction";
        if(!method_exists($controller,$action )){
            throw new Exception("Action $action Not Found in $class_name ");
        }
        else{
            $controller->$action($this->uriParts);
        }
    }
    public static function getUriParts(){
        $request_uri =  $_SERVER['REQUEST_URI'];
        $uriparts =  explode("app.php",$request_uri);
        return explode("/", $uriparts[1]);
    }
}
?>
