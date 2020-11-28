<?php

require_once ("../php/init.php");
require_once ("../php/functions.php");

require_once ("../php/models/Account.php");
require_once ('../php/models/Quizz.php');
require_once ('../php/models/Question.php');
require_once ('../php/models/Answer.php');
require_once ('../php/models/AccountAnswer.php');


$page = '';
$params = [];

// verify if parameter url is provided
if (isset($_GET['page'])) {
    $page = htmlspecialchars($_GET['page']);
    unset($_GET['page']);
} else {
    $page = htmlspecialchars($_SERVER['REQUEST_URI']);
}

// handle parameters
if (count($_GET) > 0) {
    foreach ($_GET as $param) {
        array_push($params, htmlspecialchars($param));
    }
}

// remove slashes at beginning and end of url
$page = filter_var(ltrim(rtrim($page, '/'), '/'), FILTER_SANITIZE_URL);


// test if user connected
if (isset($_SESSION['user_id'])) {
    $account = Account::getAccountById($_SESSION['user_id']);
}


// set controller according to url
if (in_array($page, ['', 'home'])) {
    $controller = 'home';
}
else if ($page == 'login') {
    $controller = 'login';
}
// test if controller exist
else if (file_exists('../php/controllers/'. $page .'.php')) {

    // test if user connected
    if (isset($account)) {
        $controller = $page;
    } else {
        header('Location: /login/?next='. $page);
        die();
    }
}
else {
    $controller = '404';
}


// add content in buffer
ob_start();
require_once ('../php/controllers/'. $controller .'.php');
// get content in buffer and clean it
$content = ob_get_clean();


require_once ('../php/views/layout.php');
