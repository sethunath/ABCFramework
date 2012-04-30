<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
return array(
    array(
        "controller"=>"lessons",
        "action"=>"list",
        "auth_role"=>NULL
    ),
    array(
        "controller"=>"admin",
        "action"=>"*",
        "auth_role"=>"1"
    )
);
?>
