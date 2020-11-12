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

            $quizz = $get_quizz->fetch();

            if ($quizz) {
                $this->id = $quizz['id'];
                $this->name = $quizz['name'];
                $this->title = $quizz['title'];
                $this->description = $quizz['description'];
                $this->img_url = $quizz['img_url'];
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
        $quizzes = array();

        // create Quizz objects for each quizz
        foreach ($bdd_quizzes as $bdd_quizz) {
            $quizz = new Quizz($bdd_quizz['id']);

            // add object to return table
            array_push($quizzes, $quizz);
        }
        return $quizzes;
    }

    public static function getQuizzByAccountAnswerDate($date) {
        global $bdd;

        $get_quizz = $bdd->prepare("SELECT quizz.id FROM quizz INNER JOIN question ON quizz.id = question.quizz_id INNER JOIN answer ON question.id = answer.question_id INNER JOIN account_answer ON answer.id = account_answer.answer_id WHERE account_answer.date = ?");
        $get_quizz->execute(array($date));

        $quizz_id = $get_quizz->fetch()[0];

        $quizz = new Quizz($quizz_id, null);

        return $quizz;
    }

    // find if quizz exist in bdd
    public static function quizzExistByName($name) {
        global $bdd;

        $get_quizz = $bdd->prepare('SELECT id FROM quizz WHERE name = ?');
        $get_quizz->execute(array($name));

        $quizz = $get_quizz->fetch();

        // test if quizz exist
        if ($quizz) {
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
        $questions = array();

        // create a Question objects for each question
        foreach ($bdd_questions as $bdd_question) {
            // create a new Question
            $question = new Question($bdd_question['id'], $bdd_question['type'], $bdd_question['question']);

            // add object to return table
            array_push($questions, $question);
        }
        return $questions;
    }

    public function calculateScore($date) {
        global $account;

        $questions = $this->getQuestions();

        // initialize variables
        $base_score = 10 / count($questions);
        $score = count($questions) * $base_score;

        // verify answers
        foreach ($questions as $question) {
            // get correct answers
            $correct_answer = $question->getCorrectAnswers();

            if ($question->type == 'input') {
                // if correct_answer doesn't exist in account_answer, user answered incorrectly
                if (!AccountAnswer::accountAnswerExist($account->id, $correct_answer->id, $date)) {
                    $score -= $base_score;
                }
            }
            else if ($question->type == 'checkbox') {
                // get possible answers
                $answers = $question->getAnswers();

                // verify for each possible answer
                foreach ($answers as $answer) {

                    if ($answer->is_correct) {
                        // if answer is correct and user didn't check it, loose points
                        if (!AccountAnswer::accountAnswerExist($account->id, $answer->id, $date)) {
                            $score -= $base_score / count($answers);
                        }
                    }
                    else {
                        // if answer is not correct and user checked it, loose points
                        if (AccountAnswer::accountAnswerExist($account->id, $answer->id, $date)) {
                            $score -= $base_score / count($answers);
                        }
                    }
                }
            }
            else {
                // if correct_answer doesn't exist in account_answer, user answered incorrectly
                if (!AccountAnswer::accountAnswerExist($account->id, $correct_answer->id, $date)) {
                    $score -= $base_score;
                }
            }
        }
        return $score;
    }
}

