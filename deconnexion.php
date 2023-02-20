<?php 
    session_start(); //initialisation de la session en cours
    require_once('User.php');
    User::disconnect();
?>