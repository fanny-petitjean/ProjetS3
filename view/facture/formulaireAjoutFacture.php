<head>
    <link href="css/Contact.css" rel="stylesheet" type="text/css">
</head>
<main>
    <div class="container-fluid red">
        <div class="container text-center">
            <h2> Ajouter une Facture </h2>

        </div>
        <div class="container-fluid blue">
            <div class="row">
                <article class="col-2">

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
                <article class="col-10">
                    <?php if (isset($chien)) { ?>
                        <div>
                            <p> La Facture que vous souhaitez ajouté est pour le chien
                                :<?php echo htmlspecialchars($chien->getNomChien()) ?>
                                ayant comme race <?php echo htmlspecialchars($chien->getRace()) ?> et comme numéro de
                                puce <?php echo htmlspecialchars($chien->getNumpuce());
                                echo '<div class="col-4"><img class="photoChien" src="image/chien/' . htmlspecialchars($chien->getNomPhoto()) . '" alt="' . htmlspecialchars($chien->getNomPhoto()) . '"></div>';
                                ?>

                        </div>
                    <?php } ?>

                    <form class="centrer" action="index.php" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <?php if (isset($chiens)) { ?>
                                <div class="input">
                                    <span class="inputItem">Numero de Puce de l'animal Concerné *</span>
                                    <select class="inputField" id="numPuce" name="numPuce">
                                        <option value="autre">Ne concerne pas un animal</option>
                                        <?php foreach ($chiens as $c) {
                                            echo '<option value="' . htmlspecialchars($c->getNumPuce()) . '">' . htmlspecialchars($c->getNumPuce()) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php } ?>
                            <div class="input">
                                <span class="inputItem">Numero de Facture *</span>
                                <input class="inputField" id="numFacture" name="numFacture" required type="text">
                            </div>
                            <div class="input">
                                <span class="inputItem"> Type de Facture *</span>
                                <select class="inputField" id="type" name="type">
                                    <option value="veterinaire">Vétérinaire</option>
                                    <option selected value="nourriture">Nourriture</option>
                                    <option value="kilometrique">Kilométrique</option>
                                    <option value="autre">Autres</option>
                                </select>

                            </div>
                            <div class="input">
                                <span class="inputItem">Motif *</span>
                                <input class="inputField" id="motif" name="motif" required type="text">
                            </div>
                            <div class="input">
                                <span class="inputItem">Cout *</span>
                                <input class="inputField" id="cout" name="cout" placeholder="00,00" required
                                       type="text">
                            </div>
                            <div class="input">
                                <span class="inputItem">Date Facture :*</span>
                                <input class="inputField" id="dateFacture" name="dateFacture" 
                                       required type="date">
                            </div>
                            <div class="input">
                                <span class="inputItem">Nom du Créditeur *</span>
                                <input class="inputField" id="crediteur" name="crediteur" required type="text">
                            </div>
                            <div>
                                <p> Si le créditeur est un vérérinaire, cliquez sur le bouton vétérinaire pour choisir
                                    le vétérinaire concerné. Si il n'existe pas, vous pouvez le créé en appyant sur le
                                    +</p></div>
                            <button onclick="functionVeto()">Veterinaire</button>
                            <div id="listeVeto">
                                <div class="input">
                                    <span class="inputItem">Veterinaire*</span>
                                    <select class="inputField" id="idVeto" name="idVeto">
                                        <option value="autre" selected>...</option>
                                        <?php foreach ($veto as $v) {
                                            echo '<option value="' . htmlspecialchars($v->getIdVeto()) . '">' . htmlspecialchars($v->getNomVeto()) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <button onclick="myFunction()">+</button>


                            <div id="myDIV">
                                <div class="input">
                                    <span class="inputItem">Nom Vétérinaire *</span>
                                    <input class="inputField" id="nomVeto" name="nomVeto" type="text">
                                </div>
                                <div class="input">
                                    <span class="inputItem">Numero Telephone *</span>
                                    <input class="inputField" id="numVeto" name="numVeto" pattern="[0-9]{10}" type="text">
                                </div>
                                <div class="input">
                                    <span class="inputItem">Adresse *</span>
                                    <input class="inputField" id="adresseVeto" name="adresseVeto" type="text">
                                </div>
                                <div class="input">
                                    <span class="inputItem">Code Postal  *</span>
                                    <input class="inputField" id="codePostalVeto" name="codePostalVeto" pattern="[0-9]{4,5}" type="text">
                                </div>
                                <div class="input">
                                    <span class="inputItem">Ville *</span>
                                    <input class="inputField" id="villeVeto" name="villeVeto" type="text">
                                </div>
                                <div class="input">
                                    <span class="inputItem">Pays *</span>
                                    <input class="inputField" id="paysVeto" name="paysVeto" type="text">
                                </div>

                            </div>
                            <script type="text/javascript">
                                function functionVeto() {
                                    var x = document.getElementById("listeVeto");
                                    if (x.style.display === "block") {
                                        x.style.display = "none";
                                    } else {
                                        x.style.display = "block";
                                    }

                                }

                                function myFunction() {
                                    var x = document.getElementById("myDIV");
                                    if (x.style.display === "block") {
                                        x.style.display = "none";
                                    } else {
                                        x.style.display = "block";
                                    }
                                }
                            </script>

                            <p>Le fichier doit être un pdf dont le nom est sous la forme :
                                numeroFacture-crediteur <br>
                                Si le nom n'est pas comme demandé, il ne sera pas accepté</p>
                            <div class="input">
                                <span class="inputItem">Ajouter un pdf *</span>
                                <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
                                <input type="file" accept='pdf' class="inputField" id="description" name="description"
                                       required>
                            </div>


                        </fieldset>
                        <div class="input" id="send">
                            <input type="submit" value="Envoyer">
                            <?php if (isset($chien)) { ?>
                                <input type='hidden' name='numPuce'
                                       value="<?php echo htmlspecialchars($chien->getNumPuce()) ?>">
                            <?php } ?>
                            <input type='hidden' name='controller' value='Facture'>
                            <input type='hidden' name='action' value='ajouterFacture'>
                        </div>
                    </form>
                </article>

            </div>
        </div>
    </div>

</main>
