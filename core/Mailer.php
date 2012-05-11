<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mailer
 *
 * @author sethunath_km@ispg.in
 */
require_once 'lib/Swift-4.1.6/lib/swift_required.php';
class Mailer {
    //put your code here
    private $mailer;
    private $message;
    private $to;
    private $from;
    function __construct() {
        $transport = Swift_MailTransport::newInstance();
        $this->mailer = Swift_Mailer::newInstance($transport);
        $this->message = Swift_Message::newInstance();
        $this->to = array();
        
    }
    public function addTo($email,$name=''){
        $this->to[$email]=$name;
    }
    public function setFrom($email,$name=''){
        $this->from[$email]=$name;
    }
    public function setBody($body){
        $this->message->setBody($body,'text/html');
    }
    public function setSubject($subject){
          $this->message->setSubject($subject);
    }
    public function send(){
        $this->message->setFrom($this->from);
        $this->message->setTo($this->to);
        return $this->mailer->send($this->message);
    }
}

?>
