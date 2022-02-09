<head>
    <link href="css/accueil.css" rel="stylesheet" type="text/css">
</head>

        <h2>Compte</h2>
        <div class="articles">
            <article class="col-1">
                <div>
                    <p>Cliquez sur le bouton ci-dessous pour ajouter un Protégé: </p>
                    <button class="btn left" type="button"
                            onclick=" location.href = 'index.php?controller=Chien&action=formulaireChien';">Ajouter un
                        Protégé
                    </button>
                </div>
                <?php

                if ($_SESSION['isAdmin'] == 1) {
                    ?>

                    <div>

                        <p>Cliquez sur le bouton ci-dessous pour ajouter une Facture : </p>
                        <button class="btn left" type="button"
                                onclick=" location.href = 'index.php?controller=Facture&action=formulaireFacture'">
                            Ajouter
                            une Facture
                        </button>
                    </div>
                <?php } ?>
               </article>
            <article class="col-2">
                <div class="accueil">
                    <p>Votre pseudo est : <?php echo htmlspecialchars($u->getId()) ?></p>
                    <p>Votre mail est : <?php echo htmlspecialchars($u->getMail()) ?></p>
                    <button class="btn left" type="button"
                            onclick=" location.href = 'index.php?controller=Utilisateur&action=modificationCompte'">
                        Formulaire
                    </button>

            </article>

        </div>

</main>