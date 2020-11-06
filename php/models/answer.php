<?php

class Answer {
    public $id;
    public $answer;
    public $is_correct;
    public $name;
    public $value;
    public $checked;
    public $required;

    // Question constructor
    public function __construct($id, $answer, $is_correct) {
        $this->id = $id;
        $this->answer = $answer;
        $this->is_correct = $is_correct;
    }
}
