<?php require_once '../php/session_check.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/post.css">

    <title>InstaGreek | Profil</title>
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
        
        <?php require_once '../php/loading_post_user.php' ?>

    </main>
    <script src="../js/heart-change.js"></script>
</body>

</html>