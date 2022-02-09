<main>
    <div class="container-fluid red">
        <div class="container text-center">
            <h2> Erreur Chien </h2>

        </div>
        <div class="container-fluid blue">
            <div class="row">
                <article class="col-2">

                    <div>
                        <p>Cliquez sur le bouton ci-dessous pour ajouter un Protégé: </p>
                        <button class="btn left" type="button"
                                onclick="location.href = 'index.php?controller=Chien&action=formulaireChien';">Ajouter
                            un Protégé
                        </button>
                    </div>
                </article>
                <article class="col-10">
                    <p><?php echo $erreur ?> Faites retour pour retourner à la page d'ajout du protégé</p>
                    <div>
                        <p> Pour retourner sur la page des Chiens A Adopter: <a
                                    href="index.php?controller=Chien&action=Adopter"> A
                                Adopter </a></p>
                    </div>
                    <div>
                        <p> Pour retourner sur la page d'accueil: <a href="index.php?action=accueil"> Accueil </a></p>
                    </div>


                </article>

            </div>
        </div>
    </div>

</main>