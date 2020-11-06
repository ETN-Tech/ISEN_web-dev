<?php

class Answer {
    public $id;
    public $answer;
    public $is_correct;
    public $form_id;
    public $name;
    public $value;
    public $checked;
    public $required;

    // Question constructor
    public function __construct($id, $answer, $is_correct, $form_id, $name, $value, $checked, $required)
    {
        $this->id = $id;
        $this->answer = $answer;
        $this->is_correct = $is_correct;
        $this->form_id = $form_id;
        $this->name = $name;
        $this->value = $value;
        $this->checked = $checked;
        $this->required = $required;
    }


    public function getAnswerById() {

    }
}
