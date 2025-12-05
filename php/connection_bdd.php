<?php
// gestion d'affichage des images
$isConnected = false;
$error = '';
try {
    $mysqlConnection = new PDO(
        'mysql:host=localhost;dbname=instameme;charset=utf8',
        'root'
    );
    $isConnected = True;
} catch (Exception $e) {
    $error = "Erreur connection BDD : ".$e->getMessage();
}
?>