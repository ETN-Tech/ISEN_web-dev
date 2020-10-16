<?php

try
{
    if (getenv('DATABASE_URL') !== false) {
        include('../php/bdd-env.php');
    }
    $dbopts = parse_url(getenv('DATABASE_URL'));

    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

    $bdd = new PDO('pgsql:host='. $dbopts["host"] .';port='. $dbopts["port"] .';dbname='. ltrim($dbopts["path"],'/'), $dbopts["user"], $dbopts["pass"]);

    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$bdd = new PDO('mysql:host=localhost; dbname=isen_bootstrap; charset=utf8','root','root');
    //$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
