<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Server
 *
 * @author Kim
 */
class Server {
    public $ip, $owner,$id,$port;
    function __construct($ip, $owner, $id = -1) {
        $this->ip = $ip;
        $this->owner = $owner;
		$this->id = $id;
		$this->port = 4028;
    }
   
    
    public static function findByIp($ip) {
        $result = Database::$db->execQuery("SELECT * FROM server WHERE ip = '$ip'");
        if ($result == null || sizeof($result) == 0)
            return null;
        return new Server($result['ip'], $result['owner'], $result['id']);
    }
    
    public static function findById($id) {
		$result = Database::$db->execQuery("SELECT * FROM server WHERE id = $id");
        if ($result == null || sizeof($result) == 0)
            return null;
        return new Server($result['ip'], $result['owner'], $result['id']);
    }
	public static function findByOwner($id){
		$result = Database::$db->execMultipleResultsQuery("SELECT * FROM server WHERE owner = $id");
        if ($result == null || sizeof($result) == 0)
			return null;
		$ret = array();
		foreach($result as $pool)
			$ret[] = new Server($pool['ip'], $pool['owner'], $pool['id']);
		return $ret;
	}
    
    
	// TODO
    public static function findAll() {
        $result = Database::$db->execMultipleResultsQuery("SELECT * FROM server");
        if ($result == null || sizeof($result) == 0)
            return null;
		$ret = array();
		foreach($result as $pool)
			$ret[] = new Server($pool['ip'], $pool['owner'], $pool['id']);
        return $ret;
    }
    
    public function persist()
    {
        $result = Database::$db->execQuery("SELECT * FROM server WHERE id = $this->id");
		if(sizeof($result) == 0){
			$result = Database::$db->execQuery("SELECT * FROM server WHERE ip = \"$this->ip\""); 
		}
        if (sizeof($result) == 0) {
            Database::$db->execUpdate("INSERT INTO server VALUES(NULL, '$this->ip', $this->owner)");
        } else {
            Database::$db->execUpdate("UPDATE server SET ip='$this->ip', owner = '$this->owner' WHERE id = $this->id");
        }            
        $res = Database::$db->execQuery("SELECT * FROM server WHERE ip = '$this->ip'");
        $this->id = $res['id'];
        
    }
    
    public function delete()
    {
        Database::$db->execUpdate("DELETE FROM server WHERE id = $this->id");
    }
}
