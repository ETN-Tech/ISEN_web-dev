<?php

class Proposition {
    public $id;
    public $proposition;
    public $name;
    public $value;
    public $checked;
    public $required;

    // Question constructor
    public function __construct($id, $proposition, $name, $value, $checked, $required)
    {
        $this->id = $id;
        $this->proposition = $proposition;
        $this->name = $name;
        $this->value = $value;
        $this->checked = $checked;
        $this->required = $required;
    }

    // get all proposition infos for a question and return them
    public function getByQuestionId($question_id) {
        global $bdd;

        $get_propositions = $bdd->prepare('SELECT * FROM question_propositions WHERE question_id = ?');
        $get_propositions->execute(array($question_id));

        $bdd_propositions = $get_propositions->fetchAll();
        $propositions = array();

        // create Proposition objects for each proposition
        foreach ($bdd_propositions as $bdd_proposition) {
            $proposition = new Quizz();

            // convert array to object
            foreach ($bdd_proposition  as $key => $value) {
                $proposition->$key = $value;
            }
            // add object to return table
            array_push($propositions, $proposition);
        }
        return $propositions;
    }

    // get a proposition by id
    public function getById($id) {
        global $bdd;

        $get_proposition = $bdd->prepare('SELECT * FROM question_propositions WHERE id = ?');
        $get_proposition->execute(array($id));

        $bdd_proposition = $get_proposition->fetch();

        if ($bdd_proposition) {
            $this->id = $bdd_proposition['id'];
            $this->proposition = $bdd_proposition['proposition'];
            $this->name = $bdd_proposition['name'];
            $this->value = $bdd_proposition['value'];
            $this->checked = $bdd_proposition['checked'];
            $this->required = $bdd_proposition['required'];
            return true;
        } else {
            return false;
        }
    }
}
