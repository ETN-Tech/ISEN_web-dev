<?php

// verify if date wis provided
if (!isset($_GET['date']) || empty($_GET['date'])) {
    header('Location: /quizz');
    die();
}

$date = htmlspecialchars($_GET['date']);

// verify account own this quizz result
if (Account::getAccountByAccountAnswerDate($date)->id != $account->id) {
    header('Location: /quizz');
    die();
}

$quizz = Quizz::getQuizzByAccountAnswerDate($date);

$meta_title = "Quizz ". $quizz->title ." score";

$score = $quizz->calculateScore($date);


require_once ('../php/views/quizz-score.php');

