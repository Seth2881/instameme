<?php require_once 'session_check.php' ?>

<?php require_once 'connection_bdd.php' ?>

<?php

$id = $_SESSION['id'];
$id_contenu = $_GET['id_post'];
if ($isConnected) {
    $check = $mysqlConnection->prepare('SELECT * FROM likes WHERE likes.id_contenu = ? AND likes.id_utilisateur = ?');
    $check->execute([$id_contenu, $id]);
    $check_list = $check->fetch(PDO::FETCH_ASSOC);

    if (!$check_list) {
        $stmt = $mysqlConnection->prepare("INSERT INTO likes (id_contenu,id_utilisateur) VALUES (?,?)");
        $stmt->execute([$id_contenu, $id]);
    } else {
        $stmt = $mysqlConnection->prepare("DELETE FROM likes WHERE likes.id_contenu = ? AND likes.id_utilisateur = ?");
        $stmt->execute([$id_contenu, $id]);
    }
}
header("Location: " . $_SERVER['HTTP_REFERER']);
?>