<?php
require_once(dirname(__FILE__).'/../../models/includes.php');
function _index(){
	Database::initDb();
	$view = new View(APP_PATH . 'views/changes.php');
    if (Utility::isLoggedIn()) {
		$view->set("pools", getPools());
		if(isset($_POST['pool']))
			changePool($view);
		else if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['level']))
			addUser($view);
		else if (isset($_POST['ip']))
			addServer($view);
	} else
        $view->set("errormessage", "Your session has timed out ");
	$view->dump();
}
function addServer($view) {
    $ip = htmlspecialchars(Database::$db->escapeString($_POST['ip']));
    $owner = User::findByUsername(Utility::getUser());
    $server = new Server($ip, $owner->id);
    $server->persist();
    if (Server::findByIp($ip) != null) 
        $view->set("ipmessage", "Created server with ip: " . $ip);
	else 
		$view->set("ipmessage", "Failed to create server with: " . $ip);
}
function addUser($view) {
	$username = htmlspecialchars(Database::$db->escapeString($_POST['username']));
	$password = htmlspecialchars(Database::$db->escapeString($_POST['password'])); 
	$level = htmlspecialchars(Database::$db->escapeString($_POST['level']));
	$user = new User($username,$password,$level);
	$user->persist();
	if(User::findByUsername($user->username) != null)
		$view->set("usermessage", "Created user: " . $username);
    else
		$view->set("usermessage", "Failed to create user: " . $username);    
}
function changePool($view) {
	$poolName = Database::$db->escapeString($_POST['pool']);
	$servers = Server::findAll();		
	foreach($servers as $server) {
		$miner = new Miner($server->ip,$server->port);
		$miner->switchPoolByName($poolName);
	}
	$view->set("poolmessage", "Pool changed to " . $poolName);
}
function getPools(){
	$pools = Pool::findAll();
	$urls = array();
	foreach($pools as $pool) {
		$urls[] = $pool->name;

	}
	return $urls;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

