<?php

$meta_title = "Account";


$account = new Account();
$account->getAccountById($_SESSION['user_id']);

$account_answer_dates = AccountAnswer::getAccountAnswerDatesByAccount($account->id);
$i = 0;


require_once('../php/views/account.php');
