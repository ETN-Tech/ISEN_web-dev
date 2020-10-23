<?php

class Account {
    public $id;
    public $username;
    private $password_hash;
    public $name;
    public $surname;
    public $email;
    public $last_connexion;

    // constructor
    public function __constructor($id, $username, $password_hash, $name, $surname, $email, $last_connexion) {
        $this->id = $id;
        $this->username = $username;
        $this->password_hash = $password_hash;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->last_connexion = $last_connexion;
    }

    // get full surname and name
    public function getFullname() {
        return $this->surname.' '.$this->name;
    }

    // get account by id
    public function getById($id) {
        $this->executeGetBy('id', $id);
    }

    // get account by username
    public function getByUsername($username) {
        $this->executeGetBy('username', $username);
    }

    // execute a request and fill
    private function executeGetBy($key, $value) {
        global $bdd;

        $get_account = $bdd->prepare('SELECT * FROM accounts WHERE '. $key .' = ?');
        $get_account->execute(array($value));

        $bdd_account = $get_account->fetch();

        if ($bdd_account) {
            $this->id = $bdd_account['id'];
            $this->username = $bdd_account['username'];
            $this->password_hash = $bdd_account['password_hash'];
            $this->name = $bdd_account['name'];
            $this->surname = $bdd_account['surname'];
            $this->email = $bdd_account['email'];
            $this->last_connexion = $bdd_account['last_connexion'];
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
}
