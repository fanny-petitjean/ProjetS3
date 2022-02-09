<?php
require_once(File::build_path(array("model", "ModelChien.php")));
require_once(File::build_path(array("model", "ModelFacture.php")));
require_once(File::build_path(array("model", "ModelVeto.php")));
require_once(File::build_path(array("model", "ModelFactureVeto.php")));


class ControllerFacture
{
    public static function veterinaire()
    {
        if (isset($_SESSION['login'])) {

            $veto = ModelVeto::getVeterinaireById($_GET['idVeto']);
            $view = 'veterinaire';
            $pagetitle = 'veterinaire';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function Facture()
    {
        if (isset($_SESSION['login'])) {

            $frais = ModelFacture::getAllFacture();
            $veto = ModelFactureVeto::getAllFactures();
            foreach ($veto as $v) {
                $data[$v->getIdFacture()] = $v->getIdVeto();
            }
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function ajouterFacture()
    {
        if (isset($_SESSION['login'])) {

            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {
                $data = array(
                    'numPuce' => $_POST['numPuce'],
                    'numFacture' => $_POST['numFacture'],
                    'type' => $_POST['type'],
                    'motif' => $_POST['motif'],
                    'cout' => $_POST['cout'],
                    'dateFacture' => $_POST['dateFacture'],
                    'crediteur' => $_POST['crediteur'],
                );
                if($_POST['type']=='veterinaire'){
                     if ($_POST['idVeto']!="autre") {
                    $factureVeto['idVeto'] = $_POST['idVeto'];
                    $infosFacture = array(
                        'numFacture' => $_POST['numFacture'],
                        'crediteur' => $_POST['crediteur'],
                    );
                    }

                  if ($_POST['nomVeto'] != '') {
                    $infosVeto = array(
                        'nomVeto' => $_POST['nomVeto'],
                        'numVeto' => $_POST['numVeto'],
                        'adresseVeto' => $_POST['adresseVeto'],
                        'codePostalVeto' => $_POST['codePostalVeto'],
                        'villeVeto' => $_POST['villeVeto'],
                        'paysVeto' => $_POST['paysVeto'],
                    );
                    ModelVeto::ajouterVeto($infosVeto);
                    $infos = array(
                        'nomVeto' => $_POST['nomVeto'],
                        'numTelephoneVeto' => $_POST['numVeto'],
                    );
                    $veto = ModelVeto::getVeterinaireByNom($infos);
                    $factureVeto['idVeto'] = $veto->getIdVeto();
                    $infosFacture = array(
                        'numFacture' => $_POST['numFacture'],
                        'crediteur' => $_POST['crediteur'],
                    );
                    }   
                }

               
               

                $erreur = 'null';
                $name = $data['numFacture'] . "-" . $data["crediteur"] . '.pdf';
                if (strcmp($_FILES['description']['name'], $name) != 0) {
                    $erreur = ' Le nom de la Facture est faux.';

                }
                if ($_FILES['description']['error'] > 0) $erreur = "Erreur lors du transfert";
                if ($_FILES['description']['size'] > 1000000) $erreur = "Le fichier est trop gros";
                $extensions_valides = array('pdf');
                $extension_upload = strtolower(substr(strrchr($_FILES['description']['name'], '.'), 1));
                $nom = File::build_path(array("pdf", $_FILES['description']['name']));
                $resultat = move_uploaded_file($_FILES['description']['tmp_name'], $nom);

                if (strcmp($erreur, 'null') != 0) {
                    $view = 'ErreurFacture';
                    $controller = 'facture';
                    $pagetitle = 'Erreur Factures';
                    require(File::build_path(array("view", "view.php")));
                } else {
                    if($_POST['numPuce']=='autre'){
                        $data2 = array(
                            'numFacture' => $_POST['numFacture'],
                            'type' => $_POST['type'],
                            'motif' => $_POST['motif'],
                            'cout' => $_POST['cout'],
                            'dateFacture' => $_POST['dateFacture'],
                            'crediteur' => $_POST['crediteur'],
                          );

                        $f =ModelFacture::ajouterFacture2($data2);

                    }else{
                        $f= ModelFacture::ajouterFacture($data);
                    }
                    if ( $f== false || $resultat == false) {
                        $erreur = "une des dates n'est pas dans le bon format";

                        if (!$resultat) {
                            $info = array(
                                "numFacture" => $_POST['numFacture'],
                                "crediteur" => $_POST['crediteur']
                            );
                            ModelFacture::supprimerFacture($info);
                            $erreur = 'Le déplacement des fichiers a connu une erreur';
                        } else {
                            unlink($nom);
                        }
                        $view = 'AjoutFactureNonReussi';
                        $controller = 'facture';
                        $pagetitle = 'Facture Non Ajoutée';
                        require(File::build_path(array("view", "view.php")));
                    } else {
                        if (isset($factureVeto)) {
                            $f = ModelFacture::getFactureByNumFacture($infosFacture);
                            $factureVeto['idFacture'] = $f->getIdFacture();
                            ModelFactureVeto::ajouterFacture($factureVeto);
                        }
                        $message = 'enregistrée';
                        $titre = 'Ajouter Facture';
                        $controller = 'facture';
                        $view = 'AjoutFactureReussi';
                        $pagetitle = 'Facture Ajouté';
                        require(File::build_path(array("view", "view.php")));
                    }
                }
            } else {
                $view = 'accueil';
                $pagetitle = 'Page Accueil';
                require(File::build_path(array("view", "view.php")));
            }
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function formulaireFacture()
    {
        if (isset($_SESSION['login'])) {

            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {

                if (isset($_GET['numPuce'])) {
                    $chien = ModelChien::getChienByNumPuce($_GET['numPuce']);
                } else {
                    $chiens = ModelChien::getAllChiens();

                }
                $veto = ModelVeto::getAllVeto();

                $view = 'formulaireAjoutFacture';
                $controller = 'facture';
                $pagetitle = 'formulaire Facture';
                require(File::build_path(array("view", "view.php")));
            } else {
                $view = 'accueil';
                $pagetitle = 'Page Accueil';
                require(File::build_path(array("view", "view.php")));
            }
        } else {
            ControllerUtilisateur::deconnexion();
        }


    }

    public static function modificationFormulaire()
    {
        if (isset($_SESSION['login'])) {

            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {

                $info = array(
                    "numFacture" => $_GET['numFacture'],
                    "crediteur" => $_GET['crediteur']
                );
                $facture = ModelFacture::getFactureByNumFacture($info);
                $chiens = ModelChien::getAllChiens();
                $view = 'modificationFacture';
                $controller = 'facture';
                $pagetitle = 'Modification Facture';
                require(File::build_path(array("view", "view.php")));

            } else {
                $view = 'accueil';
                $pagetitle = 'Page Accueil';
                require(File::build_path(array("view", "view.php")));
            }
        } else {
            ControllerUtilisateur::deconnexion();
        }


    }

    public static function modifierFacture()
    {
        if (isset($_SESSION['login'])) {

            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {

                $infos = array(
                    'numPuce' => $_POST['numPuce'],
                    'numFacture' => $_POST['numFacture'],
                    'type' => $_POST['type'],
                    'motif' => $_POST['motif'],
                    'cout' => $_POST['cout'],
                    'dateFacture' => $_POST['dateFacture'],
                    'crediteur' => $_POST['crediteur'],
                );
                ModelFacture::modifierFacture($infos);
                $message = 'modifiée';
                $titre = "Modifier Facture";
                $view = 'AjoutFactureReussi';
                $controller = 'facture';
                $pagetitle = 'Modifier Factures';
                require(File::build_path(array("view", "view.php")));
            } else {
                $view = 'accueil';
                $pagetitle = 'Page Accueil';
                require(File::build_path(array("view", "view.php")));
            }
        } else {
            ControllerUtilisateur::deconnexion();
        }


    }

    public static function supprimerFacture()
    {
        if (isset($_SESSION['login'])) {

            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {

                $info = array(
                    "numFacture" => $_GET['numFacture'],
                    "crediteur" => $_GET['crediteur']
                );
                ModelFacture::supprimerFacture($info);
                $nom = File::build_path(array("pdf", $info['numFacture'] . '-' . $info['crediteur'] . '.pdf'));
                unlink($nom);
                $message = 'supprimée';
                $titre = "Supprimer Facture";
                $controller = 'facture';
                $view = 'AjoutFactureReussi';
                $pagetitle = 'Supprimer Facture';
                require(File::build_path(array("view", "view.php")));
            } else {
                $view = 'accueil';
                $pagetitle = 'Page Accueil';
                require(File::build_path(array("view", "view.php")));
            }
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function totaliserFactures()
    {
        if (isset($_SESSION['login'])) {

            $couts = ModelFacture::totaliserFactures();
            $view = 'totalFactures';
            $controller = 'facture';
            $pagetitle = 'Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function totaliserFacturesNumPuces()
    {
        if (isset($_SESSION['login'])) {

            $couts = ModelFacture::totaliserFacturesNumPuces();
            $view = 'totalFactures';
            $pagetitle = 'Factures';
            $controller = 'facture';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function totaliserFacturesRaces()
    {
        if (isset($_SESSION['login'])) {

            $couts = ModelFacture::totaliserFacturesRaces();
            $view = 'totalFactures';
            $pagetitle = 'Factures';
            $controller = 'facture';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function totaliserFacturesTypes()
    {
        if (isset($_SESSION['login'])) {

            $couts = ModelFacture::totaliserFacturesTypes();
            $view = 'totalFactures';
            $controller = 'facture';
            $pagetitle = 'Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }


    public static function totaliserFacturesMotifs()
    {
        if (isset($_SESSION['login'])) {

            $couts = ModelFacture::totaliserFacturesMotifs();
            $view = 'totalFactures';
            $controller = 'facture';
            $pagetitle = 'Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function totaliserFacturesCrediteurs()
    {
        if (isset($_SESSION['login'])) {

            $couts = ModelFacture::totaliserFacturesCrediteurs();
            $view = 'totalFactures';
            $pagetitle = 'Factures';
            $controller = 'facture';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }


    public static function total()
    {
        if (isset($_SESSION['login'])) {

            $couts = ModelFacture::totaliserFactures();
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    //Methode pour trier les factures selon numero, numero de puce, type, motif, cout, date, getCrediteur
    // dans l'ordre croissant et Decroissants
    public static function trierFacturesNums()
    {
        if (isset($_SESSION['login'])) {

            $frais = ModelFacture::getAllFacturesNums();
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function trierFacturesNumsDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $frais = ModelFacture::getAllFacturesNumsDecroissants();
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }


    public static function trouverFacture()
    {
        if (isset($_SESSION['login'])) {


            $num = $_POST['numFacture'];
            $frais = ModelFacture::getFacture($num);
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierFacturesNumPuces()
    {
        if (isset($_SESSION['login'])) {

            $frais = ModelFacture::getAllFacturesNumPuces();
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function trierFacturesNumPucesDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $frais = ModelFacture::getAllFacturesNumPucesDecroissants();
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function trouverFacturesNumPuces()
    {
        if (isset($_SESSION['login'])) {

            $num = $_POST['numPuce'];
            $frais = ModelFacture::getFacturesNumPuces($num);
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierFacturesTypes()
    {
        if (isset($_SESSION['login'])) {

            $types = $_GET['type'];
            $frais = ModelFacture::getAllFacturesTypes($types);
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }


    public static function trierFacturesMotifs()
    {
        if (isset($_SESSION['login'])) {

            $frais = ModelFacture::getAllFacturesMotifs();
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function trierFacturesMotifsDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $frais = ModelFacture::getAllFacturesMotifsDecroissants();
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function trierFacturesCouts()
    {
        if (isset($_SESSION['login'])) {

            $frais = ModelFacture::getAllFacturesCouts();
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function trierFacturesCoutsDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $frais = ModelFacture::getAllFacturesCoutsDecroissants();
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }


    public static function trouverFacturesCouts()
    {
        if (isset($_SESSION['login'])) {

            $couts = array(
                'min' => $_POST['min'],
                'max' => $_POST['max']
            );
            $frais = ModelFacture::getFacturesCouts($couts);
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function trierFacturesDateFactures()
    {
        if (isset($_SESSION['login'])) {

            $data = array(
                'min' => $_POST['datemin'],
                'max' => $_POST['datemax']
            );
            $frais = ModelFacture::getAllFacturesDateFactures($data);
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }


    public static function trierFacturesCrediteurs()
    {
        if (isset($_SESSION['login'])) {

            $frais = ModelFacture::getAllFacturesCrediteurs();
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function trierFacturesCrediteursDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $frais = ModelFacture::getAllFacturesCrediteursDecroisants();
            $view = 'Facture';
            $controller = 'facture';
            $pagetitle = 'Les Factures';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }


}