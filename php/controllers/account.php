<?php

require_once('../php/models/account.php');

$meta_title = "Account";

// verify user connected
if (!isset($_SESSION['user_id'])) {
    header('Location: ?url=login');
    die();
}

$account = new Account();
$account->getAccountById($_SESSION['user_id']);


require_once('../php/views/account.php');
