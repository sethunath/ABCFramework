<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author sethunath_km@ispg.in
 */
require_once 'core/ControllerResolver.php';
require_once 'Exceptions/AuthenticationFailedException.php';
class Auth {
    //put your code here
    private static $instance;
    private static $auth_session_key = "user";
    private static $auth_session_field = "id";
    private static $auth_session_role = "user_type";
    private static $auth_data = NULL;
    private static $auth_fail_url = "/app.php/login";
    private function __construct()
    {
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }
    public function authorize(){
        
        $auths = require_once 'config/auth_config.php';
        //print_r($_SESSION['user']);exit;
        $uriParts = ControllerResolver::getUriParts();
        
        foreach($auths as $auth){
            if($uriParts[1] == $auth['controller'] && ( $uriParts[2] == $auth['action'] || $uriParts[2] == '*')){
                
                if(!$this->isSessionSet()){
                    throw new AuthenticationFailedException("Session not set");
                }
                if($this->getUserRole() != $auth['auth_role']){
                    throw new AuthenticationFailedException("Role doesnt match");
                }
            }
        }
        return true;
    }
    public function loginRedirect(){
        header("Location:".Auth::$auth_fail_url);
    }
    private function isSessionSet(){
        return isset($_SESSION['user']) && isset($_SESSION['user']['email']);
    }
    private function getUserRole(){
        return $_SESSION['user'][$auth_session_role];
    }
}

?>
