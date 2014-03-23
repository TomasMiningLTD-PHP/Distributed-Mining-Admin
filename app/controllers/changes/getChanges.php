<?php
require_once(dirname(__FILE__).'/../../models/includes.php');
function _getChanges() {
	
	Database::initDb();
	$pools = Pool::findAll();
	$urls = array();
	foreach($pools as $pool) {
		$urls[] = $pool->url;

	}
	echo json_encode($urls);
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

