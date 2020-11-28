<?php

class Answer {
    private $id;
    private $answer;
    private $is_correct;
    private $form_id;
    private $name;
    private $value;
    private $required;

    // Question constructor
    public function __construct($id, $answer, $is_correct, $form_id, $name, $value, $required) {
        $this->id = $id;
        $this->answer = $answer;
        $this->is_correct = $is_correct;
        $this->form_id = $form_id;
        $this->name = $name;
        $this->value = $value;
        $this->required = $required;
    }


    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function getIsCorrect()
    {
        return $this->is_correct;
    }

    public function getFormId()
    {
        return $this->form_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getRequired()
    {
        return $this->required;
    }
}
