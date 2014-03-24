<?php
require_once(dirname(__FILE__).'/../../models/includes.php');
function _index(){
	Database::initDb();
	$view = new View(APP_PATH . 'views/changes.php');
    if (Utility::isLoggedIn()) {
        $tmp = User::findByUsername(Utility::getUser());
        if($tmp->access === "1"){  
		$view->set("pools", getPools());
		if(isset($_POST['pool']))
			changePool($view);
		else if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['level']))
			addUser($view);
		else if (isset($_POST['ip']))
			addServer($view);
                else if (isset($_POST['newpool']))
			addPool($view);
                $view->dump();
        }else{
            header('Location: overview');
        }
    } else{
    header('Location: .');
    }
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
function addPool($view) {
	$username = htmlspecialchars(Database::$db->escapeString($_POST['username']));
	$password = htmlspecialchars(Database::$db->escapeString($_POST['password'])); 
	$name = htmlspecialchars(Database::$db->escapeString($_POST['name']));
        $url = htmlspecialchars(Database::$db->escapeString($_POST['url']));
        $alg = htmlspecialchars(Database::$db->escapeString($_POST['alg']));
	$pool = new Pool($name,$url,$username,$password,$alg);
	$pool->persist();
	if(Pool::findByName($pool->name) != null){
                $view->set("pools", getPools());
		$view->set("newpoolmessage", "Created pool: " . $name);
        }
        else
		$view->set("newpoolmessage", "Failed to create pool: " . $name);    
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

