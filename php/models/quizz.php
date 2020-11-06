<?php

class Quizz {
    public $id;
    public $name;
    public $title;
    public $description;
    public $img_url;

    // Quizz constructor
    public function __construct($id = null, $name = null) {

        // detect if either id or name provided
        if ($id != null || $name != null) {
            global $bdd;

            // generate fields key and value for bdd selection
            $key = ($id != null) ? 'id' : 'name';
            $value = ($id != null) ? $id : $name;

            $get_quizz = $bdd->prepare('SELECT * FROM quizz WHERE '. $key .' = ?');
            $get_quizz->execute(array($value));

            $bdd_quizz = $get_quizz->fetch();

            if ($bdd_quizz) {
                $this->id = $bdd_quizz['id'];
                $this->name = $bdd_quizz['name'];
                $this->title = $bdd_quizz['title'];
                $this->description = $bdd_quizz['description'];
                $this->img_url = $bdd_quizz['img_url'];
                return true;
            } else {
                return false;
            }
        } else {
            throw new Exception("Quizz constructor requires id or name");
        }
    }


    // get all quizzes infos and return them
    public static function getQuizzes() {
        global $bdd;

        $get_quizzes = $bdd->query('SELECT id FROM quizz');

        $bdd_quizzes = $get_quizzes->fetchAll();
        $Quizzes = array();

        // create Quizz objects for each quizz
        foreach ($bdd_quizzes as $bdd_quizz) {
            $Quizz = new Quizz($bdd_quizz['id']);

            // add object to return table
            array_push($Quizzes, $Quizz);
        }
        return $Quizzes;
    }

    // find if quizz exist in bdd
    public static function quizzExistByName($name) {
        global $bdd;

        $get_quizz = $bdd->prepare('SELECT id FROM quizz WHERE name = ?');
        $get_quizz->execute(array($name));

        $bdd_quizz = $get_quizz->fetch();

        // test if quizz exist
        if ($bdd_quizz) {
            return true;
        } else {
            return false;
        }
    }

    // get questions and return them
    public function getQuestions() {
        global $bdd;

        $get_questions = $bdd->prepare('SELECT * FROM question WHERE quizz_id = ?');
        $get_questions->execute(array($this->id));

        $bdd_questions = $get_questions->fetchAll();
        // create Question array to return
        $Questions = array();

        // create a Question objects for each question
        foreach ($bdd_questions as $bdd_question) {
            // create a new Question
            $Question = new Question($bdd_question['id'], $bdd_question['type'], $bdd_question['question']);

            // add object to return table
            array_push($Questions, $Question);
        }
        return $Questions;
    }
}

