<?php
function _index($msg = 'Hello World!') {
    $view = new View(APP_PATH . 'views/login.php');
    $view->dump();
}

