<?php

// verify if quizz-name is set
if (!isset($_POST['quizz-name']) || empty($_POST['quizz-name'])) {
    header('Location: /quizz');
    die();
}

$quizz_name = htmlspecialchars($_POST['quizz-name']);

// verify if the quizz exists
if (!Quizz::quizzExistByName($quizz_name)) {
    header('Location: /quizz');
    die();
}


// get the quizz with the name
$quizz = Quizz::getQuizzByName($quizz_name);

// get quizz questions
$questions = $quizz->getQuestions();


// check all required questions are answered
foreach($questions as $question) {
    // if required field
    if (in_array($question->type, ['input', 'radio', 'select'])) {
        // test if user answered
        if (!isset($_POST[$question->id]) || empty($_POST[$question->id])) {
            array_push($quizz_error, $question->id);
        }
    }
}

// initialize correction date
$date = date("Y-m-d H:i:s");


// save user's answers for each question
foreach($questions as $question) {

    // get all answers from bdd
    $answers = $question->getAnswers();

    // if question type is input
    if ($question->type == 'input') {
        // get user answer
        $user_answer = htmlspecialchars($_POST[$question->id]);

        // get first answer
        $answer = $answers[0];

        // verify user answer
        if (strtolower($answer->answer) == trim(strtolower($user_answer))) {
            $answer = new AccountAnswer(null, $account->getId(), $answer->id, $date);
            $answer->insertBdd();
        }
    }
    // if question type is checkbox
    else if ($question->type == 'checkbox') {

        // check each possible answer
        foreach ($answers as $answer) {
            $proposition_id = $question->id . '-' . $answer->id;

            // check if user ticked this proposition
            if (isset($_POST[$proposition_id])) {
                $answer = new AccountAnswer(null, $account->getId(), $answer->id, $date);
                $answer->insertBdd();
            }
        }
    }
    // if question type is radio/select
    else if (in_array($question->type, ['radio', 'select'])) {
        // get user answer
        $user_answer = htmlspecialchars($_POST[$question->id]);

        foreach ($answers as $answer) {
            // check if it's user's answer
            if ($user_answer == $answer->id) {
                $answer = new AccountAnswer(null, $account->getId(), $answer->id, $date);
                $answer->insertBdd();
                break;
            }
        }
    }
}

// redirect to quizz-score
header('Location: /quizz/score/'. $date);

