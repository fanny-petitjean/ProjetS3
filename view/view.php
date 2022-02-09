<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php echo $pagetitle; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="css/commun.css" rel="stylesheet" type="text/css">
    <link href="css/accueil.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.rtl.css" type="text/css">
    <script type="text/javascript" src="js/bootstrap.bundle.js"></script>


</head>
<body>
<header>
    <div class="containerHead">
        <img class="head" src='image/headerNew.jpg' class="rounded mx-auto d-block" alt="...">
    </div>
    <div class="barre-menu">
            <nav class="menu">

                <!-- Example single danger button -->
                <a class="btn-simple" href="index.php?action=accueil" role="button">Accueil</a>
                <a class="btn-simple" href="index.php?controller=Chien&action=Adopter" role="button">A Adopter</a>
                <a class="btn-simple" href="index.php?controller=Chien&action=Protege" role="button">Les Protégés</a>
                <li class="menu-déroulant"><a class="menu-déroulant" href="#" role="button"> Frais ▼</a>
                    <ul class="sous-menu">
                        <li class="drop-menu"><a class="btn-drop" href="index.php?controller=Facture&action=Facture">Frais</a></li>
                        <li class="drop-menu"><a class="btn-drop" href="index.php?controller=Facture&action=totaliserFactures">Totalisateurs Factures</a></li>
                    </ul></li>
                <?php
                    if ($_SESSION['isAdmin'] == 1) {
                ?>
                <a class="btn-simple" href="index.php?controller=Chien&action=validation" role="button">Chien en Attente</a>
                 <?php
                   }
                ?>
                <a class="btn-simple" href="index.php?action=FAQ" role="button">FAQ</a>
                <a class="btn-simple" href="index.php?action=Contact" role="button">Contact</a>
                <a class="btn-simple" href="index.php?action=compte" role="button">Compte</a>
                <a class="btn-simple" href="index.php?action=deconnexion" role="button">Deconnexion</a>



</header>
<?php
if (isset($controller)) $filepath = File::build_path(array("view", $controller, "$view.php"));
else $filepath = File::build_path(array("view", "$view.php"));

require $filepath;
?>


<footer class="section footer-classic context-dark bg-image" style="background: #2d3246;">
    <div class="container">
        <div class="row row-30">
           <!-- <div class="col-md-4 col-xl-5">
                <div class="pr-xl-4"><a class="brand" href="index.html"><img class="brand-logo-light"
                                                                             src="images/agency/logo-inverse-140x37.png"
                                                                             alt="" width="140" height="37"
                                                                             srcset="images/agency/logo-retina-inverse-280x74.png 2x"></a>
                    <p>We are an award-winning creative agency, dedicated to the best result in web design, promotion,
                        business consulting, and marketing.</p>
                   
                    <p class="rights"><span>©  </span><span class="copyright-year">2020</span><span> </span><span>Company</span><span> - </span><span>All Rights Reserved.</span>
                    </p>
                </div>
            </div>-->
            <div class="footer-info">
            <div class="footer-col-1">
                <h5>Contacts</h5>
                <dl class="contact-list">
                    <dt>Numéro de Téléphone (en cas d'urgence):</dt>
                    <dd>+33 6 49 48 21 00
                    </dd>
                </dl>
            </div>
            <div class="footer-col-2">
                <h5>Links</h5>
                <ul>
                    <li><a href="index.php?controller=Chien&action=Adopter">- Adoption</a></li>
                    <li><a href="index.php?action=Contact">- Contacts</a></li>
                    <li><a href="index.php?action=FAQ">- FAQ</a></li>
                </ul>
            </div>
            </div>
        </div>
    </div>
    <div class="footer-social">
        <a class="social-inner" href="https://m.facebook.com/Bullsfriendsassociation?fref=ts"><img
                        src="image/fb.png" ))></a>
        <a class="social-inner" href="http://twitter.com/share?text=Bull%27s%20Friends%20Association&url=https%3A%2F%2Fwww.bullsfriends.com%2F"><img
                    src="image/twt.png" ))></a>
        <a class="social-inner" href="http://www.linkedin.com/shareArticle?mini=true&url=https://www.bullsfriends.com/&title=Bull%27s%20Friends%20Association"><img
                        src="image/lkdin.png" ))></a>
    </div>
</footer>


</body>
</html>
