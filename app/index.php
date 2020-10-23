<?php

require_once("php/init.php");

$url = '';

// verify if parameter url is provided
if (isset($_GET['url'])) {
    $url = $_GET['url'];
} else {
    $url = $_SERVER['REQUEST_URI'];
}

// remove slashes at beginning and end of url
$url = filter_var(ltrim(rtrim($url, '/'), '/'), FILTER_SANITIZE_URL);

if ($url) {
    $controller = 'home';
}
else if (in_array($url, ['home', 'quizz', 'login', 'account'])) {
    $controller = $url;
}
else {
    $controller = '404';
}


// redirect user wether he is connected or not
if (isset($_SESSION['user_id'])) {
    header('Location: account.php');
}
else {
    header('Location: home.php');
}

// add content in buffer
ob_start();
require_once '../php/controllers/'. $controller .'.php';
// get content in buffer and clean it
$content = ob_get_clean();

require_once 'app/views/layout.php';