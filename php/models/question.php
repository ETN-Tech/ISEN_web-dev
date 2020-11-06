<?php

class Question {
    public $id;
    public $type;
    public $Answer;

    // Question constructor
    public function __construct($id, $type, $Answer) {
        $this->id = $id;
        $this->type = $type;
        $this->question = $Answer;
    }


    // get answers and return them
    public function getAnswers() {
        global $bdd;

        $get_answers = $bdd->prepare('SELECT * FROM answer WHERE question_id = ?');
        $get_answers->execute(array($this->id));

        $bdd_answers = $get_answers->fetchAll();
        // create Question array to return
        $Answers = array();

        // create a Question objects for each question
        foreach ($bdd_answers as $bdd_answer) {
            // create a new Question
            $Answer = new Answer($bdd_answer['id'], $bdd_answer['answer'], $bdd_answer['is_correct']);

            // add object to return table
            array_push($Answers, $Answer);
        }
        return $Answers;
    }
}
