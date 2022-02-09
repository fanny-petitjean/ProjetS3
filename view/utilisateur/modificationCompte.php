<head>
    <link href="css/Contact.css" rel="stylesheet" type="text/css">
</head>
<main>
    <div class="container-fluid red">
        <div class="container text-center">
            <h2> Modifier Votre Compte </h2>

        </div>
        <div class="container-fluid blue">
            <div class="row">
                <article class="col-2">
                </article>
                <article class="col-10">

                    <form class="centrer" action="index.php" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="input">
                                <span class="inputItem">Pseudo *</span>
                                <input class="inputField readonly" id="pseudo" name="pseudo"
                                       value="<?php echo htmlspecialchars($u->getId()) ?>" readonly
                                       type="text" required>
                            </div>
                            <div class="input">
                                <span class="inputItem">Mail *</span>
                                <input class="inputField" id="mail" name="mail"
                                       value="<?php echo htmlspecialchars($u->getMail()) ?>"
                                       required
                                       type="text">
                            </div>
                            <div class="input">
                                <span class="inputItem">Mot de passe *</span>
                                <input class="inputField" id="motDePasse" name="motDePasse"
                                       required
                                       type="password">
                            </div>
                            <div class="input">
                                <span class="inputItem"> Retapez Mot de passe *</span>
                                <input class="inputField" id="motDePasse1" name="motDePasse1"
                                       required
                                       type="password">
                            </div>

                        </fieldset>
                        <div class="input" id="send">
                            <input type="submit" value="Envoyer">
                            <input type='hidden' name='controller' value='Utilisateur'>

                            <input type='hidden' name='action' value='modifierCompte'>
                        </div>
                    </form>
                </article>

            </div>
        </div>
    </div>

</main>
<footer>
</footer>

</body>
</html>
