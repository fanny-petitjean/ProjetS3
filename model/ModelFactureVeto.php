<?php
require_once(File::build_path(array("model", "Model.php")));

class ModelFactureVeto
{
    private $idVeto;
    private $idFacture;


    public function __construct($idVeto = NULL, $idFacture = NULL)
    {
        if (!is_null($idVeto) && !is_null($idFacture)) {
            $this->idVeto = $idVeto;
            $this->idFacture = $idFacture;

        }
    }

    public static function ajouterFacture($data)
    {
        $sql = "INSERT INTO `FactureVeto`( `idVeto`, `idFacture`) VALUES (:tag,:tag2)";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "tag" => $data["idVeto"],
            "tag2" => $data["idFacture"],
        );
        $req_prep->execute($values);


    }

    public static function getAllFactures()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM FactureVeto");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFactureVeto");
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


    public function getIdVeto()
    {
        return $this->idVeto;
    }

    public function getIdFacture()
    {
        return $this->idFacture;
    }


}

?>
