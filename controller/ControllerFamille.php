<?php
require_once(File::build_path(array("model", "ModelFamille.php")));
require_once(File::build_path(array("model", "ModelChien.php")));


class ControllerFamille
{
    public static function formulaireFamilleAccueil()
    {
        if (isset($_SESSION['login'])) {

            if (isset($_GET['numPuce'])) {
                $c = ModelChien::getChienByNumPuce($_GET['numPuce']);
            } else {
                $c = ModelChien::getAllChiens();
            }
            $f = ModelFamille::getAllFamille();

            $view = 'formulaireAjoutFamilleAccueil';
            $pagetitle = 'formulaire Famille';
            $controller = 'famille';
            require(File::build_path(array("view", "view.php")));
        } else {
            ControllerUtilisateur::deconnexion();
        }
    }

    public static function ajouterFamille()
    {
        if (isset($_SESSION['login'])) {

            $data = array(
                'civilite' => $_POST['civilite'],
                'nomFamille' => $_POST['nomFamilleAccueil'],
                'prenomFamille' => $_POST['prenomFamilleAccueil'],
                'mail' => $_POST['mail'],
                'numTelephone' => $_POST['numTelephone'],
                'adresse' => $_POST['adresseFamilleAccueil'],
                'codePostal' => $_POST['codePostalFamilleAccueil'],
                'ville' => $_POST['villeFamilleAccueil'],
                'pays' => $_POST['paysFamilleAccueil'],
            );

            $res = ModelFamille::ajouterFamille($data);
            if ($res == false) {

                $view = 'AdoptionChienNonReussie';
                $pagetitle = 'Chien non adopté';
                $controller = 'famille';
                require(File::build_path(array("view", "view.php")));
            }
        } else {
            ControllerUtilisateur::deconnexion();
        }

    }

}