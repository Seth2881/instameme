<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="css/login_inscription_style.css?v=<?= time() ?>">

    <title>InstaGreek | Inscription</title>
</head>

<body>
    <header id="menu">
        <div class="lien-gauche">
            <a class="logoacceuil" href="#"><img id="logo" src="image/logo-acceuil.jpg"
                    alt="logo de l'application"></a>
            <a class="lienacceuil" href="#">
                <h3>Inscription</h3>
            </a>
        </div>
    </header>
    <main>
    <div class="formulaire">
        <form id="form-inscription" action="php/inscription_logic.php" method="post">
            <label for="name-inscription">Pseudo</label>
            <input name="name" id="name-inscription" type="text" required />

            <label for="password-inscription">Mot de passe</label>
            <input name="password" id="password-inscription" type="password" required />

            <label for="password-valid-inscription">Confirmer mot de passe</label>
            <input name="password_validation" id="password-valid-inscription" type="password" required />

            <button type="submit">Inscription</button>
        </form>

        <a class="signup-link" href="index.php">retour à la page de login</a>
    </div>
    </main>
</body>

</html>