<?php
require_once(dirname(__FILE__).'/../../models/Database.php');
require_once(dirname(__FILE__).'/../../models/User.php');
require_once(dirname(__FILE__).'/../../models/Utility.php');
function _index(){
    Database::initDb();
	$username = htmlspecialchars(Database::$db->escapeString($_POST['username']));
	$password = htmlspecialchars(Database::$db->escapeString($_POST['password']));
	if(isset($_POST['login']) && Utility::checkUser($username, $password)){
		Utility::login($username);
        header('Location: overview');
    } else {
        $view = new View(APP_PATH . 'views/login.php');
        $view->set("errormessage", "Password or username were incorrect");
         $view->dump();
    }
   
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

