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
$bdd_quizz = new Quizz(null, $quizz_name);

$meta_title = "Quizz ". $bdd_quizz->title;

$questions = $bdd_quizz->getQuestions();

// check if quizz form is sent
if (isset($_POST['form-quizz'])) {
    $quizz_error = array();
    $quizz_base_score = 10 / count($questions);
    $quizz_score = count($questions) * $quizz_base_score;
    $quizz_max_score = count($questions) * $quizz_base_score;

    // format questions
    foreach($questions as $question) {

        /* if quizz sent, correction
        if (isset($quizz_error)) {
            if (in_array($question->type, ['input', 'radio'])) {

                // verify fields exist if input/radio type
                if (!isset($_POST[$question['id']]) || empty($_POST[$question['id']])) {
                    array_push($quizz_error, $questions['id']);
                }
                else {
                    // get user answer
                    $user_answer = htmlspecialchars($_POST[$questions['id']]);

                    if ($questions['type'] == 'input') {
                        // get the answer for that question
                        $answer = get_question_input($questions['id'])->fetch()['answer'];

                        // check if answer is incorrect
                        if (strtolower($answer) != trim(strtolower($user_answer))) {
                            $quizz_score -= $quizz_base_score;
                        }
                    }
                    else if ($questions['type'] == 'radio') {
                        // get proposition selected by user
                        $answer = get_proposition($user_answer)->fetch();

                        // check if proposition is incorrect
                        if (!$answer['is_correct']) {
                            $quizz_score -= $quizz_base_score;
                        }
                    }
                }
            }
            // if input type chekbox
            else if ($question['type'] == 'checkbox') {
                // get all propositions (choices) for that question
                $answers = $question;

                // check each proposition
                foreach ($answers as $key_p => $answer) {

                    // check if user ticked this proposition
                    if (isset($_POST[$questions['id'] .'-'. $answer['id']])) {
                        // check if proposition is incorrect
                        if (!$answer['is_correct']) {
                            $quizz_score -= $quizz_base_score / count($answers);
                            array_push($quizz_wrong, $questions['id'] .'-'. $answer['id']);
                        }
                    }
                    // if user didn't tick the proposition
                    else {
                        // check if proposition is correct
                        if ($answer['is_correct']) {
                            $quizz_score -= $quizz_base_score / count($answers);
                        }
                    }
                }
            }
        }*/

        // check if it's radio/checkbox type
        if (in_array($question->type, ['input', 'radio', 'checkbox', 'select'])) {

            // get all propositions (choices) for that question
            $answers = $question->getAnswers();

            // go throw all propositions
            foreach ($answers as $key_p => $answer) {

                /* if quizz sent, correction
                if (isset($quizz_error)) {

                    if ($questions['type'] == 'radio' && isset($_POST[$questions['id']])) {
                        // get question value (id of proposition chosen)
                        $user_value = htmlspecialchars($_POST[$questions['id']]);

                        // if value inputed by user correspond to this proposition_id, proposition is checked
                        $answers[$key_p]['checked'] = ($user_value == $answer['id']) ? 'checked' : '';
                    }
                    else if ($questions['type'] == 'checkbox') {
                        // if field [question_id]-[proposition_id] exists, proposition is checked
                        $answers[$key_p]['checked'] = (isset($_POST[$questions['id'].'-'.$answer['id']])) ? 'checked' : '';
                    }
                }*/
            }
        }
        /* check if it's an input type
        else if ($questions->type == 'input') {
            // check if quizz sent and question_id valid
            if (isset($quizz_error) && isset($_POST[$questions['id']]) && !empty($_POST[$questions['id']])) {
                // get user input
                $user_input = htmlspecialchars($_POST[$questions['id']]);

                $questionss[$key_q]['value'] = $user_input;
            } else {
                $questionss[$key_q]['value'] = '';
            }
        }*/
    }
}


// if quizz is sent
if (isset($quizz_error)) {
    // set prepentation according to the score
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
    $quizz_disabled = ($quizz_error == 0) ? 'disabled' : '';
} else {
    $quizz_disabled = '';
}

// view quizz questions page
require_once('../php/views/quizz-questions.php');
