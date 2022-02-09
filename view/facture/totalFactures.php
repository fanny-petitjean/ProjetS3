<head>
    <link href="css/totalFactures.css" rel="stylesheet" type="text/css">
</head>

<main>

   <div class="main-body">
        <div class="texte-centrer">
            <h3> Calculer le total des Factures</h3>

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
                        <a class="btn-simple" href="index.php?controller=Facture&action=trierFacturesNums">En fonction de</a>
                        <li class="menu-déroulant">
                            <a class="menu-déroulant" role="button"
                               href="index.php?controller=Facture&action=totaliserFactures">Total</a>
                        </li>
                        <li class="menu-déroulant">
                            <a class="menu-déroulant" role="button"
                               href="index.php?controller=Facture&action=totaliserFacturesNumPuces">Numero de Puce</a>
                        </li>
                        <li class="menu-déroulant">
                            <a class="menu-déroulant" role="button"
                               href="index.php?controller=Facture&action=totaliserFacturesRaces">Race</a>
                        </li>
                        <li class="menu-déroulant">
                            <a class="menu-déroulant" role="button"
                               href="index.php?controller=Facture&action=totaliserFacturesTypes">Types</a>
                        </li>
                           <li class="menu-déroulant">
                            <a class="menu-déroulant" role="button"
                               href="index.php?controller=Facture&action=totaliserFacturesMotifs">Motifs</a>
                        </li>
                           <li class="menu-déroulant">
                            <a class="menu-déroulant" role="button"
                               href="index.php?controller=Facture&action=totaliserFacturesCrediteurs">Crediteurs</a>
                        </li>

                            
                    </nav>
                </div>

                    <div class="total">
                        <p> Totalisateur des Factures : </p>


                        <?php
                        if ($_GET['action'] == 'totaliserFactures') {
                            echo '<p>Le cout total de l\'ensemble des Factures est de : ' . $couts . ' euros </p>';
                        } else {
                            echo "<ul >";
                            foreach ($couts as $v) {
                                echo '<li> <p><span class="texte"> ' . htmlspecialchars($v['bd']) . '</span> :  ' . htmlspecialchars($v['cout']) . ' euros </p></li>';
                            }
                            echo '</ul>';
                        }
                        ?>
                    </div>
                </article>
            </div>
        </div>

</main>