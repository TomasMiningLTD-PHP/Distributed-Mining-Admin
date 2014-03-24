<?php
require_once(dirname(__FILE__).'/../../models/includes.php');
function _index(){
    if(Utility::isLoggedIn()){
        $view = new View(APP_PATH . 'views/overview.html');
        $view->dump();
    }
    else{
     header('Location: .');
    }
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



