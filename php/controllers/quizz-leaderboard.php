<?php

$meta_title = 'Quizz leaderboard';

$quizzes = Quizz::getQuizzes();

// create an array for date and score
$date_score = array();

// for each quizz
foreach ($quizzes as $quizz) {
    $account_answer_dates = AccountAnswer::getAccountAnswerDatesByQuizz($quizz->getId());

    // for each account_answer date
    foreach ($account_answer_dates as $date) {
        $date_score[$date] = $quizz->calculateScore($date);
    }
}

// sort array by date desc
ksort($date_score);

// then sort array by score desc
arsort($date_score);



require_once ('../php/views/quizz-leaderboard.php');
