<?php
function _login(){
    $view = new View(APP_PATH . 'views/overview.html');
    $view->dump();
    /*$db_info = Utility::readDbInfo();
    $this->db = new Database($db_info[0],$db_info[1],$db_info[2],$db_info[3]);*/
}
function createTestUser($userName){
    Database::$db
    
}
    /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

