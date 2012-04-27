<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author nauphal
 */
require_once 'View.php';
require_once 'Mailer.php';
require_once('lib/redbean/rb.php');
class Controller {
    //put your code here
    protected $view;
    protected $urlParts;
    protected $mailer;
    function __construct($urlParts) {
        $this->view = new View();
        $this->urlParts = $urlParts;
        R::setup('mysql:host=localhost;dbname=nspdindi_livedb','nspdindi_liveusr','KJL234U213pO1');
    }
    protected function debugUrlParts(){
        print_r($this->urlParts);
    }
    protected function getArgument($index){
        $index = $index+3;
        return $this->urlParts[$index];
    }
    protected function getMailer(){
        return $this->mailer = new Mailer();
    }
	protected function getUser() {
		return $_SESSION['user'];
	}
}
?>
