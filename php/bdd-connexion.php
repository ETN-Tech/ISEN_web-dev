<?php

try
{
    $dbopts = parse_url(getenv('DATABASE_URL'));

    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

    $bdd = new PDO('pgsql:host='. $dbopts["host"] .';port='. $dbopts["port"] .';dbname='. ltrim($dbopts["path"],'/'), $dbopts["user"], $dbopts["pass"]);

    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
