<?php

class Question {
    public $id;
    public $type;
    public $question;

    // Question constructor
    public function __construct($id, $type, $question) {
        $this->id = $id;
        $this->type = $type;
        $this->question = $question;
    }


    // get answers and return them
    public function getAnswers() {
        global $bdd;

        $get_answers = $bdd->prepare('SELECT * FROM answer WHERE question_id = ?');
        $get_answers->execute(array($this->id));

        $bdd_answers = $get_answers->fetchAll();
        // create Question array to return
        $answers = array();

        // create a Question objects for each question
        foreach ($bdd_answers as $bdd_answer) {
            // add and format fields for quizz
            $form_id = in_array($this->type, ['radio', 'select']) ? $this->id .'-'. $bdd_answer['id'] : $bdd_answer['id'];
            $name = ($this->type == 'checkbox') ? $this->id .'-'. $bdd_answer['id'] : $this->id;
            $value = ($this->type == 'input') ? '' : $bdd_answer['id'];
            $required = ($this->type == 'checkbox') ? '' : 'required';

            // set default value for checked
            $checked = '';

            // create a new Question
            $answer = new Answer($bdd_answer['id'], $bdd_answer['answer'], $bdd_answer['is_correct'], $form_id, $name, $value, $checked, $required);

            // add object to return table
            array_push($answers, $answer);
        }
        return $answers;
    }

    public function getCorrectAnswers() {
        global $bdd;

        $get_answers = $bdd->prepare("SELECT id FROM answer WHERE question_id = ? AND is_correct = 1");
        $get_answers->execute(array($this->id));

        if ($this->type == 'checkbox') {
            return $get_answers->fetchAll();
        }
        else {
            return $get_answers->fetch();
        }
    }
}
