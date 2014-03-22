<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author villiam
 */
class Utility {
    //put your code here
    public static function checkUser($username,$password){
        $user = User::findByUsername($username);
        if($user == NULL)
            return false;
        if(md5($password) === $user->password){
            return true;
        }
        else
            return false;
    }
    
    public static function  readDbInfo()
    {
	$lines = file('DB.conf',FILE_IGNORE_NEW_LINES);
        return $lines;
    }
	public static function getUser() {
		if(isset($_SESSION['user']))
			return $_SESSION['user'];
		else
			return NULL;
	}
	public static function isLoggedIn() {
		return $isset($_SESSION['user']);
	}
	public static function login($username){
		$_SESSION['user'] = $username;
	}
	public static function logout() {
		unset($_SESSION['user']);
	}
}
