<?php
require_once(dirname(__FILE__).'/../../models/includes.php');
function _index(){
    $view = new View(APP_PATH . 'views/changes.php');
	$view->set("pools", getPools());
    $view->dump();
}
function getPools(){
	Database::initDb();
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

