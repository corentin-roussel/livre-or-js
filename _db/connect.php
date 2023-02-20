<?php

// Déclaration des variables pour pouvoir remplacer les champs si besoins 

$users = 'root';
$password = '';

//Connexion a la base de données 






//$mysqli = new mysqli("localhost, corentin, Mldsr.0202, corentin-roussel_moduleconenxion"); // Connexion a la base de données pour plesk


//test de connexion pour afficher un message d'erreur
try {
    $dbcon = new PDO('mysql:host=localhost;dbname=livreorjs', $users, $password);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>