<?php

// verify if date wis provided
if (!isset($_GET['date']) || empty($_GET['date'])) {
    header('Location: ?page=quizz');
    die();
}

$date = htmlspecialchars($_GET['date']);

$quizz = Quizz::getQuizzByAccountAnswerDate($date);

$meta_title = "Quizz ". $quizz->title ." score";

$score = $quizz->calculateScore($date);


require_once ('../php/views/quizz-score.php');

