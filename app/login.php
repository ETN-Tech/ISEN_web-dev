<?php

require_once('../php/session-locale.php');

require_once('../php/models/accounts.php');


// redirect to account if user is connected
if (isset($_SESSION['user_id'])) {
    header('Location: account.php');
    die();
}


// gérer la connexion
if (isset($_POST['form-login'])) {
    
    // vérifier les champs
    if (isset($_POST['username'], $_POST['password']) && !empty($_POST['username']) && !empty($_POST['username'])) {
        
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        
        $bdd_account = get_account_by_username($username)->fetch();
        
        // vérifier le mot de passe
        if (isset($bdd_account['password']) && password_verify($password, $bdd_account['password'])) {
            // création de la session de connexion
            $_SESSION['user_id'] = $bdd_account['id'];
            
            header('Location: account.php');
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


require_once('../php/views/login.view.php');
