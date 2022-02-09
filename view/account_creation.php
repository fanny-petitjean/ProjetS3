<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title> Bull's Friends Association </title>
    <link rel="stylesheet" href="css/formulaire.css">
</head>
<body>
<form id="formulaire" method="post" action="index.php">
    <!--<form method="get" action="created.php"> -->
    <fieldset>

        <?php if (isset($data['id'])) {
            echo $error;
        } ?>
        <legend>Création de compte</legend>
        <p>
            <label for="id">Identifiant</label>
            <input type="text" value="<?php if (isset($data['id'])) {
                echo $data['id'];
            } ?>" placeholder="Identifiant" name="id" id="id" required/>
        </p>
        <p>
            <label for="mail">Mail <br></label>
            <input placeholder="Email" value="<?php if (isset($data['mail'])) {
                echo $data['mail'];
            } ?>" name="mail" id="mail" type="email" required>
        </p>
        <p>
            <label for="password">Mot de Passe</label>
            <input type="password" placeholder="Mot de passe" name="password" id="password" required>
        </p>
        <p>
            <label for="verifMdp">Confirmez votre mot de Passe</label>
            <input type="password" placeholder="Mot de passe" name="verifMdp" id="verifMdp" required>
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
            <input type='hidden' name='action' value='creationCompte'>

        </p>
    </fieldset>
</body>
</html>
