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

    function __construct($host, $username, $password, $dbname) {
        $this->con = new mysqli($host, $username, $password, $dbname);
    }

    public function execQuery($query) {
        $queryResults = array();
        if ($result = $this->con->query($query)) {
            $i = 0;
            while ($queryResults[$i] = $result->fetch_assoc())
                $i++;
        }
        return $queryResults;
    }

    function __destruct() {
        $this->con->close();
    }

}
