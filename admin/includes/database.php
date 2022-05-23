<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'administracijahotelskogkompleksa';

    try{
        $dsn = 'mysql:host=' . $host . ';dbname=' . $database;
        $connection = new PDO($dsn, $user, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die('Connection error' . $e->getMessage());
    }
?>