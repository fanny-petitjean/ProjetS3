<head>
    <link href="css/Protege.css" rel="stylesheet" type="text/css">
</head>
<main>
    <div class="main-body">
        <div class="texte-centrer">
            <h2> Les protégés</h2>

        </div>
        <div class="articles">
                <article class="col-1">
                    <div>
                        <p>Cliquez sur le bouton ci-dessous pour ajouter un Protégé: </p>
                        <button class="btn left" type="button"
                                onclick="location.href = 'index.php?controller=Chien&action=formulaireChien';">Ajouter
                            un Protégé
                        </button>
                    </div>

                </article>
                <article class="col-2">
                    <div class="barre-menu" id="filtres">
                    <nav class="menu">
                            <a class="btn-simple" href="#">Trier par</a>
                                    <li class="menu-déroulant">
                                        <a class="menu-déroulant" role="button" href="index.php?controller=Chien&action=trierNoms">Nom</a>
                                        <ul class="sous-menu">
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNoms">A-Z</a></li>
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNomsDecroissants">Z-A</a>
                                            </li>
                                            <div>Ou</div>
                                            <li class="sous-menu">
                                            <form method="post" name="" action="index.php">
                                                <fieldset>
                                                    <li><span class="inputItem">Nom</span>
                                                        <input class="inputField" id="nomChien" name="nomChien"
                                                               type="text" required></li>
                                                </fieldset>
                                                <div class="input" id="send">
                                                    <input type="submit" value="Trier">
                                                    <input type='hidden' name='controller'
                                                           value='Chien'>
                                                    <input type='hidden' name='action' value='trouverChiensNoms'>
                                                </div>
                                            </form>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-déroulant">
                                        <a class="menu-déroulant" href="index.php?controller=Chien&action=trierNumPuces" role="button">Numero Puce</a>
                                        <ul class="sous-menu">
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNumPuces">Croissant</a>
                                            </li>
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNumPucesDecroissants">Decroissant</a>
                                            </li>
                                            <div>Ou</div>
                                            <form method="post" name="" action="index.php">
                                                <fieldset>
                                                    <li><span class="inputItem">Numero Puce</span>
                                                        <input class="inputField" id="numPuce" name="numPuce"
                                                               type="text" required></li>
                                                </fieldset>
                                                <div class="input" id="send">
                                                    <input type="submit" value="Trier">
                                                    <input type='hidden' name='controller'
                                                           value='Chien'>
                                                    <input type='hidden' name='action' value='trouverChiensNumPuces'>
                                                </div>
                                            </form>
                                        </ul>
                                    </li>
                                    <li class="menu-déroulant">
                                        <a class="menu-déroulant" href="index.php?controller=Chien&action=trierRaces" role="button">Race</a>
                                        <ul class="sous-menu">
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierRaces">A-Z</a></li>
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierRacesDecroissants">Z-A</a>
                                            </li>
                                            <div>Ou</div>
                                            <form method="post" name="" action="index.php">
                                                <fieldset>
                                                    <li><span class="inputItem">Race</span>
                                                        <input class="inputField" id="race" name="race" type="text"
                                                               required></li>
                                                </fieldset>
                                                <div class="input" id="send">
                                                    <input type="submit" value="Trier">
                                                    <input type='hidden' name='controller'
                                                           value='Chien'>
                                                    <input type='hidden' name='action' value='trouverChiensRaces'>
                                                </div>
                                            </form>
                                        </ul>
                                    </li>
                                    <li class="menu-déroulant">
                                        <a class="menu-déroulant" href="index.php?controller=Chien&action=trierDateNaissances" role="button">Date Naissance</a>
                                        <ul class="sous-menu">
                                            <form method="post" name="" action="index.php">
                                                <fieldset>
                                                    <li><span class="inputItem">Date min</span>
                                                        <input class="inputField" id="datemin" name="datemin"
                                                               type="date" required>
                                                    </li>
                                                    <li><span class="inputItem">Date max</span>
                                                        <input class="inputField" id="datemax" name="datemax"
                                                               type="date"  required></li>

                                                </fieldset>
                                                <div class="input" id="send">
                                                    <input type="submit" value="Trier">
                                                    <input type='hidden' name='controller'
                                                           value='Chien'>
                                                    <input type='hidden' name='action'
                                                           value='trierDateNaissances'>
                                                </div>
                                            </form>
                                        </ul>
                                    </li>
                                    <li class="menu-déroulant">
                                        <a class="menu-déroulant" href="index.php?controller=Chien&action=trierSexes" role="button">Sexe</a>
                                        <ul class="sous-menu">
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierSexes&sexe=femelle">Femelle</a>
                                            </li>
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierSexes&sexe=male">Male</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-déroulant">
                                        <a class="menu-déroulant" href="index.php?controller=Chien&action=trierRobes" role="button">Robe</a>
                                        <ul class="sous-menu">
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierRobes">A-Z</a></li>
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierRobesDecroissants">Z-A</a>
                                            </li>
                                            <div>Ou</div>
                                            <form method="post" name="" action="index.php">
                                                <fieldset>
                                                    <li><span class="inputItem">Robe</span>
                                                        <input class="inputField" id="robe" name="robe" type="text"
                                                               required></li>
                                                </fieldset>
                                                <div class="input" id="send">
                                                    <input type="submit" value="Trier">
                                                    <input type='hidden' name='controller'
                                                           value='Chien'>
                                                    <input type='hidden' name='action' value='trouverChiensRobes'>
                                                </div>
                                            </form>
                                        </ul>
                                    </li>
                                    <li class="menu-déroulant">
                                        <a class="menu-déroulant" href="index.php?controller=Chien&action=trierSterilisations" role="button">Sterelisation</a>
                                        <ul class="sous-menu">
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierSterilisations&avis=oui">Oui</a>
                                            </li>
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierSterilisations&avis=non">Non</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-déroulant">
                                        <a class="menu-déroulant" href="index.php?controller=Chien&action=trierDateAccueils" role="button">Date Accueil</a>
                                        <ul class="sous-menu">
                                            <form method="post" name="" action="index.php">
                                                <fieldset>
                                                    <li><span class="inputItem">Date min</span>
                                                        <input class="inputField" id="datemin" name="datemin"
                                                               type="date"  required>
                                                    </li>
                                                    <li><span class="inputItem">Date max</span>
                                                        <input class="inputField" id="datemax" name="datemax"
                                                               type="date" required></li>

                                                </fieldset>
                                                <div class="input" id="send">
                                                    <input type="submit" value="Trier">
                                                    <input type='hidden' name='controller'
                                                           value='Chien'>
                                                    <input type='hidden' name='action'
                                                           value='trierDateAccueils'>
                                                </div>
                                            </form>
                                        </ul>
                                    </li>
                                    <li class="menu-déroulant">
                                        <a class= "menu-déroulant" href="index.php?controller=Chien&action=trierNomAncienProprio" role="button" data-bs-toggle="dropdown">Nom Ancien Proprietaire</a>
                                        <ul class="sous-menu">
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNomAncienProprio">A-Z</a>
                                            </li>
                                            <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNomAncienProprioDecroissant">Z-A</a>
                                            </li>
                                            <div>Ou</div>
                                            <form method="post" name="" action="index.php">
                                                <fieldset>
                                                    <li><span class="inputItem">Nom </span>
                                                        <input class="inputField" id="nomAncienProp"
                                                               name="nomAncienProp" type="text" required></li>
                                                </fieldset>
                                                <div class="input" id="send">
                                                    <input type="submit" value="Trier">
                                                    <input type='hidden' name='controller'
                                                           value='Chien'>
                                                    <input type='hidden' name='action'
                                                           value='trouverChiensAncienProprios'>
                                                </div>
                                            </form>
                                        </ul>
                                    </li>
                    </nav>
                    </div>
                    <div class="container">

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

                                if ($_SESSION['isAdmin'] == 1) {
                                    echo '<p><a href="index.php?controller=Chien&action=modificationFormulaire&numPuce=' . rawurlencode($c->getNumPuce()) . '"> Modifier le Chien </a></p>';
                                    echo '<p><a href="index.php?controller=Chien&action=supprimerChien&numPuce=' . rawurlencode($c->getNumPuce()) . '"> Supprimer le Chien </a></p>';
                                    echo '<p><a href="index.php?controller=Facture&action=formulaireFacture&numPuce=' . rawurlencode($c->getNumPuce()) . '"> Ajouter une facture </a></p>';
                                }                  
                                 
                                 
                             }
                             
                               

                        }
                        ?>
                    </div>

                </article>

            </div>
        </div>
    </div>

</main>
