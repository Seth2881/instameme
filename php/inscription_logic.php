<?php require_once 'connection_bdd.php' ?>

<?php
$is_new_username = False;
$username = htmlspecialchars($_POST['name']);
$password = md5(htmlspecialchars($_POST['password']));
$confirm_password = md5(htmlspecialchars($_POST['password_validation']));

if ($isConnected) {
    $stmt = $mysqlConnection->prepare("SELECT pseudo FROM utilisateurs");
    $stmt->execute();
    $list_username = $stmt->fetchAll();
    
    for ($i=0 ; $i < count($list_username) ; $i++){
        if ($list_username[$i][0] == $username) {
            header('Location: ../inscription.php');
        }
    }
    $is_new_username = True;
    
    if ($is_new_username) {
        if ($password == $confirm_password) {
            $stmt = $mysqlConnection->prepare("INSERT INTO utilisateurs (pseudo,mot_de_passe,date_inscription) VALUES (?,?,NOW())");
            $stmt->execute([$username,$password]);
            $list_username = $stmt->fetchAll();
            header('Location: ../index.php');
        }
    }
}
?>