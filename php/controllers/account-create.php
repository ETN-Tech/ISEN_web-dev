<?php

$meta_title = "Account creation";

// if account creation form sent
if (isset($_POST['form-account-create'])) {
    // verify all parameters sent
    $errors = array();
    $nb_errors = 0;
    $required_fields = ['username', 'password', 'name', 'surname', 'email'];

    foreach($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $nb_errors++;
            array_push($errors,"Please fill in all the fields.");
            break;
        }
    }

    // secure inputs
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = htmlspecialchars($_POST['email']);

    // validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $nb_errors++;
        array_push($errors, "Email is not valid.");
    }
    // check if username not already taken
    if (Account::accountExistByUsername($username)) {
        $nb_errors++;
        array_push($errors,"Username is already taken. Choose a different one.");
    }

    // if no error
    if ($nb_errors == 0) {
        // hash password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // insert account into bdd
        $ins_account = $bdd->prepare("INSERT INTO account (username, password_hash, name, surname, email) VALUES (?, ?, ?, ?, ?)");
        $ins_account->execute(array($username, $password_hash, $name, $surname, $email));

        $succes = 1;
    } else {
        $error_msg = '';
        foreach ($errors as $error) {
            $error_msg .= $error .'<br>';
        }
    }
} else {
    $username = '';
    $name = '';
    $surname = '';
    $email = '';
}


require_once ('../php/views/account-create.php');
