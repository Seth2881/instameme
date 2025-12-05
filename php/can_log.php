<?php require_once 'connection_bdd.php' ?>

<?php 
$exist = False;
$good_password = False;
$usrname = htmlspecialchars($_POST["name"]);
$password = md5(htmlspecialchars($_POST["password"]));

if ($isConnected) {
    $stmt = $mysqlConnection->prepare("SELECT id,pseudo FROM utilisateurs");
    $stmt->execute();
    $list_username = $stmt->fetchAll();

    for ($i = 0; $i < count($list_username); $i++) {
        // print_r($test[$i]);
        if ($list_username[$i][1] == $usrname){
            $exist = True;
            $id = $list_username[$i][0];
        }
    }

    if ($exist) {
        $stmt = $mysqlConnection->prepare("SELECT mot_de_passe FROM utilisateurs WHERE pseudo = ?");
        $stmt->execute([trim($usrname)]);
        $true_password = $stmt->fetchAll();
        if ($true_password[0][0] == $password) {
            session_start();
            $_SESSION['pseudo'] = $usrname;
            $_SESSION['id'] = $id;
            $_SESSION['role'] = 'user';
            header('Location: ../logged-in.php');
        } else {
            header('Location: ../index.php');
        }
    }
}
?>