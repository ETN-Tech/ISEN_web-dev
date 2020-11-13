<?php

$meta_title = "Login";

// redirect to account if user is connected
if (isset($_SESSION['user_id'])) {
    header('Location: ?url=account');
    die();
}

// gérer la connexion
if (isset($_POST['form-login'])) {
    
    // vérifier les champs
    if (isset($_POST['username'], $_POST['password']) && !empty($_POST['username']) && !empty($_POST['username'])) {
        
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        
        $bdd_account = new Account();
        $bdd_account->getAccountByUsername($username);
        
        // vérifier le mot de passe
        if ($bdd_account->verifyPassword($password)) {
            // création de la session de connexion
            $_SESSION['user_id'] = $bdd_account->id;

            // mettre a jour la date de connexion
            $bdd_account->updateLastConnexion();

            // handle redirection
            if (isset($_GET['next'])) {
                $next = htmlspecialchars($_GET['next']);
            } else {
                $next = 'account';
            }
            header('Location: ?url='. $next);
            die();
        }
        else {
            $error = "Username or password incorrect";
        }
    }
    else {
        $error = "Fields missing";
    }
    
}


require_once('../php/views/login.php');
