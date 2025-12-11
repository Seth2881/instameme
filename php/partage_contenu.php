<?php require_once 'session_check.php' ?>
<?php require_once 'connection_bdd.php' ?>

<?php
$id = $_SESSION['id'];
$id_contenu = $_GET['id_post'] ?? $_POST['id_contenu']; // Récupère l'ID du post à partager
$desc = htmlspecialchars($_POST['description'] ?? '');

if ($isConnected && $id_contenu) {
    // Récupère l'image du contenu original
    $stmt = $mysqlConnection->prepare('SELECT chemin_image FROM contenus WHERE id = ?');
    $stmt->execute([$id_contenu]);
    $original = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($original) {
        $nom_contenu = $original['chemin_image'];
        
        // Insère le nouveau post avec la même image
        $stmt = $mysqlConnection->prepare("
            INSERT INTO contenus (id_utilisateur, description, chemin_image, date_publication) 
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->execute([$id, $desc, $nom_contenu]);
        
        header('Location: ../logged-in.php');
        exit;
    }
}

// Si erreur, retour à la page précédente
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>