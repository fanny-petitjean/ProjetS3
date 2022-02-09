<?php
require_once(File::build_path(array("model", "ModelChien.php")));
require_once(File::build_path(array("model", "ModelFacture.php")));
require_once(File::build_path(array("model", "ModelFamille.php")));
require_once(File::build_path(array("model", "ModelUtilisateur.php")));
require_once(File::build_path(array("model", "ModelVeto.php")));
require_once(File::build_path(array("lib", "ContactLib.php")));
require_once(File::build_path(array("lib", "AccueilPDF.php")));
require_once(File::build_path(array("lib", "AdoptionPDF.php")));
require_once(File::build_path(array("model", "ModelAdoption.php")));
require_once(File::build_path(array("model", "ModelAccueil.php")));


class ControllerUtilisateur
{
    public static function generateAccueilPDF()
    {
        if (isset($_SESSION['login'])) {

            if (($_POST['mailA']) == "autre") {
                $infoFamille = array(
                    'civilite' => $_POST['civilite'],
                    'nomFamille' => $_POST['nomFamilleAccueil'],
                    'prenomFamille' => $_POST['prenomFamilleAccueil'],
                    'mail' => $_POST['mail'],
                    'numTelephone' => $_POST['telephoneMobile'],
                    'numTelephoneFixe' => $_POST['telephoneFixe'],
                    'adresse' => $_POST['adresseFamilleAccueil'],
                    'codePostal' => $_POST['codePostalFamilleAccueil'],
                    'ville' => $_POST['villeFamilleAccueil'],
                    'pays' => $_POST['paysFamilleAccueil']
                );
                if (ModelFamille::getFamilleByNom($infoFamille['mail']) == NULL) {
                    ModelFamille::ajouterFamille2($infoFamille);
                }
                $mail['mail'] = $_POST['mail'];
                $mail['lieu'] = $_POST['lieu'];
                $mail['dateForm'] = $_POST['dateForm'];
            } else {
                $mail['mail'] = $_POST['mailA'];
                $mail['lieu'] = $_POST['lieuA'];
                $mail['dateForm'] = $_POST['dateFormA'];

            }

            $famille = ModelFamille::getFamilleByNom($mail['mail']);
            $data = array(
                'numPuce' => $_POST['numPuce'],
                'idFamille' => $famille->getIdFamille()
            );


            ModelAccueil::ajouterAccueil($data);
            AccueilPDF::generateAccueilPDF($mail);
            require_once(File::build_path(array("lib", "AccueilPDF.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function generateAdoptionPDF()
    {
        if (isset($_SESSION['login'])) {
            $infoFamille = array(
                'civilite' => $_POST['civilite'],
                'nomFamille' => $_POST['nomFamilleAccueil'],
                'prenomFamille' => $_POST['prenomFamilleAccueil'],
                'mail' => $_POST['mail'],
                'numTelephone' => $_POST['telephone'],
                'adresse' => $_POST['adresseFamilleAccueil'],
                'codePostal' => $_POST['codePostalFamilleAccueil'],
                'ville' => $_POST['villeFamilleAccueil'],
                'pays' => $_POST['paysFamilleAccueil']
            );
            if (!filter_var($infoFamille['mail'], FILTER_VALIDATE_EMAIL)) {
                $error = 'l\'adresse mail n\'est pas valide';
                $view = 'AdoptionChienNonReussie';
                $pagetitle = 'Erreur';
                $controller = 'chien';
                require(File::build_path(array("view", "view.php")));
            } else {
                if (ModelFamille::getFamilleByNom($infoFamille['mail']) == NULL) {
                    ModelFamille::ajouterFamille($infoFamille);
                }


                $data = array(
                    'numPuce' => $_POST['numPuce'],
                    'idFamille' => ModelFamille::getFamilleByNom($infoFamille['mail'])->getIdFamille()
                );

                if (ModelAdoption::ajouterAdoption($data) != NULL) {
                    $error = 'il y a un problème à l\'ajout du chien';
                    $view = 'AdoptionChienNonReussie';
                    $pagetitle = 'Erreur';
                    $controller = 'chien';
                    require(File::build_path(array("view", "view.php")));
                } else {
                    AdoptionPDF::generateAdoptionPDF();
                    require_once(File::build_path(array("lib", "AdoptionPDF.php")));
                }

            }
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

    public static function seConnecter()
    {
        require(File::build_path(array("view", "Connexion.php")));
    }

    public static function connexion()
    {
        $data = array(
            'id' => $_POST['id'],
        );
        $passwordHache = Security::hacher($_POST['password']);
        $data['password'] = $passwordHache;

        $U = ModelUtilisateur::verifierUtilisateur($data);

        if ($U == NULL) {
            require(File::build_path(array("view", "error.php")));
        } else {
            $_SESSION['login'] = $data['id'];
            if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {
                $_SESSION['isAdmin'] = 1;
            } else {
                $_SESSION['isAdmin'] = 0;
            }
            $view = 'accueil';
            $pagetitle = 'Page Accueil';
            require(File::build_path(array("view", "view.php")));
        }
    }

    public static function lienCreationCompte()
    {
        require(File::build_path(array("view", "account_creation.php")));
    }

    public static function creationCompte()
    {
        $data = array(
            'id' => $_POST['id'],
            'mail' => $_POST['mail']
        );
        $passwordHache = Security::hacher($_POST['password']);
        $data['password'] = $passwordHache;

        if ($_POST['password'] == $_POST['verifMdp']) {

            if (ModelUtilisateur::verifierUtilisateur($data) != NULL) {
                $_SESSION['login'] = $data['id'];
                if (ModelUtilisateur::getTypeID($_SESSION['login']) == 1) {
                    $_SESSION['isAdmin'] = 1;
                }
                $view = 'accueil';
                $pagetitle = 'Page Accueil';
                require(File::build_path(array("view", "view.php")));


            } else {
                $_SESSION['login'] = $data['id'];
                $_SESSION['isAdmin'] = 0;

                ModelUtilisateur::creerUtilisateur($data);
                $view = 'accueil';
                $pagetitle = 'Page Accueil';
                require(File::build_path(array("view", "view.php")));
            }
        } else {
            $error = "Mot de passe non identique";
            require(File::build_path(array("view", "account_creation.php")));


        }
    }

    public static function compte()
    {
        if (isset($_SESSION['login'])) {

            $u = ModelUtilisateur::getUtilisateurByPseudo($_SESSION['login']);
            $view = 'Compte';
            $controller = 'utilisateur';
            $pagetitle = 'Compte';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function modificationCompte()
    {
        if (isset($_SESSION['login'])) {
            $u = ModelUtilisateur::getUtilisateurByPseudo($_SESSION['login']);
            $view = 'modificationCompte';
            $controller = 'utilisateur';
            $pagetitle = 'Modifier Compte';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function modifierCompte()
    {
        if (isset($_SESSION['login'])) {
            $data = array(
                'pseudo' => $_POST['pseudo'],
                'mail' => $_POST['mail'],
            );
            if ($_POST['motDePasse'] != $_POST['motDePasse1']) {
                $view = 'modificationUtilisateurNonReussi';
                $controller = 'utilisateur';
                $pagetitle = 'Compte';
                require(File::build_path(array("view", "view.php")));
            } else {
                $passwordHache = Security::hacher($_POST['motDePasse']);
                $data['motDePasse'] = $passwordHache;
                ModelUtilisateur::modifierUtilisateur($data);
                $view = 'modificationUtilisateurReussi';
                $controller = 'utilisateur';
                $pagetitle = 'Compte';
                require(File::build_path(array("view", "view.php")));
            }
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function sendEmail()
    {
        if (isset($_SESSION['login'])) {
            $alert = ContactLib::sendEmail();

            $view = 'Contact';
            $pagetitle = 'Contact';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }


    public static function accueil()
    {
        if (isset($_SESSION['login'])) {
            $view = 'accueil';

            $pagetitle = 'Accueil';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }


    public static function Contact()
    {
        if (isset($_SESSION['login'])) {
            $view = 'Contact';
            $pagetitle = 'Contact';
            $alert = "";
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function FAQ()
    {
        if (isset($_SESSION['login'])) {
            $view = 'FAQ';
            $pagetitle = 'FAQ';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function ouvrirPDF()
    {
        if (isset($_SESSION['login'])) {
            $file = File::build_path(array("pdf", $_POST['name']));

            header("Content-type: application/pdf");

            header("Content-Length: " . filesize($file));

            readfile($file);
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function deconnexion()
    {
        if (isset($_SESSION['login'])) {
            session_unset();     // unset $_SESSION variable for the run-time
            session_destroy();   // destroy session data in storage
            setcookie(session_name(), '', time() - 1);
            require(File::build_path(array("view", "Connexion.php")));
        } else {
            ControllerUtilisateur::seConnecter();
        }
    }


}

?>
