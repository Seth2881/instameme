<?php require_once 'session_check.php' ?>

<?php require_once 'connection_bdd.php' ?>

<?php
$id = $_SESSION['id'];
$desc = htmlspecialchars($_POST['description']);

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $fileSize = $_FILES['image']['size'];
    $fileType = $_FILES['image']['type'];

    // Définir un nom sécurisé pour le fichier
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // Déplacer le fichier vers un dossier sur le serveur
    $uploadFileDir = '../images-post/';
    $dest_path = $uploadFileDir . $newFileName;}

if ($isConnected) {
    $stmt = $mysqlConnection->prepare("INSERT INTO contenus (id_utilisateur, description, chemin_image, date_publication) 
    VALUES (?, ?, ?, NOW())");
    $stmt->execute([$id,$desc,$newFileName]);
    header('Location: ../logged-in.php');

}
?>