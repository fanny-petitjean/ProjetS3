<?php require_once(File::build_path(array("lib", "ContactLib.php"))); ?>

<head>
    <link href="css/Contact.css" rel="stylesheet" type="text/css">
</head>
<main>
        <div class="container text-center">
            <h2> Contact</h2>
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
                    <?php echo $alert; ?>
                    <form class="centrer" action="index.php" method="post">
                        <fieldset>
                            <legend>Informations personnelles</legend>
                            <div class="input">
                                <span class="inputItem">Nom *</span>
                                <input class="inputField" id="surname" name="surname" required type="text">
                            </div>
                            <div class="input">
                                <span class="inputItem">Prénom *</span>
                                <input class="inputField" id="firstname" name="firstname" required type="text">
                            </div>
                            <div class="input">
                                <span class="inputItem">E-mail *</span>
                                <input class="inputField" id="email" name="email" placeholder="votremail@domaine.com"
                                       required
                                       tabindex="1" type="email">
                            </div>
                            <div class="input">
                                <span class="inputItem">Téléphone *</span>
                                <input class="inputField" id="telephone" name="telephone" pattern="[0-9]{10}" required
                                       type="text">
                            </div>
                            <div class="input">
                                <span class="inputItem">Pays *</span>
                                <select class="inputField" id="countryselect" name="pays">
                                    <option value="Belgique">Belgique</option>
                                    <option selected value="France">France</option>
                                </select>
                            </div>
                            <div class="input">
                                <span class="inputItem">Ville *</span>
                                <input class="inputField" id="ville" name="ville" required type="text">
                            </div>
                            <div class="input">
                                <span class="inputItem">Code postal *</span>
                                <input class="inputField" id="zip" name="zip" pattern="[0-9]{4-5}" required type="text">
                            </div>

                            <div class="input">
                                <span class="inputItem">Objet *</span>
                                <input class="inputField" id="objet" name="objet" required type="text">
                            </div>
                            <legend>Message *</legend>
                            <div class="input" id="inputMsg">
	                        <textarea class="inputField" cols="80" id="message" name="message"
                                      placeholder="Tapez votre message ici"
                                      required rows="10"></textarea>
                            </div>
                        </fieldset>
                        <div class="input" id="send">
                            <input class="inputField" type="submit" name="submit" value="Envoyer">
                        </div>
                        <input type='hidden' name='action' value='sendEmail'>

                    </form>
                </article>
    </div>
</main>

<script type="text/javascript">
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
