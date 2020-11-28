<?php

$meta_title = "Account";


$account = Account::getAccountById($_SESSION['user_id']);

$account_answer_dates = AccountAnswer::getAccountAnswerDatesByAccount($account->getId());


require_once('../php/views/account.php');
