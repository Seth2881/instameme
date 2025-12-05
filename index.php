<?php require_once 'php/destroy_session.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login_inscription_style.css">

    <title>InstaGreek | Login</title>
</head>

<body>
    <header id="menu">
        <div class="lien-gauche">
            <a class="logoacceuil" href="#"><img id="logo" src="image/logo-acceuil.jpg" alt="logo de l'application"></a>
            <a class="lienacceuil" href="#">
                <h3>Login</h3>
            </a>
        </div>
    </header>
    <main>
    <div class="formulaire">
        <form id="form-login" action="php/can_log.php" method="post">
            <label for="name-login">Pseudo</label>
            <input name="name" id="name-login" type="text" required />

            <label for="password-login">Mot de passe</label>
            <input name="password" id="password-login" type="password" required />

            <button type="submit">Login</button>
        </form>

        <a class="signup-link" href="inscription.php">inscrivez vous !</a>
    </div>
    </main>
</body>

</html>