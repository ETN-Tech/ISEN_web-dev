<?php

$meta_title = "Logout";


unset($_SESSION['user_id']);
session_destroy();

header('Location: ?page=login');
die();
