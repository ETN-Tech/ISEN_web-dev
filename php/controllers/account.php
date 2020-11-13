<?php

$meta_title = "Account";


$account = new Account();
$account->getAccountById($_SESSION['user_id']);


require_once('../php/views/account.php');
