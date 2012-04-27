<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewElement
 *
 * @author sethunath_km@ispg.in
 */
class ViewElement {
    //put your code here
    private $value;
    private $escape=true;
    function __construct($value='') {
        $this->value = $value;
    }
    public function raw(){
        $this->escape = false;
        return $this;
    }
    public function getValue(){
        return $this->value;
    }
    public function substring($start,$length=null){
        $this->value = substr($this->value, $start,$length);
        return $this;
    }
    public function __toString() {
        $val = $this->value;
        if($this->escape){
            $val = htmlentities($val);
        }
        return (string) $val;
    }
    
}

?>
