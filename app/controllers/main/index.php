<?php
require_once(dirname(__FILE__).'/../../models/includes.php');
function _index() {
    if(Utility::isLoggedIn())
        header('Location: overview');
    else{
    $view = new View(APP_PATH . 'views/login.php');
    $view->dump();
    }
}


