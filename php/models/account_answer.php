<?php

class AccountAnswer {
    public $id;
    public $account_id;
    public $answer_id;
    public $date;

    // constructor
    public function __construct($id, $account_id, $answer_id, $date)
    {
        $this->id = $id;
        $this->account_id = $account_id;
        $this->answer_id = $answer_id;
        $this->date = $date;
    }


    public function createAccountAnswer() {
        global $bdd;

        $ins_account_answer = $bdd->prepare("INSERT INTO account_answer ('account_id', 'anwser_id', 'date') VALUES (?, ?, ?)");
        $ins_account_answer->execute(array($this->account_id, $this->answer, $this->date));
    }
}
