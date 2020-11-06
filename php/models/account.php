<?php

class Account {
    public $id;
    public $username;
    private $password_hash;
    public $name;
    public $surname;
    public $email;
    public $last_connexion;

    // get full surname and name
    public function getFullname() {
        return $this->surname.' '.$this->name;
    }

    // get last connexion datetime formated
    public function getLastConnexionFormated() {
        $time = strtotime($this->last_connexion);

        return ucfirst(strftime('%A %e %B %Y', $time))." - ".strftime('%Hh%M', $time);
    }

    // get account by id
    public function getAccountById($id) {
        return $this->executeGetAccountBy('id', $id);
    }

    // get account by username
    public function getAccountByUsername($username) {
        return $this->executeGetAccountBy('username', $username);
    }

    // execute a request and fill
    private function executeGetAccountBy($key, $value) {
        global $bdd;

        $get_account = $bdd->prepare('SELECT * FROM account WHERE '. $key .' = ?');
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
}
