<?php
require_once(dirname(__FILE__).'/../../models/Database.php');
require_once(dirname(__FILE__).'/../../models/User.php');
function _index(){
    Database::initDb();
	$username = htmlspecialchars(Database::$db->escapeString($_POST['username']));
	$password = htmlspecialchars(Database::$db->escapeString($_POST['password']));
    
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
        $view = new View(APP_PATH . 'views/login.php');
        $view->set("errormessage", "Password or username were incorrect");
        $view->dump();
    }
    
    /*$db_info = Utility::readDbInfo();
    $this->db = new Database($db_info[0],$db_info[1],$db_info[2],$db_info[3]);*/
}
function createTestUser($userName,$password){
    $test = new User($userName,$password,1);
	$test->persist();
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

