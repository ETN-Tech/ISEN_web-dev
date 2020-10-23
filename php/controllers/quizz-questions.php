<?php

require_once('../php/models/quizz.php');
require_once('../php/models/question.php');
require_once('../php/models/proposition.php');

// verify if quizz page requested
if (!isset($_GET['q']) || empty($_GET['q'])) {
    header('Location: ?url=quizz');
    die();
}

$bdd_quizz = new Quizz();
$quizz_exist = $bdd_quizz->getByName(htmlspecialchars($_GET['q']));

// verify if the quizz exists
if (!$quizz_exist) {
    header('Location: ?url=quizz');
    die();
}

$meta_title = "Quizz ". $bdd_quizz->title;

$bdd_questions = new Question();
$bdd_questions->getByQuizzId($bdd_quizz->id);

// check if quizz form is sent
if (isset($_POST['form-quizz'])) {
    $quizz_error = array();
    $quizz_wrong = array();
    $quizz_base_score = 10 / count($bdd_questions);
    $quizz_score = count($bdd_questions) * $quizz_base_score;
    $quizz_max_score = count($bdd_questions) * $quizz_base_score;
}

// format questions
foreach($bdd_questions as $key_q => $question) {

    // if quizz sent, correction
    if (isset($quizz_error)) {
        if (in_array($question['type'], ['input', 'radio'])) {

            // verify fields exist if input/radio type
            if (!isset($_POST[$question['id']]) || empty($_POST[$question['id']])) {
                array_push($quizz_error, $question['id']);
            }
            else {
                // get user answer
                $user_answer = htmlspecialchars($_POST[$question['id']]);

                if ($question['type'] == 'input') {
                    // get the answer for that question
                    $answer = get_question_input($question['id'])->fetch()['answer'];

                    // check if answer is incorrect
                    if (strtolower($answer) != trim(strtolower($user_answer))) {
                        $quizz_score -= $quizz_base_score;
                        array_push($quizz_wrong, $question['id']);
                    }
                }
                else if ($question['type'] == 'radio') {
                    // get proposition selected by user
                    $proposition = get_proposition($user_answer)->fetch();

                    // check if proposition is incorrect
                    if (!$proposition['is_correct']) {
                        $quizz_score -= $quizz_base_score;
                        array_push($quizz_wrong, $question['id']);
                    }
                }
            }
        }
        // if input type chekbox
        else if ($question['type'] == 'checkbox') {
            // get all propositions (choices) for that question
            $propositions = get_question_radio_checkbox($question['id'])->fetchAll();

            // check each proposition
            foreach ($propositions as $key_p => $proposition) {

                // check if user ticked this proposition
                if (isset($_POST[$question['id'] .'-'. $proposition['id']])) {
                    // check if proposition is incorrect
                    if (!$proposition['is_correct']) {
                        $quizz_score -= $quizz_base_score / count($propositions);
                        array_push($quizz_wrong, $question['id'] .'-'. $proposition['id']);
                    }
                }
                // if user didn't tick the proposition
                else {
                    // check if proposition is correct
                    if ($proposition['is_correct']) {
                        $quizz_score -= $quizz_base_score / count($propositions);
                    }
                }
            }
        }
    }

    // check if it's radio/checkbox type
    if (in_array($question['type'], ['radio', 'checkbox'])) {

        // get all propositions (choices) for that question
        $propositions = get_question_radio_checkbox($question['id'])->fetchAll();

        // go throw all propositions
        foreach ($propositions as $key_p => $proposition) {
            // add and format fields for quizz
            $propositions[$key_p]['name'] = ($question['type'] == 'radio') ? $question['id'] : $question['id'] .'-'. $proposition['id'];
            $propositions[$key_p]['value'] = $proposition['id'];
            $propositions[$key_p]['required'] = ($question['type'] == 'radio') ? 'required' : '';
            // set default value
            $propositions[$key_p]['checked'] = '';

            // if quizz sent, correction
            if (isset($quizz_error)) {

                if ($question['type'] == 'radio' && isset($_POST[$question['id']])) {
                    // get question value (id of proposition chosen)
                    $user_value = htmlspecialchars($_POST[$question['id']]);

                    // if value inputed by user correspond to this proposition_id, proposition is checked
                    $propositions[$key_p]['checked'] = ($user_value == $proposition['id']) ? 'checked' : '';
                }
                else if ($question['type'] == 'checkbox') {
                    // if field [question_id]-[proposition_id] exists, proposition is checked
                    $propositions[$key_p]['checked'] = (isset($_POST[$question['id'].'-'.$proposition['id']])) ? 'checked' : '';
                }
            }
        }
        // ajouter les propositions à la question
        $questions[$key_q]['propositions'] = $propositions;
    }
    // check if it's an input type
    else if ($question['type'] == 'input') {
        // check if quizz sent and question_id valid
        if (isset($quizz_error) && isset($_POST[$question['id']]) && !empty($_POST[$question['id']])) {
            // get user input
            $user_input = htmlspecialchars($_POST[$question['id']]);

            $questions[$key_q]['value'] = $user_input;
        } else {
            $questions[$key_q]['value'] = '';
        }
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
