<?php

require_once('../php/models/quizz.php');
require_once('../php/models/question.php');
require_once('../php/models/answer.php');

// verify if quizz page requested
if (!isset($_GET['q']) || empty($_GET['q'])) {
    header('Location: ?url=quizz');
    die();
}

// secure quizz name
$quizz_name = htmlspecialchars($_GET['q']);

// verify if the quizz exists
if (!Quizz::quizzExistByName($quizz_name)) {
    header('Location: ?url=quizz');
    die();
}

// create the quizz with the name
$quizz = new Quizz(null, $quizz_name);

$meta_title = "Quizz ". $quizz->title;

// get quizz questions
$questions = $quizz->getQuestions();


// check if quizz form was sent
if (isset($_POST['form-quizz'])) {

    // initialize variables
    $quizz_error = array();
    $quizz_wrong = array();
    $quizz_base_score = 10 / count($questions);
    $quizz_score = count($questions) * $quizz_base_score;
    $quizz_max_score = count($questions) * $quizz_base_score;

    // check all required questions
    foreach($questions as $question) {
        // if required field
        if (in_array($question->type, ['input', 'radio', 'select'])) {
            // test if user answered
            if (!isset($_POST[$question->id]) || empty($_POST[$question->id])) {
                array_push($quizz_error, $question->id);
            }
        }
    }

    // if no error, correct quizz
    if (count($quizz_error) == 0) {
        // correct each question
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
                if (strtolower($answer->answer) != trim(strtolower($user_answer))) {
                    $quizz_score -= $quizz_base_score;
                    array_push($quizz_wrong, $question->id);
                }
            }
            // if question type is checkbox
            else if ($question->type == 'checkbox') {

                // check each possible answer
                foreach ($answers as $answer) {
                    $proposition_id = $question->id .'-'. $answer->id;

                    // check if user ticked this proposition
                    if (isset($_POST[$proposition_id])) {
                        // if proposition is incorrect, remove points
                        if (!$answer->is_correct) {
                            $quizz_score -= $quizz_base_score / count($answers);
                            array_push($quizz_wrong, $proposition_id);
                        }
                    } // if user didn't tick the proposition
                    else {
                        // if proposition is correct, remove points
                        if ($answer->is_correct) {
                            $quizz_score -= $quizz_base_score / count($answers);
                            array_push($quizz_wrong, $proposition_id);
                        }
                    }
                }
            }
            // if question type is radio/select
            else if (in_array($question->type, ['radio', 'select'])) {
                // get user answer
                $user_answer = htmlspecialchars($_POST[$question->id]);

                foreach ($answers as $answer) {
                    // find user answer
                    if ($user_answer == $answer->id) {
                        // if answer
                        if (!$answer->is_correct) {
                            $quizz_score -= $quizz_base_score;
                            array_push($quizz_wrong, $question->id);
                        }
                        break;
                    }
                }
            }
        }
    }

    // set presentation according to the score
    if ($quizz_score >= 7) {
        $quizz_result_title = "Congratulations !";
        $quizz_result_type = "success";
    }
    else if ($quizz_score >= 4) {
        $quizz_result_title = "Quite good !";
        $quizz_result_type = "warning";
    }
    else {
        $quizz_result_title = "Keep training !";
        $quizz_result_type = "danger";
    }

    // if no error, form is disabled
    $quizz_disabled = (count($quizz_error) == 0) ? 'disabled' : '';
}
else {
    $quizz_disabled = '';
}

// view quizz questions page
require_once('../php/views/quizz-questions.php');
