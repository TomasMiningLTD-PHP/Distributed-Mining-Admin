<?php
require_once(dirname(__FILE__).'/../../models/includes.php');
function _addUser() {
	Database::initDb();
        if(isset($_POST['username']))
		$username = htmlspecialchars(Database::$db->escapeString($_POST['username']));
	if(isset($_POST['password']))
            $password = htmlspecialchars(Database::$db->escapeString($_POST['password']));
        if(isset($_POST['level']))
            $level = htmlspecialchars(Database::$db->escapeString($_POST['level']));
	$user = new User($username,$password,$level);
        $user->persist();
        $view = new View(APP_PATH . 'views/changes.php');
	if(User::findByUsername("user") != null){            
            $view->set("usermessage", "Created user: " . $username);
        }
        else{
            $view->set("usermessage", "Failed to create user: " . $username);
        }
        $view->dump();
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

