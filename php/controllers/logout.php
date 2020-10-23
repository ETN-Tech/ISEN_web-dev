<?php

$meta_title = "Logout";

// deconnect user on demand
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
    header('Location: ?url=login');
    die();
} else {
    header('Location: ?url=home');
}

