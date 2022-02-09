<head>
    <link href="css/Adopter.css" rel="stylesheet" type="text/css">
</head>

<main>
            <h2> A ADOPTER</h2>
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
                                <a class="menu-déroulant" role="button" href="index.php?controller=Chien&action=trierNonAdoptesNoms">Nom</a>
                                <ul class="sous-menu">
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesNoms">A-Z</a></li>
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesNomsDecroissants">Z-A</a>
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
                                        <input type="submit" value="trier">
                                        <input type='hidden' name='controller'
                                               value='Chien'>
                                        <input type='hidden' name='action' value='trouverChiensNoms'>
                                    </div>
                                    </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-déroulant">
                                <a class="menu-déroulant" href="index.php?controller=Chien&action=trierNonAdoptesNumPuces" role="button">Numero Puce</a>
                                <ul class="sous-menu">
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesNumPuces">Croissant</a>
                                    </li>
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesNumPucesDecroissants">Decroissant</a>
                                    </li>
                                    <div>Ou</div>
                                    <form method="post" name="" action="index.php">
                                        <fieldset>
                                            <li><span class="inputItem">Numero Puce</span>
                                                <input class="inputField" id="numPuce" name="numPuce"
                                                       type="text" required></li>
                                        </fieldset>
                                        <div class="input" id="send">
                                            <input type="submit" value="trier">
                                            <input type='hidden' name='controller'
                                                   value='Chien'>
                                            <input type='hidden' name='action' value='trouverChiensNumPuces'>
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="menu-déroulant">
                                <a class="menu-déroulant" href="index.php?controller=Chien&action=trierNonAdoptesRaces" role="button">Race</a>
                                <ul class="sous-menu">
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesRaces">A-Z</a></li>
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesRacesDecroissants">Z-A</a>
                                    </li>
                                    <div>Ou</div>
                                    <form method="post" name="" action="index.php">
                                        <fieldset>
                                            <li><span class="inputItem">Race</span>
                                                <input class="inputField" id="race" name="race" type="text"
                                                       required></li>
                                        </fieldset>
                                        <div class="input" id="send">
                                            <input type="submit" value="trier">
                                            <input type='hidden' name='controller'
                                                   value='Chien'>
                                            <input type='hidden' name='action' value='trouverChiensRaces'>
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="menu-déroulant">
                                <a class="menu-déroulant" href="index.php?controller=Chien&action=trierNonAdoptesDateNaissances" role="button">Date Naissance</a>
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
                                            <input type="submit" value="trier">
                                            <input type='hidden' name='controller'
                                                   value='Chien'>
                                            <input type='hidden' name='action'
                                                   value='trierNonAdoptesDateNaissances'>
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="menu-déroulant">
                                <a class="menu-déroulant" href="index.php?controller=Chien&action=trierNonAdoptesSexes" role="button">Sexe</a>
                                <ul class="sous-menu">
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesSexes&sexe=femelle">Femelle</a>
                                    </li>
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesSexes&sexe=male">Male</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-déroulant">
                                <a class="menu-déroulant" href="index.php?controller=Chien&action=trierNonAdoptesRobes" role="button">Robe</a>
                                <ul class="sous-menu">
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesRobes">A-Z</a></li>
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesRobesDecroissants">Z-A</a>
                                    </li>
                                    <div>Ou</div>
                                    <form method="post" name="" action="index.php">
                                        <fieldset>
                                            <li><span class="inputItem">Robe</span>
                                                <input class="inputField" id="robe" name="robe" type="text"
                                                       required></li>
                                        </fieldset>
                                        <div class="input" id="send">
                                            <input type="submit" value="trier">
                                            <input type='hidden' name='controller'
                                                   value='Chien'>
                                            <input type='hidden' name='action' value='trouverChiensRobes'>
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="menu-déroulant">
                                <a class="menu-déroulant" href="index.php?controller=Chien&action=trierNonAdoptesSterilisations" role="button">Sterelisation</a>
                                <ul class="sous-menu">
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesSterilisations&avis=oui">Oui</a>
                                    </li>
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesSterilisations&avis=non">Non</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-déroulant">
                                <a class="menu-déroulant" href="index.php?controller=Chien&action=trierNonAdoptesDateAccueils" role="button">Date Accueil</a>
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
                                            <input type="submit" value="trier">
                                            <input type='hidden' name='controller'
                                                   value='Chien'>
                                            <input type='hidden' name='action'
                                                   value='trierNonAdoptesDateAccueils'>
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="menu-déroulant">
                                <a class= "menu-déroulant" href="index.php?controller=Chien&action=trierNonAdoptesNomAncienProprio" role="button" data-bs-toggle="dropdown">Nom Ancien Proprietaire</a>
                                <ul class="sous-menu">
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesNomAncienProprio">A-Z</a>
                                    </li>
                                    <li class="sous-menu"><a class="btn-drop" href="index.php?controller=Chien&action=trierNonAdoptesNomAncienProprioDecroissant">Z-A</a>
                                    </li>
                                    <div>Ou</div>
                                    <form method="post" name="" action="index.php">
                                        <fieldset>
                                            <li><span class="inputItem">Nom </span>
                                                <input class="inputField" id="nomAncienProp"
                                                       name="nomAncienProp" type="text" required></li>
                                        </fieldset>
                                        <div class="input" id="send">
                                            <input type="submit" value="trier">
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
                    <div>

                        <?php
                        if ($chien == NULL) {
                            echo "<div>Aucun protégé n'existe</div>";
                        } else {
                            foreach ($chien as $c) {


                                echo '<div class="row justify-content-center"><h3 class="text-center">' . htmlspecialchars($c->getNomchien()) . ' : ' . htmlspecialchars($c->getNumPuce()) . '</h3>';
                                echo '<div class="col-4"><img class="photoChien" src="image/chien/' . htmlspecialchars($c->getNomPhoto()) . '" alt="' . htmlspecialchars($c->getNomPhoto()) . '"></div>';
                                echo '<div  class="row justify-content-start"> <div class="col-4"><p> Race : ' . $c->getRace() . '</p><p> Robe : ' . $c->getRobe() . '</p></div>';
                                echo '<div class="col-4"><p> Date de Naissance  : ' . $c->getDateNaissance() . '</p><p> Date début accueil : ' . $c->getDateAccueil() . '</p></div>';
                                echo '<div class="col-4"><p> Sexe  : ' . $c->getSexe() . '</p><p> Sterelisation : ' . $c->getSterilisation() . '</p></div>';
                                echo '<div><p>' . $c->getDescription() . '</p></div></div>';
                                ?>
                                <form action="index.php" method="post">
                                    <div class="input" id="send">
                                        <input type="submit" name="submit" value="Adoption">
                                        <input type="hidden" name="action" value="formulaireAdoptionChien">
                                        <input type="hidden" name="controller" value="chien">
                                        <input type="hidden" name="numPuce"
                                               value="<?php echo htmlspecialchars($c->getNumPuce()) ?>">
                                    </div>
                                </form>

                                <?php
                                if(!isset($data[$c->getNumPuce()])){
                                    echo '<p><a href="index.php?controller=Famille&action=formulaireFamilleAccueil&numPuce=' . rawurlencode($c->getNumPuce()) . '"> Accueillir le chien </a></p>';
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
