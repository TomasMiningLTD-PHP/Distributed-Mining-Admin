<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author Kim
 */
class Database {

    private $con;
    public static $db;
    function __construct($host, $username, $password, $dbname) {
        $this->con = new mysqli($host, $username, $password);
        $this->setUpDb($dbname);
        
    }
    
    private function setUpDb($dbname) {
        $selected = $this->con->select_db($dbname);
        if(!$selected) {
            $this->con->query ("CREATE DATABASE " . $dbname);
            $this->con->select_db($dbname);
        }
        $user = "CREATE TABLE IF NOT EXISTS user (id INT(11) NOT NULL AUTO_INCREMENT, "
                . "username VARCHAR(255) UNIQUE NOT NULL,passwd VARCHAR(255) NOT NULL "
                . "DEFAULT '', accesslevel TINYINT(1) UNSIGNED NOT NULL DEFAULT 0, "
                . "PRIMARY KEY (id));";
        $this->con->query($user);
        $server = "CREATE TABLE IF NOT EXISTS server (id INT(11) NOT NULL "
                . "AUTO_INCREMENT, ip VARCHAR(255) UNIQUE NOT NULL, owner int(11) "
                . "NOT NULL, FOREIGN KEY(owner) REFERENCES user(id),  PRIMARY KEY (id));";
        $this->con->query($server);
        
        $reading = "CREATE TABLE IF NOT EXISTS reading (id INT(11) NOT NULL "
                . "AUTO_INCREMENT, server INT(11) NOT NULL ,speed DECIMAL NOT "
                . "NULL DEFAULT 0 , time DATETIME NOT NULL, accepted INT NOT "
                . "NULL, rejected INT NOT NULL, hardware_errors INT NOT NULL, "
                . "FOREIGN KEY(server) REFERENCES server(id),  PRIMARY KEY (id));";
        $this->con->query($reading);
        
        $temp_reading = "CREATE TABLE IF NOT EXISTS temp_reading (id INT(11) NOT NULL AUTO_INCREMENT,  "
                . "reading INT(11) NOT NULL ,temperature DECIMAL NOT NULL, FOREIGN KEY(reading) "
                . "REFERENCES reading(id),  PRIMARY KEY (id));";
        $this->con->query($temp_reading);
    }
    public function execMultipleResultsQuery($query) {
        $result = $this->con->query($query);
        $ret = array();
        while($row =$result->fetch_array(MYSQLI_ASSOC) )
            array_push($ret, $row);
        return $ret;
    }
    public function execQuery($query) {
        $result = $this->con->query($query);
        if($result === FALSE)
            return NULL;
        else if($result->num_rows == 0)
            return array();
        else
            return $result->fetch_array(MYSQLI_ASSOC);
       
    }
        public function execUpdate($query) {
        $result = $this->con->query($query);
        if($result === FALSE)
            return NULL;
        return $result;
       
    }
    public static function initDb() {
        if($this->db === null){
            $db_info = Utility::readDbInfo();
            $this->db = new Database($db_info[0],$db_info[1],$db_info[2],$db_info[3]);  
        }
    }
    function __destruct() {
        $this->con->close();
    }

}
