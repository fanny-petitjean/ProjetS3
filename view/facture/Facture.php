<head>
    <link href="css/Facture.css" rel="stylesheet" type="text/css">
</head>

<main>

    <div class="main-body">
        <div class="texte-centrer">
            <h2> Facture</h2>
        </div>

        <div class="articles">
            <article class="col-1">
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
                <div class="barre-menu" id="filtres">
                    <nav class="menu">
                        <a class="btn-simple" href="index.php?controller=Facture&action=trierFacturesNums">Trier par</a>
                        <li class="menu-déroulant">
                            <a class="menu-déroulant" role="button"
                               href="index.php?controller=Facture&action=trierFacturesNums">Numero de Facture</a>
                            <ul class="sous-menu">
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesNums">Croissant</a>
                                </li>
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesNumsDecroissants">Decroissant</a>
                                </li>
                                <div>Ou</div>
                                <li class="sous-menu">
                                    <form method="post" name="" action="index.php">
                                        <fieldset>
                                <li><span class="inputItem">Numero Facture</span>
                                    <input class="inputField" id="numFacture" name="numFacture"
                                           type="text" required></li>
                                </fieldset>
                                <div class="input" id="send">
                                    <input type="submit" value="Envoyer">
                                    <input type='hidden' name='controller'
                                           value='Facture'>
                                    <input type='hidden' name='action' value='trouverFacture'>
                                </div>
                                </form>
                                </li>
                            </ul>
                        </li>


                        <li class="menu-déroulant">
                            <a class="menu-déroulant" href="index.php?controller=Facture&action=trierFacturesNums"
                               role="button">Type</a>
                            <ul class="sous-menu">
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesTypes&type=nourriture">Nourriture</a>
                                </li>
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesTypes&type=kilometrique">Kilométrique</a>
                                </li>
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesTypes&type=veterinaire">Véténiraire</a>
                                </li>
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesTypes&type=autre">Autres</a>
                                </li>
                            </ul>
                        </li>


                        <li class="menu-déroulant">
                            <a class="menu-déroulant" href= "index.php?controller=Facture&action=trierFacturesMotifs"
                               role="button">Motif</a>
                            <ul class="sous-menu">
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesMotifs">A-Z</a>
                                </li>
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesMotifsDecroissants">Z-A</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-déroulant">
                            <a class="menu-déroulant" href="index.php?controller=Facture&action=trierFacturesCouts"
                               role="button">Cout</a>
                            <ul class="sous-menu">
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesCouts">Croissant</a>
                                </li>
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesCoutsDecroissants">Decroissant</a>
                                </li>
                                <div>Ou</div>
                                <form method="post" name="" action="index.php">
                                    <fieldset>
                                        <li><span class="inputItem">Cout min</span>
                                            <input class="inputField" id="min" name="min" type="text"
                                                   placeholder="00.00" required>
                                        </li>
                                        <li><span class="inputItem">Cout max</span>
                                            <input class="inputField" id="max" name="max" type="text"
                                                   placeholder="00.00" required></li>
                                    </fieldset>
                                    <div class="input" id="send">
                                        <input type="submit" value="Envoyer">
                                        <input type='hidden' name='controller'
                                               value='Facture'>
                                        <input type='hidden' name='action' value='trouverFacturesCouts'>
                                    </div>
                                </form>
                            </ul>
                        </li>
                        <li class="menu-déroulant">
                            <a class="menu-déroulant" href="index.php?controller=Facture&action=trierFacturesNums"
                               role="button">Date </a>
                            <ul class="sous-menu">
                                <form method="post" name="" action="index.php">
                                    <fieldset>
                                        <li><span class="inputItem">Date min</span>
                                            <input class="inputField" id="datemin" name="datemin"
                                                   type="date" required>
                                        </li>
                                        <li><span class="inputItem">Date max</span>
                                            <input class="inputField" id="datemax" name="datemax"
                                                   type="date" required></li>

                                    </fieldset>
                                    <div class="input" id="send">
                                        <input type="submit" value="Envoyer">
                                        <input type='hidden' name='controller'
                                               value='Facture'>
                                        <input type='hidden' name='action'
                                               value='trierFacturesDateFactures'>
                                    </div>
                                </form>
                            </ul>

                        <li class="menu-déroulant">
                            <a class="menu-déroulant" href="index.php?controller=Facture&action=trierFacturesCrediteurs"
                               role="button">Créditeurs</a>
                            <ul class="sous-menu">
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesCrediteurs">A-Z</a>
                                </li>
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesCrediteursDecroissants">Z-A</a>
                                </li>
                            </ul>
                        </li>
                        </li>
                        <li class="menu-déroulant">
                            <a class="menu-déroulant" href="index.php?controller=Facture&action=trierFacturesNumPuces"
                               role="button" data-bs-toggle="dropdown">Numero Puce</a>
                            <ul class="sous-menu">
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesNumPuces">Croissant</a>
                                </li>
                                <li class="sous-menu"><a class="btn-drop"
                                                         href="index.php?controller=Facture&action=trierFacturesNumPucesDecroissants">Décroissant</a>
                                </li>
                                <div>Ou</div>
                                <form method="post" name="" action="index.php">
                                    <fieldset>
                                        <li><span class="inputItem">Numero Puce</span>
                                            <input class="inputField" id="numPuce" name="numPuce"
                                                   type="text" required></li>
                                    </fieldset>
                                    <div class="input" id="send">
                                        <input type="submit" value="Envoyer">
                                        <input type='hidden' name='controller'
                                               value='Facture'>
                                        <input type='hidden' name='action' value='trouverFacturesNumPuces'>
                                    </div>
                                </form>
                            </ul>
                        </li>
                    </nav>
                </div>



        <?php
        if ($frais == NULL) {
            echo "<div>Aucune facture n'est disponible</div>";
        } else {
            foreach ($frais as $f) {
                echo '<h3 class="container text-center">' . htmlspecialchars($f->getNumFacture()) . '</h3><div class="row description">';
                echo '<ul><li> Type : ' . htmlspecialchars($f->getType()) . '</li> ';
                echo '<li> Motif : ' . htmlspecialchars($f->getMotif()) . '</li>';
                echo '<li> Cout : ' . htmlspecialchars($f->getCout()) . ' euros </li>';
                echo '<li> Date : ' . htmlspecialchars($f->getDateFacture()) . '</li>';
                echo '<li> Crediteur : ' . htmlspecialchars($f->getCrediteur()) . '</li></ul>';
                ?>
                <form method="post" name="" action="index.php">
                    <div class="input" id="send">
                        <input type="submit" value="Ouvrir">
                        <?php echo '<input type="hidden" name="name" value="' . htmlspecialchars($f->getNumFacture()) . '-' . htmlspecialchars($f->getCrediteur()) . '.pdf">' ?>
                        <input type='hidden' name='action' value='ouvrirPDF'>
                    </div>
                </form>

                <?php

                if ($_SESSION['isAdmin'] == 1) {
                    echo '<p><a href="index.php?controller=Facture&action=modificationFormulaire&numFacture=' . rawurlencode($f->getNumFacture()) . '&crediteur=' . rawurlencode($f->getCrediteur()) . '"> Modifier la facture </a></p>';
                    echo '<p><a href="index.php?controller=Facture&action=supprimerFacture&numFacture=' . rawurlencode($f->getNumFacture()) . '&crediteur=' . rawurlencode($f->getCrediteur()) . '"> Supprimer la facture </a></p>';
                }
                if (isset($data[$f->getIdFacture()])) {
                    echo '<p><a href="index.php?controller=Facture&action=veterinaire&idVeto=' . rawurlencode($data[$f->getIdFacture()]) . '"> Voir les coordonnées du vétérinaire</a></p>';
                }

            }
        }

        ?>
        </article>

    </div>
    </div>

</main>
