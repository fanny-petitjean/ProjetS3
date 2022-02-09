<?php
require_once(File::build_path(array("model", "Model.php")));


class ModelAccueil
{
    private $numPuce;
    private $idFamille;


    public function __construct($numPuce = NULL, $idFamille = NULL)
    {
        if (!is_null($numPuce) && !is_null($idFamille)) {
            $this->numPuce = $numPuce;
            $this->idFamille = $idFamille;
        }
    }

    public static function ajouterAccueil($data)
    {
        try {
            $sql = "INSERT INTO Accueil(numPuce, idFamille) VALUES (:tag,:tag2)";
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


    public static function supprimerAccueil($numPuce)
    {

        $sql = "DELETE FROM `Accueil` WHERE numPuce=:tag";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "tag" => $numPuce,
        );
        $req_prep->execute($values);
    }

    public static function getAccueilBynumPuce($numPuce)
    {
        $sql = "SELECT * FROM Accueil WHERE numPuce=:nom_tag";
        $req_prep = Model::getPDO()->prepare($sql);
        $values = array(
            "nom_tag" => $numPuce
        );
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelAccueil');
        $tab_chien = $req_prep->fetchAll();
        if (empty($tab_chien))
            return false;
        return $tab_chien[0];
    }
    public static function getAllAccueil(){
        try {
            $PDO = Model::getPDO(); 
            $rep = $PDO->query("SELECT * FROM Accueil");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelAccueil");
            $chien = $rep->fetchAll();
            return $chien;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public function getNumPuce(){
        return $this->numPuce;
    }
    public function getIdFamille(){
        return $this->idFamille;
    }


}