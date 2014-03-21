<?php
require_once(dirname(__FILE__).'/../models/Database.php');
require_once(dirname(__FILE__).'/../models/User.php');
require_once(dirname(__FILE__).'/../models/Miner.php');
require_once(dirname(__FILE__).'/../models/Reading.php');


$mineraddress = "localhost";
$minerport = 4028;

$minerobject = new Miner($mineraddress, $minerport);
$readingObject = $minerobject->getReading();
print_r($readingObject);





/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

