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
    public $username, $password, $access, $id;
    function __construct($username, $password, $access,$id = -1) {
        $this->username = $username;
        $this->password = md5($password);
        $this->access = $access;
        $this->id = $id;
    }
    
    // TODO
    public static function findByUsername($username)
    {
		$result = Database::$db->execQuery("SELECT * FROM user WHERE username = '$username'");
        if ($result == null || sizeof($result) == 0)
            return null;
        return $user = new User($result['username'], $result['passwd'],$result['accesslevel'],$result['id']);
    }
    //
    public static function findById($id)
    {
        $result = Database::$db->execQuery("SELECT * FROM user WHERE id = $id");
        if ($result == null || sizeof($result) == 0)
            return null;
        return new User($result['username'], $result['passwd'],$result['accesslevel'],$result['id']);
    }
    public function persist()
    {
        $result = Database::$db->execQuery("SELECT * FROM user WHERE id = $this->id");
        if (sizeof($result) == 0) {
            Database::$db->execUpdate("INSERT INTO user VALUES(NULL, '$this->username', '$this->password', $this->access)");
            $res = Database::$db->execQuery("SELECT * FROM user WHERE username = '$this->username'");
            $this->id = $res['id'];
        } else {
            Database::$db->execUpdate("UPDATE user SET username='$this->username', passwd = '$this->password', accesslevel = $this->access WHERE id = $this->id");
        }            
    }
    
    public function delete()
    {
        Database::$db->execUpdate("DELETE FROM user WHERE id = $this->id");
    }
}
