<?php

// verify if quizz page requested
if (!isset($_GET['quizz']) || empty($_GET['quizz'])) {
    header('Location: ?page=quizz');
    die();
}

// secure quizz name
$quizz_name = htmlspecialchars($_GET['quizz']);

// verify if the quizz exists
if (!Quizz::quizzExistByName($quizz_name)) {
    header('Location: ?page=quizz');
    die();
}

// get the quizz with the name
$quizz = Quizz::getQuizzByName($quizz_name);

$meta_title = "Quizz ". $quizz->title;

// get quizz questions
$questions = $quizz->getQuestions();


// view quizz questions page
require_once('../php/views/quizz-questions.php');
