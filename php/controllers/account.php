<?php

require_once('../php/models/account.php');

$meta_title = "Account";

// verify user connected
if (!isset($_SESSION['user_id'])) {
    header('Location: ?url=login');
    die();
}

$Account = new Account();
$Account->getAccountById($_SESSION['user_id']);

// format datetime
$full_name = $Account->getFullname();
$last_connexion = ucfirst(strftime('%a %e %B %Y - %kh%M', strtotime($Account->last_connexion)));


require_once('../php/views/account.php');
