<head>
    <link href="css/Protege.css" rel="stylesheet" type="text/css">
</head>
<main>
    <div class="container-fluid red">
        <div class="container text-center">
            <h2> Les protégés</h2>

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
                        <?php
                        if ($chien == NULL) {
                            echo "<div>Aucun protégé n'existe</div>";
                        } else {
                            foreach ($chien as $c) {
                                echo '<div class="row justify-content-center"><h3 class=" text-center">' . htmlspecialchars($c->getNomchien()) . ' : ' . htmlspecialchars($c->getNumPuce()) . '</h3>';
                                echo '<div class="col-4"><img class="photoChien" src="image/chien/' . htmlspecialchars($c->getNomPhoto()) . '" alt="' . htmlspecialchars($c->getNomPhoto()) . '"></div>';
                                echo '<div  class="row justify-content-start"><div class="col-4"><p> Race : ' . htmlspecialchars($c->getRace()) . '</p><p> Robe : ' . $c->getRobe() . '</p></div>';
                                echo '<div class="col-4"><p> Date de Naissance  : ' . htmlspecialchars($c->getDateNaissance()) . '</p><p> Date début accueil : ' . htmlspecialchars($c->getDateAccueil()) . '</p></div>';
                                echo '<div class="col-4"><p> Sexe  : ' . htmlspecialchars($c->getSexe()) . '</p><p> Sterelisation : ' . htmlspecialchars($c->getSterilisation()) . '</p></div>';
                                echo '<div><p>' . htmlspecialchars($c->getDescription()) . '</p></div></div>';

                               
                                echo '<p><a href="index.php?controller=Chien&action=Valider&numPuce=' . rawurlencode($c->getNumPuce()) . '"> Accepter </a></p>';
                                 echo '<p><a href="index.php?controller=Chien&action=Refuser&numPuce=' . rawurlencode($c->getNumPuce()) . '"> Refuser </a></p>';
                                

                            }
                        }
                        ?>
                    </div>

                </article>

            </div>
        </div>
    </div>

</main>
