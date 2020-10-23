<?php

class Question {
    public $id;
    public $type;
    public $question;
    public $propositions = [];
    public $answer;

    public function getByQuizzId($quizz_id) {
        global $bdd;

        $get_quizz_questions = $bdd->prepare('SELECT * FROM quizz_questions WHERE quizz_id = ?');
        $get_quizz_questions->execute(array($quizz_id));

        $bdd_questions = $get_quizz_questions->fetch();
        $questions = array();

        // create Question objects for each question
        foreach ($bdd_questions as $bdd_question) {
            $question = new Question();

            // convert array to object
            foreach ($bdd_question  as $key => $value) {
                $question->$key = $value;
            }
            // add object to return table
            array_push($questions, $question);
        }
        return $questions;
    }
}
