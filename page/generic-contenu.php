<?php require_once '../php/session_check.php' ?>
<?php require_once '../php/connection_bdd.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/contenu.css">

    <title>InstaGreek | generic-content</title>
</head>

<body>
    <header id="menu">
        <div class="lien-gauche">
            <a class="logoacceuil" href="../logged-in.php"><img id="logo" src="../image/logo.png"
                    alt="logo de l'application"></a>
            <a class="lienacceuil" href="../logged-in.php">
                <h3>Acceuil</h3>
            </a>
        </div>
        <div class="help">
            <input type="search" id="site-search" name="q" maxlength="30" placeholder="search profiles/posts/ . . ." />
            <button id="search-button"><img class="logobouton" src="../image/searchlogo.png"></button>
        </div>
        <nav>
            <a class="barrenavacceuil" href="add-contenu.php">
                <h3>Créer</h3>
            </a>
            <a class="barrenavacceuil" href="generic-user.php">
                <h3>Profil</h3>
            </a>
            <a class="barrenavacceuil" href="../index.php">
                <h3>Déconnexion</h3>
            </a>
        </nav>
    </header>

    <main>
        <?php
        $id = $_GET['id_post'];

        if ($isConnected) {
            $stmt = $mysqlConnection->prepare("SELECT utilisateurs.pseudo,contenus.id, contenus.description,contenus.chemin_image ,COUNT(DISTINCT likes.id_utilisateur) as nb_like FROM contenus JOIN utilisateurs ON utilisateurs.id = contenus.id_utilisateur LEFT JOIN likes ON likes.id_contenu = contenus.id WHERE contenus.id = ? GROUP BY contenus.id, contenus.description, utilisateurs.pseudo");
            $stmt->execute([$id]);
            $contenu = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $final =
            "<div class=\"pseudo-main\">" .
            "<a class=\"image\" href=\"#\">" .
            "<img class=\"post-image\" src=\"../images-post/" . $contenu['chemin_image'] . "\" alt=\"" . $contenu['chemin_image'] . "\">" .
            "</a>" .

            "<div class=\"contenu\">" .
            "<div class=\"bonjour-romain\">" .

            "<div class=\"userinfo\">" .
            "<a href=\"generic-user.php?pseudo=".$contenu['pseudo']."\" class=\"username\">" .
            "<img class=\"pfp\" src=\"../image/pfp-ulysse.jpg\" alt=\"photo-profil\">" .
            "<strong>" . $contenu['pseudo'] . "</strong>" .
            "</a>" .
            "</div>" .

            "<p class=\"description\">" .
            $contenu['description'] .
            "</p>" .
            "<br>" .
            "<p>" .
            "<div class=\"like-partage-disposition\">" .
            "<button class=\"unset\" class=\"button-like\">" .
            "<img class=\"like-partage\" src=\"../image/like-vide.png\" alt=\"like-partage\">" .
            "</button>" .
            "<a href=\"add-contenu.php\" class=\"button-partage\">" .
            "<img class=\"like-partage\" src=\"../image/partage.png\" alt=\"like-partage\">" .
            "</a>" .
            "</div>" .

            "<hr>" .
            "<p class=\"showaime\"><strong>nombres de likes : </strong>" . $contenu['nb_like'] . "</p>" .
            "<hr>";

        $post_id = $id;
        $stmt = $mysqlConnection->prepare("
        SELECT commentaires.message, utilisateurs.pseudo
        FROM commentaires
        JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur
        WHERE commentaires.id_contenu = ?
        ORDER BY commentaires.id ASC
    ");
        $stmt->execute([$post_id]);
        $list_commentaire = $stmt->fetchAll();

        foreach ($list_commentaire as $commentaire) {
            $final .= "<p class=\"com\"><strong>" . $commentaire['pseudo'] . " : </strong>" . $commentaire['message'] . "</p>";
        }


        $final .= "<hr>" .
            "<div class=\"formulaire\">" .
            "<textarea class=\"inputcom\" name=\"commente\" id=\"sendcommentaire\" placeholder=\"Qu'en pense tu ? donne ton avis !\"></textarea>" .
            "<button class=\"send\">" .
            "<img class=\"commenter\" src=\"../image/commenter.png\" alt=\"commenter\">" .
            "</button>" .
            "</div>" .

            "</div>" .
            "</div>" .
            "</div>";


        echo $final
        ?>

    </main>
</body>

</html>