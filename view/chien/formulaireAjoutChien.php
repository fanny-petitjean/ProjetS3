<head>
    <link href="css/Contact.css" rel="stylesheet" type="text/css">
</head>
<main>
    <div class="container-fluid red">
        <div class="container text-center">
            <h2> Ajouter un chien </h2>

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

                    <form enctype="multipart/form-data" class="centrer" action="index.php" method="post">
                        <fieldset>
                            <div class="input">
                                <span class="inputItem"> Numero de Puce*</span>
                                <input class="inputField" id="numPuce" name="numPuce" required type="text">
                            </div>
                            <div class="input">
                                <span class="inputItem">Nom du chien *</span>
                                <input class="inputField" id="nomChien" name="nomChien" required type="text">
                            </div>
                            <div class="input">
                                <span class="inputItem">Race *</span>
                                <input class="inputField" id="race" name="race" required type="text">
                            </div>
                            <div class="input">
                                <span class="inputItem">Date de Naissance : *</span>
                                <input class="inputField" id="dateNaissance" name="dateNaissance"
                                       required type="date">
                            </div>
                            <div class="input">
                                <span class="inputItem"> Sexe *</span>
                                <select class="inputField" id="sexe" name="sexe">
                                    <option value="femelle">Femelle</option>
                                    <option selected value="male">Male</option>
                                    <option value="inconne">inconnu</option>

                                </select>

                            </div>
                            <div class="input">
                                <span class="inputItem">Robe *</span>
                                <input class="inputField" id="robe" name="robe" required type="text">
                            </div>
                            <div class="input">
                                <span class="inputItem"> Sterelisation *</span>
                                <select class="inputField" id="sterilisation" name="sterilisation">
                                    <option value="oui">Oui</option>
                                    <option selected value="non">Non</option>
                                    <option value="inconnu">Ne sait pas</option>

                                </select>
                            </div>

                            <div class="input">
                                <span class="inputItem">Date d'accueil :  *</span>
                                <input class="inputField" id="dateAccueil" name="dateAccueil"  type="date" required>
                            </div>
                            <div class="input">
                                <span class="inputItem">Nom de l'ancien Proprietaire *</span>
                                <input class="inputField" id="nomAncienProp" name="nomAncienProp" type="text" required>
                            </div>
                            <p> Si vous ne connaissez pas le nom de l'ancien propriétaire, entrez 'Inconnu'</p>
                            <div class="input">
                                <span class="inputItem">Description de l'animal *</span>
                                <textarea class="inputField" placeholder="description de 500 caractères"
                                          name="description" required></textarea>
                            </div>

                            <div class="input">
                                <span class="inputItem">Ajouter une photo *</span>
                                <input type="hidden" name="MAX_FILE_SIZE" value="10000000000000"/>
                                <input type="file" class="inputField" accept='pdf' id='photo' name='photo'
                                       required>
                            </div>

                            <p>Le fichier doit être une photo en .png, .jpeg ou .jpg dont le nom est sous la forme :
                                numeroPuce <br>
                                Si le nom n'est pas comme demandé, il ne sera pas accepté</p>
                        </fieldset>
                        <div class="input" id="send">
                            <input class="inputField" type="submit" value="Envoyer"/>
                            <input type='hidden' name='controller' value='Chien'>
                             <?php
                                if ($_SESSION['isAdmin'] == 1) {
                            ?>
                            <input type='hidden' name='action' value='ajouterChien'>
                        <?php }else{?>
                            <input type='hidden' name='action' value='attenteValidation'>
                        <?php }?>

                        </div>
                    </form>
                </article>

            </div>
        </div>
    </div>

</main>
