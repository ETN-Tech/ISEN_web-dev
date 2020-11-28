<?php

class Quizz {
    private $id;
    private $name;
    private $title;
    private $description;
    private $img_url;


    // Quizz constructor
    public function __construct($id, $name, $title, $description, $img_url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->img_url = $img_url;
    }


    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImgUrl()
    {
        return $this->img_url;
    }


    // get quizz by id
    public static function getQuizzById($id) {
        return Quizz::executeGetQuizzBy('id', $id);
    }

    // get quizz by name
    public static function getQuizzByName($name) {
        return Quizz::executeGetQuizzBy('name', $name);
    }

    // execute a request get by
    private static function executeGetQuizzBy($key, $value) {
        global $bdd;

        $get_quizz = $bdd->prepare('SELECT * FROM quizz WHERE '. $key .' = ?');
        $get_quizz->execute(array($value));

        $quizz = $get_quizz->fetch();

        if ($quizz) {
            return new Quizz(
                $quizz['id'],
                $quizz['name'],
                $quizz['title'],
                $quizz['description'],
                $quizz['img_url']
            );
        } else {
            return false;
        }
    }

    public static function getQuizzByAccountAnswerDate($date) {
        global $bdd;

        $get_quizz = $bdd->prepare("SELECT quizz.id FROM quizz INNER JOIN question ON quizz.id = question.quizz_id INNER JOIN answer ON question.id = answer.question_id INNER JOIN account_answer ON answer.id = account_answer.answer_id WHERE account_answer.date = ?");
        $get_quizz->execute(array($date));

        $quizz_id = $get_quizz->fetch()[0];

        $quizz = Quizz::getQuizzById($quizz_id);

        return $quizz;
    }

    // get all quizzes infos and return them
    public static function getQuizzes() {
        global $bdd;

        $get_quizzes = $bdd->query('SELECT id FROM quizz');

        $bdd_quizzes = $get_quizzes->fetchAll();
        $quizzes = array();

        // create Quizz objects for each quizz
        foreach ($bdd_quizzes as $bdd_quizz) {
            $quizz = Quizz::getQuizzById($bdd_quizz['id']);

            // add object to return table
            array_push($quizzes, $quizz);
        }
        return $quizzes;
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

        // initialize correction variables
        $base_score = 10 / count($questions);
        $score = 10;

        // verify answers
        foreach ($questions as $question) {
            // get correct answers
            $correct_answer = $question->getCorrectAnswers();

            if ($question->type == 'input') {
                // if correct_answer doesn't exist in account_answer, user answered incorrectly
                if (!AccountAnswer::accountAnswerExist($account->getId(), $correct_answer->id, $date)) {
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
                        if (!AccountAnswer::accountAnswerExist($account->getId(), $answer->id, $date)) {
                            $score -= $base_score / count($answers);
                        }
                    }
                    else {
                        // if answer is not correct and user checked it, loose points
                        if (AccountAnswer::accountAnswerExist($account->getId(), $answer->id, $date)) {
                            $score -= $base_score / count($answers);
                        }
                    }
                }
            }
            else {
                // if correct_answer doesn't exist in account_answer, user answered incorrectly
                if (!AccountAnswer::accountAnswerExist($account->getId(), $correct_answer->id, $date)) {
                    $score -= $base_score;
                }
            }
        }
        return $score;
    }

    public static function getScoreType($score) {
        if ($score >= 7) {
            return "success";
        }
        else if ($score >= 4) {
            return "warning";
        }
        else {
            return "danger";
        }
    }

    public static function getScoreMessage($score) {
        if ($score >= 7) {
            return "Congratulations !";
        }
        else if ($score >= 4) {
            return "Quite good !";
        }
        else {
            return "Keep training !";
        }
    }
}

