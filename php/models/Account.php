<?php

class Account {
    public $id;
    public $username;
    private $password_hash;
    public $name;
    public $surname;
    public $email;
    public $last_connexion;


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
}
