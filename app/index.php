<?php

require_once("../php/init.php");

$url = '';
$params = [];

// verify if parameter url is provided
if (isset($_GET['url'])) {
    $url = htmlspecialchars($_GET['url']);
    unset($_GET['url']);
} else {
    $url = htmlspecialchars($_SERVER['REQUEST_URI']);
}

// handle parameters
if (count($_GET) > 0) {
    foreach ($_GET as $param) {
        array_push($params, htmlspecialchars($param));
    }
}

// remove slashes at beginning and end of url
$url = filter_var(ltrim(rtrim($url, '/'), '/'), FILTER_SANITIZE_URL);


// test if user connected
if (isset($_SESSION['user_id'])) {
    $account = new Account();
    $account->getAccountById($_SESSION['user_id']);
}


// set controller according to url
if ($url == '') {
    $controller = 'home';
}
else if ($url == 'login') {
    $controller = 'login';
}
// test if controller exist
else if (file_exists('../php/controllers/'. $url .'.php')) {

    // test if user connected
    if (isset($account)) {
        $controller = $url;
    } else {
        header('Location: ?url=login');
        die();
    }
}
else {
    $controller = '404';
}

// add content in buffer
ob_start();
require_once '../php/controllers/'. $controller .'.php';
// get content in buffer and clean it
$content = ob_get_clean();

require_once '../php/views/layout.php';