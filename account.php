<?php

require_once('php/session-locale.php');

require_once('modeles/accounts.php');


// verify user connected
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    die();
}


// deconnect user on demand
if (isset($_GET['logout'])) {
    unset($_SESSION['user_id']);
    header('Location: login.php');
    die();
}


$account = get_account($_SESSION['user_id'])->fetch();

// format datetime
$full_name = $account['surname'] .' '. $account['name'];
$last_connexion = ucfirst(strftime('%a %e %B %Y - %kh%M', strtotime($account['last_connexion'])));


require_once('views/account.view.php');
