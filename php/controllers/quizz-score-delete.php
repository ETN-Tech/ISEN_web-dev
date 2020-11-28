<?php

// verify if date wis provided
if (!isset($_GET['date']) || empty($_GET['date'])) {
    header('Location: /quizz');
    die();
}

$date = htmlspecialchars($_GET['date']);

$meta_title = "Quizz answer delete";

// verify account own this quizz result
if (Account::getAccountByAccountAnswerDate($date)->getId() != $account->getId()) {
    header('Location: /quizz');
    die();
}

// delete result from bdd
AccountAnswer::deleteBdd($date);


require_once ('../php/views/quizz-score-delete.php');
