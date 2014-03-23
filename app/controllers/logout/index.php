<?php
require_once(dirname(__FILE__).'/../../models/Utility.php');

function _index() {
	Utility::logout();
	header('Location: .');
}

