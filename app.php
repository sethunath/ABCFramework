<?php

session_start();

require_once 'core/ControllerResolver.php';
require_once 'core/Auth.php';
require_once 'core/Exceptions/AuthenticationFailedException.php';

$auth = Auth::getInstance();
try{
    $auth->authorize();
}
catch (AuthenticationFailedException $e){
    //$auth->loginRedirect();
}

$controllerResolver = new ControllerResolver();
$controllerResolver->resolveController();
?>