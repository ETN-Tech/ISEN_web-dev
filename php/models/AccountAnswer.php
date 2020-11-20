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

        $get_account_answers = $bdd->prepare("SELECT date FROM account_answer WHERE account_id = ? GROUP BY date ORDER BY date DESC");
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

    public function insertBdd() {
        if (!empty($this->account_id) && !empty($this->answer_id) && !empty($this->date)) {
            global $bdd;

            $ins_account_answer = $bdd->prepare("INSERT INTO account_answer (account_id, answer_id, date) VALUES (?, ?, ?)");
            $ins_account_answer->execute(array($this->account_id, $this->answer_id, $this->date));
        } else {
            throw new Exception("Can't insert AccountAnswer with empty parameters in bdd");
        }
    }

    public static function deleteBdd($date) {
        global $bdd;

        $del_account_answer = $bdd->prepare("DELETE FROM account_answer WHERE date = ?");
        $del_account_answer->execute(array($date));
    }
}
