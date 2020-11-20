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

    public static function getAccountAnswerDatesByAccount($account_id) {
        global $bdd;

        $get_account_answers = $bdd->prepare("SELECT account_answer.date FROM account_answer WHERE account_id = ? GROUP BY account_answer.date");
        $get_account_answers->execute(array($account_id));

        return $get_account_answers->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function accountAnswerExist($account_id, $answer_id, $date) {
        global $bdd;

        $get_account_answer = $bdd->prepare("SELECT id FROM account_answer WHERE account_id = ? AND answer_id = ? AND date = ?");
        $get_account_answer->execute(array($account_id, $answer_id, $date));

        $account_answer = $get_account_answer->fetch();

        if ($account_answer) {
            return true;
        } else {
            return false;
        }
    }

    public static function insertBdd($account_id, $answer_id, $date) {
        global $bdd;

        $ins_account_answer = $bdd->prepare("INSERT INTO account_answer (account_id, answer_id, date) VALUES (?, ?, ?)");
        $ins_account_answer->execute(array($account_id, $answer_id, $date));
    }

    public static function deleteBdd($date) {
        global $bdd;

        $del_account_answer = $bdd->prepare("DELETE FROM account_answer WHERE date = ?");
        $del_account_answer->execute(array($date));
    }
}
