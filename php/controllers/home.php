<?php

$meta_title = "Home";

// test if user connected
if (isset($account)) {
    $user_connected = true;
    
    $bdd_account = Account::getAccountById($_SESSION['user_id']);
    
    $full_name = $bdd_account->getFullname();
}


require_once('../php/views/home.php');
