<?php
class Pool {
	public $id, $name, $url, $username, $password, $algorithm;
	function __construct($name, $url, $username, $password, $algorithm, $id = -1) {
		$this->name = $name;
		$this->url = $url;
		$this->username = $username;
		$this->password = $password;
		$this->algorithm = $algorithm;
		$this->id = $id;
	}
	public static function findByName($name) {
		$result = Database::$db->execQuery("SELECT * FROM pool WHERE name = '$name'");
        if ($result == null || sizeof($result) == 0)
            return null;
		return new Pool($result['name'], $result['url'],$result['username'],$result['passwd'], $result['algorithm'], $result['id']);
	}
	public static function findById($id) {
		$result = Database::$db->execQuery("SELECT * FROM pool WHERE id = $id");
        if ($result == null || sizeof($result) == 0)
            return null;
		return new Pool($result['name'], $result['url'],$result['username'],$result['passwd'], $result['algorithm'], $result['id']);
	}
	public static function findAll() {
		$result = Database::$db->execMultipleResultsQuery("SELECT * FROM pool");
		if ($result == null || sizeof($result) == 0 )
			return null;
		$ret = array();
		foreach($result as $pool)
			$ret[] = new Pool($pool['name'], $pool['url'],$pool['username'],$pool['passwd'], $pool['algorithm'], $pool['id']);
		return $ret;
	}
	public function persist()
    {
        $result = Database::$db->execQuery("SELECT * FROM pool WHERE id = $this->id");
        if (sizeof($result) == 0) {
			Database::$db->execUpdate("INSERT INTO pool VALUES(NULL,'$this->name', '$this->url', '$this->username', '$this->password', '$this->algorithm')");
            $res = Database::$db->execQuery("SELECT * FROM pool WHERE name = '$this->name'");
            $this->id = $res['id'];
        } else {
			Database::$db->execUpdate("UPDATE pool SET name='$this->name', url='$this->url', username='$this->username', passwd = '$this->password', algorithm ='$this->algorithm' WHERE id=$this->id");
        }            
    }
    
    public function delete()
    {
		Database::$db->execUpdate("DELETE FROM pool WHERE id = $this->id");
    }
}
