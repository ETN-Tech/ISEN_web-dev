<?php

require_once('../php/models/quizz.php');

$meta_title = "Quizz";

$bdd_quizz = new Quizz();
$bdd_quizzes = $bdd_quizz->getQuizzes();

// view page to choose a quizz
require_once('../php/views/quizz.php');
