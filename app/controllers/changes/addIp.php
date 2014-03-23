<?php

require_once(dirname(__FILE__) . '/../../models/includes.php');

function _addIp() {
    Database::initDb();
    if (isset($_POST['ip']))
        $ip = htmlspecialchars(Database::$db->escapeString($_POST['ip']));

    if (Utility::isLoggedIn()) {
        $owner = User::findByUsername($_SESSION['user']);
        $server = new Server($ip, $owner->id);
        $server->persist();
        $view = new View(APP_PATH . 'views/changes.php');
        if (Server::findByIp($ip) != null) {
            $view->set("ipmessage", "Created server with ip: " . $ip);
        } else {
            $view->set("ipmessage", "Failed to create server with: " . $ip);
        }
        $view->dump();
    } else {
        $view = new View(APP_PATH . 'views/login.php');
        $view->set("errormessage", "Your session has timed out " . $_SESSION['user']);
        $view->dump();
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

