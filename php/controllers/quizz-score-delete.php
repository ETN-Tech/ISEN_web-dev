<?php

// verify if date wis provided
if (!isset($_GET['date']) || empty($_GET['date'])) {
    header('Location: ?page=quizz');
    die();
}

$date = htmlspecialchars($_GET['date']);

$meta_title = "Working...";

// verify account own this quizz result
if (Account::getAccountByAccountAnswerDate($date)->id != $account->id) {
    header('Location: ?page=quizz');
    die();
}

// delete result from bdd
AccountAnswer::deleteBdd($date);

header('Location: ?page=account');
die();

