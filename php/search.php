<?php require_once 'session_check.php' ?>

<?php require_once 'connection_bdd.php' ?>

<?php
$nom = htmlspecialchars($_POST['q']);

if ($isConnected) {
    $check = $mysqlConnection->prepare('SELECT * FROM utilisateurs WHERE utilisateurs.pseudo = ?');
    $check->execute([$nom]);
    $check_list = $check->fetch(PDO::FETCH_ASSOC);
} 

if ($check_list) {
    header('Location: ../page/generic-user.php?pseudo='.$check_list['pseudo']);
} else {
    header('Location: '.$_SERVER['HTTP_REFERER']);
}

?>