<?php
require_once(dirname(__FILE__).'/../../models/includes.php');
function _changePool() {
    $view = new View(APP_PATH . 'views/changes.php');
	if(isset($_POST['pool'])){
		Database::initDb();
		$poolName = Database::$db->escapeString($_POST['pool']);
		$servers = Server::findAll();
		foreach($servers as $server) {
			$miner = new Miner($server->ip,$server->port);
			$miner->switchPoolByName($poolName);
		}
		$view->set("poolmessage", "Pool changed to " . $poolName);
	} else
		$view->set("poolmessage", "Failed to change pool to " . $poolName);
	$view->dump();
}
