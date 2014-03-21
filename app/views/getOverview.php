<?php
require_once(dirname(__FILE__).'/../models/Database.php');
require_once(dirname(__FILE__).'/../models/User.php');
require_once(dirname(__FILE__).'/../models/Miner.php');
require_once(dirname(__FILE__).'/../models/Reading.php');
require_once(dirname(__FILE__).'/../models/Server.php');
$user = User::findByUsername("user");
$servers = Server::findByOwner($user->id);
print("We are in login");
foreach($servers as $server){
	$miner = new Miner($server->ip, $server->port);
	$readingObject = $miner->getReading();
	print_r($readingObject);
}





/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

