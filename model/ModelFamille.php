<?php
require_once(File::build_path(array("model", "Model.php")));


class ModelFamille
{
    private $idFamille;
    private $civilite;
    private $nomFamille;
    private $prenomFamille;
    private $mail;
    private $numTelephone;
    private $numTelephoneFixe;
    private $adresse;
    private $codePostal;
    private $ville;
    private $pays;


    public function __construct($idFamille = NULL, $civilite = NULL, $nom = NULL, $prenom = NULL, $mail = NULL, $num = NULL, $adresse = NULL, $codePostal = NULL, $ville = NULL, $pays = NULL, $numTelephoneFixe = NULL)
    {
        if (!is_null($idFamille) && !is_null($civilite) && !is_null($nom) && !is_null($prenom) && !is_null($mail) && !is_null($num) && !is_null($adresse) && !is_null($codePostal) && !is_null($ville) && !is_null($pays)  && !is_null($numTelephoneFixe)) {
            $this->idFamille = $idFamille;
            $this->civilite = $civilite;
            $this->nomFamille = $nom;
            $this->prenomFamille = $prenom;
            $this->mail = $mail;
            $this->numTelephone = $num;
            $this->adresse = $adresse;
            $this->codePostal = $codePostal;
            $this->ville = $ville;
            $this->pays = $pays;
            $this->numTelephoneFixe = $numTelephoneFixe;

        }
    }

    public static function ajouterFamille($data)
    {
        try {


            $sql = "INSERT INTO `Famille`(`civilite`, `nomFamille`, `prenomFamille`, `mail`, `numTelephone`, `adresse`, `codePostal`, `ville`, `pays`) VALUES (:tag,:tag2,:tag3,:tag4,:tag5, :tag6,:tag7,:tag8,:tag9)";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "tag" => $data["civilite"],
                "tag2" => $data["nomFamille"],
                "tag3" => $data["prenomFamille"],
                "tag4" => $data["mail"],
                "tag5" => $data["numTelephone"],
                "tag6" => $data["adresse"],
                "tag7" => $data["codePostal"],
                "tag8" => $data["ville"],
                "tag9" => $data["pays"],

            );
            $req_prep->execute($values);
        } catch (PDOException $e) {
            if ($e->getCode() == 22007) {
                return false;
            } else if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
    public static function ajouterFamille2($data)
    {
        try {


            $sql = "INSERT INTO `Famille`(`civilite`, `nomFamille`, `prenomFamille`, `mail`, `numTelephone`, `numTelephoneFixe`,`adresse`, `codePostal`, `ville`, `pays`) VALUES (:tag,:tag2,:tag3,:tag4,:tag5, :tag10, :tag6,:tag7,:tag8,:tag9)";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "tag" => $data["civilite"],
                "tag2" => $data["nomFamille"],
                "tag3" => $data["prenomFamille"],
                "tag4" => $data["mail"],
                "tag5" => $data["numTelephone"],
                "tag6" => $data["adresse"],
                "tag7" => $data["codePostal"],
                "tag8" => $data["ville"],
                "tag9" => $data["pays"],
                "tag10" => $data["numTelephoneFixe"],

            );
            $req_prep->execute($values);
        } catch (PDOException $e) {
            if ($e->getCode() == 22007) {
                return false;
            } else if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getFamilleByNom($info)
    {
        $sql = "SELECT * FROM Famille WHERE mail=:tag3";
        $req_prep = Model::getPDO()->prepare($sql);
        $values = array(
            "tag3" => $info,
        );
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFamille');
        $tab_famille = $req_prep->fetchAll();
        if (empty($tab_famille))
            return false;
        return $tab_famille[0];
    }
    public static function getAllFamilleAccueil()
    {

        $PDO = Model::getPDO();
        $rep = $PDO->query("SELECT * FROM Famille JOIN Accueil ON Famille.idFamille=Accueil.idFamille");
        $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFamille");
        $famille = $rep->fetchAll();

        if (empty($famille))
            return false;
        return $famille;

    }
    public static function getAllFamille()
    {

        $PDO = Model::getPDO();
        $rep = $PDO->query("SELECT * FROM Famille");
        $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFamille");
        $famille = $rep->fetchAll();

        if (empty($famille))
            return false;
        return $famille;

    }



    //Getter
    public function getIdFamille()
    {
        return $this->idFamille;
    }

    public function getCivilite()
    {
        return $this->civilite;
    }

    public function getNomFamille()
    {
        return $this->nomFamille;
    }

    public function getPrenomFamille()
    {
        return $this->prenomFamille;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getNumTelephone()
    {
        return $this->numTelephone;
    }
      public function getNumTelephoneFixe()
    {
        return $this->numTelephoneFixe;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getCodePostal()
    {
        return $this->codePostal;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function getPays()
    {
        return $this->pays;
    }

}

?>
