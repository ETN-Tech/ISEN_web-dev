<?php

require_once('../php/models/quizz.php');
require_once('../php/models/question.php');
require_once('../php/models/answer.php');

// verify if quizz page requested
if (!isset($_GET['quizz']) || empty($_GET['quizz'])) {
    header('Location: ?url=quizz');
    die();
}

// secure quizz name
$quizz_name = htmlspecialchars($_GET['quizz']);

// verify if the quizz exists
if (!Quizz::quizzExistByName($quizz_name)) {
    header('Location: ?url=quizz');
    die();
}

// get the quizz with the name
$quizz = new Quizz(null, $quizz_name);

$meta_title = "Quizz ". $quizz->title;

// get quizz questions
$questions = $quizz->getQuestions();


// view quizz questions page
require_once('../php/views/quizz-questions.php');
