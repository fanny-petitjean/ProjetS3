<?php
require_once(File::build_path(array("model", "Model.php")));


class ModelAdoption
{

    private $numPuce;
    private $idFamille;


    public function __construct($idFamille = NULL, $numPuce = NULL)
    {
        if (!is_null($idFamille) && !is_null($numPuce)) {
            $this->idFamille = $idFamille;
            $this->numPuce = $numPuce;
        }
    }

    public static function ajouterAdoption($data)
    {
        try {
            $sql = "INSERT INTO `Adoption`(`numPuce`, `idFamille`) VALUES (:tag,:tag2)";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "tag" => $data["numPuce"],
                "tag2" => $data["idFamille"],
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


    public static function supprimerAdoption($numPuce)
    {

        $sql = "DELETE FROM `Adoption` WHERE numPuce=:tag";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "tag" => $numPuce,
        );
        $req_prep->execute($values);
    }

    public static function getAdoptionBynumPuce($numPuce)
    {
        $sql = "SELECT * FROM Adoption WHERE numPuce=:nom_tag";
        $req_prep = Model::getPDO()->prepare($sql);
        $values = array(
            "nom_tag" => $numPuce
        );
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelAdoption');
        $tab_chien = $req_prep->fetchAll();
        if (empty($tab_chien))
            return false;
        return $tab_chien[0];
    }


}