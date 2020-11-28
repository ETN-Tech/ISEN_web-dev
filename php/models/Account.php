<?php

class Account {
    private $id;
    private $username;
    private $password_hash;
    private $name;
    private $surname;
    private $email;
    private $last_connexion;


    // Account constructor
    public function __construct($id, $username, $password_hash, $name, $surname, $email, $last_connexion)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password_hash = $password_hash;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->last_connexion = $last_connexion;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getSurname()
    {
        return $this->surname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getLastConnexion()
    {
        return $this->last_connexion;
    }


    // get full surname and name
    public function getFullname() {
        return $this->surname.' '.$this->name;
    }

    // get account by id
    public static function getAccountById($id) {
        return Account::executeGetAccountBy('id', $id);
    }

    // get account by username
    public static function getAccountByUsername($username) {
        return Account::executeGetAccountBy('username', $username);
    }

    // execute a request get by
    private static function executeGetAccountBy($key, $value) {
        global $bdd;

        $get_account = $bdd->prepare('SELECT * FROM account WHERE '. $key .' = ?');
        $get_account->execute(array($value));

        $bdd_account = $get_account->fetch();

        if ($bdd_account) {
            return new Account(
                $bdd_account['id'],
                $bdd_account['username'],
                $bdd_account['password_hash'],
                $bdd_account['name'],
                $bdd_account['surname'],
                $bdd_account['email'],
                $bdd_account['last_connexion']
            );
        } else {
            return false;
        }
    }

    public static function getAccountByAccountAnswerDate($date) {
        global $bdd;

        $get_account = $bdd->prepare("SELECT * FROM account_answer INNER JOIN account ON account_answer.account_id = account.id WHERE date = ?");
        $get_account->execute(array($date));

        $bdd_account = $get_account->fetch();

        if ($bdd_account) {
            return new Account(
                $bdd_account['id'],
                $bdd_account['username'],
                $bdd_account['password_hash'],
                $bdd_account['name'],
                $bdd_account['surname'],
                $bdd_account['email'],
                $bdd_account['last_connexion']
            );
        } else {
            return false;
        }
    }

    // check if username exist
    public static function accountExistByUsername($username) {
        global $bdd;

        $get_account = $bdd->prepare("SELECT id FROM account WHERE username = ?");
        $get_account->execute(array($username));

        $account = $get_account->fetch();

        if ($account) {
            return true;
        } else {
            return false;
        }
    }

    // check password
    public function verifyPassword($password) {
        if (password_verify($password, $this->password_hash)) {
            return true;
        } else {
            return false;
        }
    }

    // update last connexion datetime to now
    public function updateLastConnexion() {
        global $bdd;

        $upd_bdd = $bdd->prepare('UPDATE account SET last_connexion = NOW() WHERE id = ?');
        $upd_bdd->execute(array($this->id));
    }

    public function insertBdd() {
        if (!empty($this->username) && !empty($this->password_hash) && !empty($this->name) && !empty($this->surname) && !empty($this->email)) {
            global $bdd;

            $ins_account_answer = $bdd->prepare("INSERT INTO acccount (username, password_hash, name, surname, email) VALUES (?, ?, ?, ?, ?)");
            $ins_account_answer->execute(array($this->username, $this->password_hash, $this->name, $this->surname, $this->email));
        } else {
            throw new Exception("Can't insert Account with empty parameters in bdd");
        }
    }
}
