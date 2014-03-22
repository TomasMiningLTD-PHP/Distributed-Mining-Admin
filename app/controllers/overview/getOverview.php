<?php
require_once(dirname(__FILE__).'/../../models/includes.php');
function _getOverview() {
	Database::initDb();
	$user = User::findByUsername("user");
	$servers = Server::findByOwner($user->id);
	$readingArray = array();
	foreach($servers as $server){
		$miner = new Miner($server->ip, $server->port);
		$readingArray[] = $miner->getReading();
	}
	echo json_encode($readingArray);
}




/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

