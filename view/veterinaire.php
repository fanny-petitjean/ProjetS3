<main>
    <div class="container-fluid red">
        <div class="container text-center">
            <h2> <?php echo htmlspecialchars($veto->getNomVeto()); ?></h2>

        </div>
        <div class="container-fluid blue">
            <div class="row">
                <article class="col-2">

                    <div>
                        <p>Cliquez sur le bouton ci-dessous pour ajouter une Facture : </p>
                        <button class="btn left" type="button"
                                onclick="location.href ='index.php?controller=Facture&action=formulaireFacture';">
                            Ajouter une Facture
                        </button>
                    </div>
                </article>
                <article class="col-10">

                    <?php
                            echo '<ul><li>  Numéro de téléphone : ' . htmlspecialchars($veto->getNumTelephoneVeto()) . '</li> ';
                            echo '<li> Adresse : ' . htmlspecialchars($veto->getAdresseVeto()) . '</li>';
                            echo '<li> Ville : ' . htmlspecialchars($veto->getCodePostalVeto()) . ', '. htmlspecialchars($veto->getVilleVeto()) .'  </li>';
                            echo '<li> Pays : ' . htmlspecialchars($veto->getPaysVeto()) . '</li></ul>';
                            ?></p>
                    <div>
                        <p> Pour retourner sur la page de Facture: <a
                                    href="index.php?controller=Facture&action=Facture"> Facture </a></p>
                    </div>
                    <p> Pour retourner sur la page d'accueil: <a href="index.php?action=accueil"> Accueil </a></p>


                </article>

            </div>
        </div>
    </div>

</main>
