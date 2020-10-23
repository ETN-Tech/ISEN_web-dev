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

// handle parametters
if (count($_GET) > 0) {
    foreach ($_GET as $param) {
        array_push($params, htmlspecialchars($param));
    }
}

// remove slashes at beginning and end of url
$url = filter_var(ltrim(rtrim($url, '/'), '/'), FILTER_SANITIZE_URL);

if ($url == '') {
    $controller = 'home';
}
else if (in_array($url, ['home', 'quizz', 'quizz-questions', 'account', 'login', 'logout'])) {
    $controller = $url;
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