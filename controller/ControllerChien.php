<?php
require_once(File::build_path(array("model", "ModelChien.php")));
require_once(File::build_path(array("model", "ModelFacture.php")));
require_once(File::build_path(array("model", "ModelAdoption.php")));


class ControllerChien
{
    public static function validation()
    {
        if (isset($_SESSION['login'])) {
            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {
                $chien = ModelChien::getAllChiensAttente();
                $controller = 'chien';
                $view = 'Validation';
                $pagetitle = 'Les Animaux en Attente';
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

    public static function Valider()
    {
        if (isset($_SESSION['login'])) {
            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {
                ModelChien::modifierChienAttente($_GET['numPuce']);
                ControllerChien::validation();
            } else {
                $view = 'accueil';
                $pagetitle = 'Page Accueil';
                require(File::build_path(array("view", "view.php")));
            }
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function Refuser()
    {
        if (isset($_SESSION['login'])) {

            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {
                ModelChien::supprimerChien($_GET['numPuce']);
                ControllerChien::validation();
            } else {
                $view = 'accueil';
                $pagetitle = 'Page Accueil';
                require(File::build_path(array("view", "view.php")));
            }
        } else {
            ControllerUtilisateur::deconnexion();
        }


    }

    public static function Protege()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiens();
            $controller = 'chien';
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function Adopter()
    {
        if (isset($_SESSION['login'])) {

            $accueil = ModelAccueil::getAllAccueil();
            if ($accueil != NULL) {
                foreach ($accueil as $a) {
                    $data[$a->getNumPuce()] = 1;
                }
            }

            $chien = ModelChien::getChiensNonAdoptes();
            $view = 'Adopter';
            $controller = 'chien';
            $pagetitle = 'Les Adoptés';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function formulaireChien()
    {
        if (isset($_SESSION['login'])) {

            $controller = 'chien';
            $view = 'formulaireAjoutChien';
            $pagetitle = 'formulaire Chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function attenteValidation()
    {
        if (isset($_SESSION['login'])) {

            $data = array(
                'numPuce' => $_POST['numPuce'],
                'nomChien' => $_POST['nomChien'],
                'race' => $_POST['race'],
                'dateNaissance' => $_POST['dateNaissance'],
                'sexe' => $_POST['sexe'],
                'robe' => $_POST['robe'],
                'sterilisation' => $_POST['sterilisation'],
                'dateAccueil' => $_POST['dateAccueil'],
                'description' => $_POST['description'],
                'nomAncienProprio' => $_POST['nomAncienProp'],
                'enAttente' => '1',

            );

            $erreur = 'null';

            if (strcmp($_FILES['photo']['name'], $data['numPuce'] . '.png') != 0 && strcmp($_FILES['photo']['name'], $data['numPuce'] . '.jpeg') != 0 && strcmp($_FILES['photo']['name'], $data['numPuce'] . '.JPG') != 0 && strcmp($_FILES['photo']['name'], $data['numPuce'] . '.jpg') != 0 && strcmp($_FILES['photo']['name'], $data['numPuce'] . '.PNG') != 0 && strcmp($_FILES['photo']['name'], $data['numPuce'] . '.JPEG') != 0) {
                $erreur = ' Le nom de la photo du chien est faux.';
            }
            if ($_FILES['photo']['error'] > 0) $erreur = "Erreur lors du transfert";
            if ($_FILES['photo']['size'] > 10000000000) $erreur = "Le fichier est trop gros";
            $extensions_valides = array('jpeg', 'jpg', 'png');
            $extension_upload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
            $nom = File::build_path(array("image", "chien", $_FILES['photo']['name']));
            $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $nom);

            if (strcmp($erreur, 'null') != 0) {
                $controller = 'chien';
                $view = 'ErreurChien';
                $pagetitle = ' Erreur photo du Chien ';
                require(File::build_path(array("view", "view.php")));
            }

            $data['nomPhoto'] = $_FILES['photo']['name'];
            $existe = ModelChien::getChienByNumPuce($data['numPuce']);
            if ($existe!=NULL){
                 $erreur = "le chien est déjà existant";
             }else{
                $etat = ModelChien::addChienAttente($data);
             }
            if ($existe != NULL || $resultat == false || isset($etat)) {

                if (!$resultat) {
                    $erreur = 'le déplacement des fichiers a connu une erreur';
                    ModelChien::supprimerChien($data['numPuce']);
                } else if(isset($etat)){
                    unlink($nom);
                    $erreur = "une erreur est survenue";
                }

                $controller = 'chien';
                $view = 'AjoutChienNonReussi';
                $pagetitle = 'Chien Non Ajouté';
                require(File::build_path(array("view", "view.php")));
            } else {
                $message = 'enregistré';
                $mess = ' Il faut maintenant qu\'un administrateur vérifie les informations rentrées. Si elles sont correctes vous trouverez votre animal sur notre site d\'ici quelques jours';
                $controller = 'chien';
                $titre = "Ajouter Chien";
                $view = 'AjoutChienReussi';
                $pagetitle = 'Chien Ajouté';
                require(File::build_path(array("view", "view.php")));
            }
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }


    public static function ajouterChien()
    {
        if (isset($_SESSION['login'])) {

            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {

                $data = array(
                    'numPuce' => $_POST['numPuce'],
                    'nomChien' => $_POST['nomChien'],
                    'race' => $_POST['race'],
                    'dateNaissance' => $_POST['dateNaissance'],
                    'sexe' => $_POST['sexe'],
                    'robe' => $_POST['robe'],
                    'sterilisation' => $_POST['sterilisation'],
                    'dateAccueil' => $_POST['dateAccueil'],
                    'description' => $_POST['description'],
                    'nomAncienProprio' => $_POST['nomAncienProp']
                );

                $erreur = 'null';

                if (strcmp($_FILES['photo']['name'], $data['numPuce'] . '.png') != 0 && strcmp($_FILES['photo']['name'], $data['numPuce'] . '.jpeg') != 0 && strcmp($_FILES['photo']['name'], $data['numPuce'] . '.JPG') != 0 && strcmp($_FILES['photo']['name'], $data['numPuce'] . '.jpg') != 0 && strcmp($_FILES['photo']['name'], $data['numPuce'] . '.PNG') != 0 && strcmp($_FILES['photo']['name'], $data['numPuce'] . '.JPEG') != 0) {
                    $erreur = ' Le nom de la photo du chien est faux.';
                }
                if ($_FILES['photo']['error'] > 0) $erreur = "Erreur lors du transfert";
                if ($_FILES['photo']['size'] > 10000000000) $erreur = "Le fichier est trop gros";
                $extensions_valides = array('jpeg', 'jpg', 'png');
                $extension_upload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
                $nom = File::build_path(array("image", "chien", $_FILES['photo']['name']));
                $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $nom);

                if (strcmp($erreur, 'null') != 0) {
                    $controller = 'chien';
                    $view = 'ErreurChien';
                    $pagetitle = ' Erreur photo du Chien ';
                    require(File::build_path(array("view", "view.php")));
                } else {
                    $data['nomPhoto'] = $_FILES['photo']['name'];

                    $etat = ModelChien::addChien($data);
                    if ($etat == 12 || $resultat == false) {
                        if ($etat == 12) {
                            $erreur = "le chien est déjà existant";
                        }
                        if (ModelChien::getChienByNumPuce($data['numPuce']) != NULL) {
                            ModelChien::supprimerChien($data['numPuce']);
                        }


                        if (!$resultat) {
                            $erreur = 'le déplacement des fichiers a connu une erreur';
                        } else {
                            unlink($nom);
                        }
                        $controller = 'chien';
                        $view = 'AjoutChienNonReussi';
                        $pagetitle = 'Chien Non Ajouté';
                        require(File::build_path(array("view", "view.php")));
                    } else {
                        $message = 'enregistré';
                        $controller = 'chien';
                        $titre = "Ajouter Chien";
                        $view = 'AjoutChienReussi';
                        $pagetitle = 'Chien Ajouté';
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

    public static function formulaireAdoptionChien()
    {
        if (isset($_SESSION['login'])) {

            $c = ModelChien::getChienByNumPuce($_POST['numPuce']);
            $view = 'formulaireAdoptionChien';
            $pagetitle = 'formulaire adoption';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function modificationFormulaire()
    {
        if (isset($_SESSION['login'])) {

            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {
                $puce = $_GET['numPuce'];
                $chien = ModelChien::getChienByNumPuce($puce);
                $view = 'modificationChien';
                $pagetitle = 'Modification Chien';
                $controller = 'chien';
                require(File::build_path(array("view", "view.php")));;
            } else {
                $view = 'accueil';
                $pagetitle = 'Page Accueil';
                require(File::build_path(array("view", "view.php")));
            }
        } else {
            ControllerUtilisateur::deconnexion();
        }


    }

    public static function modifierChien()
    {
        if (isset($_SESSION['login'])) {

            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {

                $info = array(
                    'numPuce' => $_POST['numPuce'],
                    'nomChien' => $_POST['nomChien'],
                    'race' => $_POST['race'],
                    'dateNaissance' => $_POST['dateNaissance'],
                    'sexe' => $_POST['sexe'],
                    'robe' => $_POST['robe'],
                    'sterilisation' => $_POST['sterilisation'],
                    'dateAccueil' => $_POST['dateAccueil'],
                    'description' => $_POST['description'],
                    'nomAncienProprio' => $_POST['nomAncienProp']
                );
                ModelChien::modifierChien($info);
                if ($_POST['adoption'] == 'oui' && ModelAdoption::getAdoptionBynumPuce($info['numPuce']) == false) {
                    $chien = ModelChien::getChiensNonAdoptes();
                    $view = 'formulaireAdoptionChien';
                    $pagetitle = 'formulaire adoption';
                    $controller = 'chien';
                    require(File::build_path(array("view", "view.php")));
                } else if ($_POST['adoption'] == 'non' && ModelAdoption::getAdoptionBynumPuce($info['numPuce']) != false) {
                    ModelAdoption::supprimerAdoption($info['numPuce']);
                }
                $message = 'modifié';
                $titre = "Modifier Chien";
                $view = 'AjoutChienReussi';
                $pagetitle = 'Modifier Chien';
                $controller = 'chien';
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


    public static function supprimerChien()
    {
        if (isset($_SESSION['login'])) {

            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {

                $puce = $_GET['numPuce'];
                $chien = ModelChien::getChienByNumPuce($puce);
                $nom = File::build_path(array("image", "chien", $chien->getNomPhoto()));
                unlink($nom);
                ModelChien::supprimerChien($puce);
                $message = 'supprimée';
                $titre = "Supprimer Chien";
                $view = 'AjoutChienReussi';
                $pagetitle = 'Supprimer Chien';
                $controller = 'chien';
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

    public static function supressionAdoption()
    {
        if (isset($_SESSION['login'])) {

            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {

                ModelAdoption::supprimerAdoption($_GET['numPuce']);
                $view = 'Adopter';
                $pagetitle = 'Adopter';
                $controller = 'chien';
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


    public static function getChienByNumPuce()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getChienByNumPuce($_POST['numPuce']);
            $view = 'formulaireAjoutFamilleAccueil';
            $pagetitle = 'formulaire Famille';
            if ($chien === null)
                require(File::build_path(array("view", "view.php")));
            require(File::build_path(array("view", "view.php")));
            require(File::build_path(array("lib", "AccueilPDF.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

// Trier les chiens par les critères nom, numero puce, nom ancien proprio, race, robe, sexe, sterilisation, date dateNaissance, date dateAccueil
// par ordre croissant et decroissant

    public static function trierNoms()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNoms();
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }


    }

    public static function trierNomsDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNomsDecroissants();
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trouverChiensNoms()
    {
        if (isset($_SESSION['login'])) {

            $nom = $_POST['nomChien'];
            $chien = ModelChien::getChiensNoms($nom);
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierNumPuces()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNumPuces();
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierNumPucesDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNumPucesDecroissants();
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trouverChiensNumPuces()
    {
        if (isset($_SESSION['login'])) {

            $num = $_POST['numPuce'];
            $chien = ModelChien::getChiensNumPuces($num);
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }


    public static function trierRaces()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensRaces();
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierRacesDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensRacesDecroissants();
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trouverChiensRaces()
    {
        if (isset($_SESSION['login'])) {

            $race = $_POST['race'];
            $chien = ModelChien::getChiensRaces($race);
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }


    public static function trierDateNaissances()
    {
        if (isset($_SESSION['login'])) {

            $data = array(
                'min' => $_POST['datemin'],
                'max' => $_POST['datemax']
            );
            $chien = ModelChien::getAllChiensDateNaissances($data);
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierSexes()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensSexes($_GET['sexe']);
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierRobes()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensRobes();
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierRobesDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensRobesDecroissants();
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trouverChiensRobes()
    {
        if (isset($_SESSION['login'])) {

            $robe = $_POST['robe'];
            $chien = ModelChien::getChiensRobes($robe);
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierSterilisations()
    {
        if (isset($_SESSION['login'])) {

            $avis = $_GET['avis'];
            $chien = ModelChien::getAllChiensSterilisations($avis);
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierDateAccueils()
    {
        if (isset($_SESSION['login'])) {

            $data = array(
                'min' => $_POST['datemin'],
                'max' => $_POST['datemax']
            );
            $chien = ModelChien::getAllChiensDateAccueils($data);
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }


    public static function trierNomAncienProprio()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNomAncienProprio();
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierNomAncienProprioDecroissant()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNomAncienProprioDecroissant();
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }


    }

    public static function trouverChiensAncienProprios()
    {
        if (isset($_SESSION['login'])) {

            $nomAncienProp = $_POST['nomAncienProp'];
            $chien = ModelChien::getChiensAncienProprio($nomAncienProp);
            $view = 'Protege';
            $pagetitle = 'Les Protégés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }


    // Trier les chiens par les critères nom, numero puce, nom ancien proprio, race, robe, sexe, sterilisation, date dateNaissance, date dateAccueil
    // par ordre croissant et decroissant
    public static function trierNonAdoptesNoms()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNonAdoptesNoms();
            $view = 'Adopter';
            $pagetitle = 'Les Adoptés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierNonAdoptesNomsDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNonAdoptesNomsDecroissants();
            $view = 'Adopter';
            $pagetitle = 'Les Adoptés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trouverChiensNonAdoptesNoms()
    {
        if (isset($_SESSION['login'])) {

            $nom = $_POST['nomChien'];
            $chien = ModelChien::getChiensNonAdoptesNoms($nom);
            $view = 'Adopter';
            $pagetitle = 'A Adopter';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }


    public static function trierNonAdoptesNumPuces()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNonAdoptesNumPuces();
            $view = 'Adopter';
            $pagetitle = 'Les Adoptés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }


    public static function trierNonAdoptesNumPucesDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNonAdoptesNumPucesDecroissants();
            $view = 'Adopter';
            $pagetitle = 'Les Adoptés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }


    public static function trouverChiensNonAdoptesNumPuces()
    {
        if (isset($_SESSION['login'])) {

            $num = $_POST['numPuce'];
            $chien = ModelChien::getChiensNonAdoptesNumPuces($num);
            $view = 'Adopter';
            $controller = 'chien';
            $pagetitle = 'A Adopter';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierNonAdoptesRaces()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNonAdoptesRaces();
            $view = 'Adopter';
            $pagetitle = 'Les Adoptés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierNonAdoptesRacesDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNonAdoptesRacesDecroissants();
            $view = 'Adopter';
            $controller = 'chien';
            $pagetitle = 'Les Adoptés';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trouverChiensNonAdoptesRaces()
    {
        if (isset($_SESSION['login'])) {

            $race = $_POST['race'];
            $chien = ModelChien::getChiensNonAdoptesRaces($race);
            $view = 'Adopter';
            $pagetitle = 'A Adopter';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierNonAdoptesDateNaissances()
    {
        if (isset($_SESSION['login'])) {

            $data = array(
                'min' => $_POST['datemin'],
                'max' => $_POST['datemax']
            );
            $chien = ModelChien::getAllChiensNonAdoptesDateNaissances($data);
            $view = 'Adopter';
            $pagetitle = 'A Adopter';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierNonAdoptesSexes()
    {
        if (isset($_SESSION['login'])) {

            $sexe = $_GET['sexe'];
            $chien = ModelChien::getAllChiensNonAdoptesSexes($sexe);
            $view = 'Adopter';
            $controller = 'chien';
            $pagetitle = 'A Adopter';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }


    public static function trierNonAdoptesRobes()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNonAdoptesRobes();
            $view = 'Adopter';
            $controller = 'chien';
            $pagetitle = 'Les Adoptés';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierNonAdoptesRobesDecroissants()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNonAdoptesRobesDecroissants();
            $view = 'Adopter';
            $pagetitle = 'Les Adoptés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trouverChiensNonAdoptesRobes()
    {
        if (isset($_SESSION['login'])) {

            $robe = $_POST['robe'];
            $chien = ModelChien::getChiensNonAdoptesRobes($robe);
            $view = 'Adopter';
            $pagetitle = 'A Adopter';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }


    public static function trierNonAdoptesSterilisations()
    {
        if (isset($_SESSION['login'])) {

            $avis = $_GET['avis'];
            $chien = ModelChien::getAllChiensNonAdoptesSterilisations($avis);
            $view = 'Adopter';
            $pagetitle = 'A Adopter';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierNonAdoptesDateAccueils()
    {
        if (isset($_SESSION['login'])) {

            $data = array(
                'min' => $_POST['datemin'],
                'max' => $_POST['datemax']
            );
            $chien = ModelChien::getAllChiensNonAdoptesDateAccueils($data);
            $view = 'Adopter';
            $pagetitle = 'A Adopter';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }


    public static function trierNonAdoptesNomAncienProprio()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNonAdoptesNomAncienProprio();
            $view = 'Adopter';
            $pagetitle = 'Les Adoptés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trierNonAdoptesNomAncienProprioDecroissant()
    {
        if (isset($_SESSION['login'])) {

            $chien = ModelChien::getAllChiensNonAdoptesNomAncienProprioDecroissant();
            $view = 'Adopter';
            $pagetitle = 'Les Adoptés';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function trouverChiensNonAdoptesAncienProprios()
    {
        if (isset($_SESSION['login'])) {

            $nomAncienProp = $_POST['nomAncienProp'];
            $chien = ModelChien::getChiensNonAdoptesAncienProprio($nomAncienProp);
            $view = 'Adopter';
            $pagetitle = 'A Adopter';
            $controller = 'chien';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }


}