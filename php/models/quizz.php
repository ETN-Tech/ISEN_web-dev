<?php

// get quizzes informations
function get_quizzes() {
    global $bdd;
    
    $get_quizzes = $bdd->query('SELECT * FROM quizzes');
    
    return $get_quizzes;
}

// get quizz informations by name
function get_quizz($quizz_name) {
    global $bdd;
    
    $get_quizz = $bdd->prepare('SELECT * FROM quizzes WHERE name = ?');
    $get_quizz->execute(array($quizz_name));
    
    return $get_quizz;
}

// get quizz questions
function get_quizz_questions($quizz_id) {
    global $bdd;
    
    $get_quizz_questions = $bdd->prepare('SELECT * FROM quizz_questions WHERE quizz_id = ?');
    $get_quizz_questions->execute(array($quizz_id));

    return $get_quizz_questions;
}

// get answer for quizz question of type input
function get_question_input($question_id) {
    global $bdd;
    
    $get_questions_input = $bdd->prepare('SELECT * FROM quizz_questions_input WHERE quizz_question_id = ?');
    $get_questions_input->execute(array($question_id));

    return $get_questions_input;
}

// get propositions for quizz question of types radio/checkbox
function get_question_radio_checkbox($question_id) {
    global $bdd;
    
    $get_questions_radio_checkbox = $bdd->prepare('SELECT * FROM quizz_questions_radio_checkbox WHERE quizz_question_id = ?');
    $get_questions_radio_checkbox->execute(array($question_id));

    return $get_questions_radio_checkbox;
}

// get proposition by id
function get_proposition($proposition_id) {
    global $bdd;

    $get_proposition = $bdd->prepare('SELECT * FROM quizz_questions_radio_checkbox WHERE id = ?');
    $get_proposition->execute(array($proposition_id));

    return $get_proposition;
}
