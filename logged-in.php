<?php
require_once 'php/session_check.php';

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="./css/post.css?v=<?= time() ?>">

    <title>InstaGreek | Acceuil</title>
    <!--InstaGreek, le nouveau réseau social pour grec ancien-->
</head>

<body>
    <header id="menu">
        <div class="lien-gauche">
            <a class="logoacceuil" href="logged-in.php"><img id="logo" src="image/logo.png"
                    alt="logo de l'application"></a>
            <a class="lienacceuil" href="logged-in.php">
                <h3>Acceuil</h3>
            </a>
        </div>
        <form class="help" action="php/search.php" method="post">
            <input type="search" id="site-search" name="q" maxlength="30" placeholder="search profiles/posts/ . . ." />
            <button id="search-button"><img class="logobouton" src="../image/searchlogo.png"></button>
        </form>
        <nav>
            <a class="barrenavacceuil" href="page/add-contenu.php">
                <h3>Créer</h3>
            </a>
            <a class="barrenavacceuil" href="page/generic-user.php">
                <h3>Profil</h3>
            </a>
            <a class="barrenavacceuil" href="index.php">
                <h3>Déconnexion</h3>
            </a>
        </nav>
    </header>

    <main id="main-page">

        <?php require_once 'php/content_loading.php' ?>

    </main>
</body>

</html>