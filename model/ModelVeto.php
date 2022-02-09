<?php
require_once(File::build_path(array("model", "Model.php")));

class ModelVeto
{
    private $idVeto;
    private $nomVeto;
    private $numTelephoneVeto;
    private $adresseVeto;
    private $codePostalVeto;
    private $villeVeto;
    private $paysVeto;


    public function __construct($nomVeto = NULL, $numTelephoneVeto = NULL, $adresseVeto = NULL, $codePostalVeto = NULL, $villeVeto = NULL, $paysVeto = NULL)
    {
        if (!is_null($nomVeto) && !is_null($numTelephoneVeto) && !is_null($adresseVeto) && !is_null($codePostalVeto) && !is_null($villeVeto) && !is_null($paysVeto)) {
            $this->nomVeto = $nomVeto;
            $this->numTelephoneVeto = $numTelephoneVeto;
            $this->adresseVeto = $adresseVeto;
            $this->codePostalVeto = $codePostalVeto;
            $this->villeVeto = $villeVeto;
            $this->paysVeto = $paysVeto;

        }
    }

    public static function ajouterVeto($data)
    {
        $sql = "INSERT INTO `Veterinaire`( `nomVeto`, `numTelephoneVeto`,`adresseVeto`, `codePostalVeto`, `villeVeto`, `paysVeto`) VALUES (:tag,:tag2,:tag3,:tag4,:tag5,:tag6)";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "tag" => $data["nomVeto"],
            "tag2" => $data["numVeto"],
            "tag3" => $data["adresseVeto"],
            "tag4" => $data["codePostalVeto"],
            "tag5" => $data["villeVeto"],
            "tag6" => $data["paysVeto"],
        );
        $req_prep->execute($values);


    }

    public static function getAllVeto()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Veterinaire");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelVeto");
            $veto = $rep->fetchAll();
            return $veto;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getVeterinaireByNom($infos)
    {
        $sql = "SELECT * from Veterinaire WHERE nomVeto=:nom_tag AND numTelephoneVeto=:nom_tag2";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "nom_tag" => $infos['nomVeto'],
            "nom_tag2" => $infos['numTelephoneVeto'],

        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelVeto');
        $veto = $req_prep->fetchAll();
        if (empty($veto)) {
            return false;
        }
        return $veto[0];
    }
      public static function getVeterinaireById($infos)
    {
        $sql = "SELECT * from Veterinaire WHERE idVeto=:nom_tag";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "nom_tag" => $infos,

        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelVeto');
        $veto = $req_prep->fetchAll();
        if (empty($veto)) {
            return false;
        }
        return $veto[0];
    }

    public function getIdVeto()
    {
        return $this->idVeto;
    }

    public function getNomVeto()
    {
        return $this->nomVeto;
    }

    public function getNumTelephoneVeto()
    {
        return $this->numTelephoneVeto;
    }

    public function getAdresseVeto()
    {
        return $this->adresseVeto;
    }

    public function getCodePostalVeto()
    {
        return $this->codePostalVeto;
    }

    public function getVilleVeto()
    {
        return $this->villeVeto;
    }

    public function getPaysVeto()
    {
        return $this->paysVeto;
    }


}

?>
