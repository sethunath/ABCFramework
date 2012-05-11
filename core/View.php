<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author nauphal
 */
require 'ViewElement.php';
require "Exceptions/NotFoundException/ViewNotFoundException.php";
class View {
    private  $filePath;
    private $vars;

    function __construct() {
        $this->vars = array();
    }

    public function setVar($name,$value){
        $this->vars[$name] = new ViewElement($value);
    }

    public function debugVars(){
        print_r($this->vars);
    }
    
    public  function render($filePath,$return=false){
        if(!file_exists($filePath)){
            throw new ViewNotFoundException($filePath);
        }
        $this->filePath = $filePath;
        ob_start();
        require "views/".$filePath;
        $viewContents = ob_get_contents();
        ob_clean();
        if($return){
                return $viewContents;
        }
        else{
            echo $viewContents;
        }
    }
}
?>