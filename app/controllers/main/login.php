<?php
function _login(){
    Database::initDb();
    $username = htmlspecialchars(mysql_escape_string($_POST['username']));
    $password = htmlspecialchars(mysql_escape_string($_POST['password']));
    
    createTestUser($username,$password);
    if(User::findByUsername($username) != null){
        if(isset($_POST['login'])){
        $view = new View(APP_PATH . 'views/overview.html');
        }
        elseif (isset($_POST['register'])){
            $view = new View(APP_PATH . 'views/register.html');
        }
        $view->dump();
    }
    else{
        $view = new View(APP_PATH . 'views/login.html');
        $view->set("errormessage", "Password or username were incorrect");
        $view->dump();
    }
    
    /*$db_info = Utility::readDbInfo();
    $this->db = new Database($db_info[0],$db_info[1],$db_info[2],$db_info[3]);*/
}
function createTestUser($userName,$password){
    $test = new User($userName,$password,1);
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
