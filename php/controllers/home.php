<?php

require_once('../php/models/account.php');

$meta_title = "Home";

// test if user connected
if (isset($_SESSION['user_id'])) {
    $user_connected = true;
    
    $bdd_account = new Account();
    $bdd_account->getById($_SESSION['user_id']);
    
    $full_name = $bdd_account->getFullname();
} else {
    $user_connected = false;
}


require_once('../php/views/home.php');
