<head>
    <link href="css/accueil.css" rel="stylesheet" type="text/css">
</head>

<div class="main-body">
    <div class="texte-centrer">
        <h2> Bull's Association</h2>
    </div>
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
                    <h2> Notre Association </h2>
                    <div class="a">
                        <img class="img-fluid img-thumbnail"
                             src="https://image.jimcdn.com/app/cms/image/transf/dimension=270x1024:format=png/path/sf06e6c3b1475d69b/image/i8f5542fbe9e271f6/version/1424725324/image.png">
                    </div>
                    <p>Bull's Friends est un groupe de personnes dévouées qui ont décidé de s'unir au delà des
                        frontières. Alliant ainsi belges et français dans une seule cause... le placement de faces
                        plates. Tous bénévoles et au service des poilus pour leur donner la chance de retrouver une
                        famille aimante.
                        Toutes les aides possibles sont les bienvenues, alors n'hésitez pas à nous contacter via le
                        formulaire contact.Bonne visite en espérant que vous trouverez votre bonheur grâce à nous...</p>
                    <p>
                        Vous désirez ADOPTER chez nous ? Afin de prendre en compte votre dossier de candidature, merci
                        de remplir le formulaire d'adoption.<br>
                        Une fois celui-ci reçu par notre bureau, vous serez contacté par un bénévole afin de
                        l’accueillir pour une pré-visite.
                        Si cette pré-visite est positive et qu'un de nos protégés correspond à votre foyer, un membre du
                        bureau vous contactera pour vous faire part de la décision.
                    </p>
                </div>
            </article>

        </div>
    </div>
</div>

</main>