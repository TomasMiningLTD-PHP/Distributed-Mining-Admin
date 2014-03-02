<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Kim
 */
class User {
    private $username, $password, $access;
    function __construct($username, $password, $access) {
        $this->username = $username;
        $this->password = $password;
        $this->access = $access;
    }
    
    // TODO
    public static function find($username)
    {
        
    }
    //
    public static function findAll()
    {
        
    }
    // TODO
    public function persist()
    {
        
    }
    
    public function delete()
    {
        
    }
}
