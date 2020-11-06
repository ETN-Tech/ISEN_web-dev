<?php

require_once('../php/models/account.php');

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
        
        $BddAccount = new Account();
        $BddAccount->getAccountByUsername($username);
        
        // vérifier le mot de passe
        if ($BddAccount->verifyPassword($password)) {
            // création de la session de connexion
            $_SESSION['user_id'] = $BddAccount->id;
            
            header('Location: ?url=account');
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
