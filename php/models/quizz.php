<?php

class Quizz {
    public $id;
    public $name;
    public $title;
    public $description;
    public $img_url;

    // get all quizzes infos and return them
    public function getQuizzes() {
        global $bdd;

        $get_quizzes = $bdd->query('SELECT * FROM quizzes');

        $bdd_quizzes = $get_quizzes->fetchAll();
        $quizzes = array();

        // create Quizz objects for each quizz
        foreach ($bdd_quizzes as $bdd_quizz) {
            $quizz = new Quizz();

            // convert array to object
            foreach ($bdd_quizz  as $key => $value) {
                $quizz->$key = $value;
            }
            // add object to return table
            array_push($quizzes, $quizz);
        }
        return $quizzes;
    }

    // get account by id
    public function getById($id) {
        return $this->executeGetBy('id', $id);
    }

    // get account by name
    public function getByName($name) {
        return $this->executeGetBy('name', $name);
    }

    // execute a request and fill fields
    private function executeGetBy($key, $value) {
        global $bdd;

        $get_account = $bdd->prepare('SELECT * FROM quizzes WHERE '. $key .' = ?');
        $get_account->execute(array($value));

        $bdd_account = $get_account->fetch();

        if ($bdd_account) {
            $this->id = $bdd_account['id'];
            $this->name = $bdd_account['name'];
            $this->title = $bdd_account['title'];
            $this->description = $bdd_account['description'];
            $this->img_url = $bdd_account['img_url'];
            return true;
        } else {
            return false;
        }
    }
}

