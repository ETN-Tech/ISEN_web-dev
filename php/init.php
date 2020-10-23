<?php

session_start();

setlocale (LC_TIME, 'fr_FR.utf8', 'fr_FR','fra', 'fr');
date_default_timezone_set('Europe/Paris');

try {
    if (getenv('DATABASE_URL') === false) {
        putenv("DATABASE_URL=sql://root:root@localhost:3306/isen_bootstrap");
        $driver = 'mysql';
    } else {
        $driver = 'pgsql';
    }

    $dbopts = parse_url(getenv('DATABASE_URL'));
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

    $bdd = new PDO( $driver.':host='. $dbopts["host"] .';port='. $dbopts["port"] .';dbname='. ltrim($dbopts["path"],'/'), $dbopts["user"], $dbopts["pass"]);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}