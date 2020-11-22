<?php

$meta_title = "Account";


$account = Account::getAccountById($_SESSION['user_id']);

$account_answer_dates = AccountAnswer::getAccountAnswerDatesByAccount($account->id);


require_once('../php/views/account.php');
