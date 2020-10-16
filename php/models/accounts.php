<?php

require_once('../php/bdd-connexion.php');


// get account informations by user_id
function get_account($user_id) {
    global $bdd;
    
    $get_account = $bdd->prepare('SELECT * FROM accounts WHERE id = ?');
    $get_account->execute(array($user_id));

    return $get_account;
}

// get account informations by username
function get_account_by_username($username) {
    global $bdd;
    
    $get_account = $bdd->prepare('SELECT * FROM accounts WHERE username = ?');
    $get_account->execute(array($username));

    return $get_account;
}
