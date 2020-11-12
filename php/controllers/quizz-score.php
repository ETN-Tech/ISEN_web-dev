<?php

// verify if date wis provided
if (!isset($_GET['date']) || empty($_GET['date'])) {
    header('Location: ?url=quizz');
    die();
}

$date = htmlspecialchars($_GET['date']);

$quizz = Quizz::getQuizzByAccountAnswerDate($date);

$meta_title = "Quizz ". $quizz->title ." score";

$score = $quizz->calculateScore();


// set presentation according to the score
if ($score >= 7) {
    $result_title = "Congratulations !";
    $result_type = "success";
}
else if ($score >= 4) {
    $result_title = "Quite good !";
    $result_type = "warning";
}
else {
    $result_title = "Keep training !";
    $result_type = "danger";
}


require_once ('../php/views/quizz-score.php');

