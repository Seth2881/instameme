<?php
require_once '../php/connection_bdd.php';
require_once 'session_check.php';

$id = $_SESSION['id'];
$comment = $_POST['commente'];
$id_post = $_GET['post_id'];

if ($isConnected) {
    $stmt = $mysqlConnection->prepare('INSERT INTO commentaires (id_contenu,id_utilisateur,message,date_publication) VALUES (?,?,?,NOW());');
    $stmt->execute([$id_post,$id,$comment]);
}
header('Location: '. $_SERVER['HTTP_REFERER']);
?>