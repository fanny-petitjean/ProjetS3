<?php
require_once(File::build_path(array("model", "Model.php")));
require_once(File::build_path(array("model", "ModelVeto.php")));
require_once(File::build_path(array("model", "ModelChien.php")));


class ModelFacture
{
    private $numFacture;
    private $numPuce;
    private $type;
    private $motif;
    private $cout;
    private $dateFacture;
    private $crediteur;
    private $idFacture;


    public function __construct($idFacture = NULL, $num = NULL, $numPuce = NULL, $type = NULL, $motif = NULL, $cout = NULL, $dateFacture = NULL, $crediteur = NULL)
    {
        if (!is_null($idFacture) && !is_null($num) && !is_null($numPuce) && !is_null($type) && !is_null($motif) && !is_null($cout) && !is_null($dateFacture) && !is_null($crediteur)) {
            $this->idFacture = $idFacture;
            $this->numFacture = $num;
            $this->numPuce = $numPuce;
            $this->type = $type;
            $this->motif = $motif;
            $this->cout = $cout;
            $this->dateFacture = $dateFacture;
            $this->crediteur = $crediteur;
        }
    }


    public static function ajouterFacture($data)
    {
        try {
            $sql = "INSERT INTO `Facture`(`numFacture`, `numPuce`, `type`, `motif`, `cout`, `dateFacture`, `crediteur`) VALUES (:tag,:tag2,:tag3,:tag4,:tag5,:tag6,:tag7)";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "tag" => $data["numFacture"],
                "tag2" => $data["numPuce"],
                "tag3" => $data["type"],
                "tag4" => $data["motif"],
                "tag5" => $data["cout"],
                "tag6" => $data["dateFacture"],
                "tag7" => $data["crediteur"],
            );
            $req_prep->execute($values);
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 22007) {
                return false;
            } else if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
     public static function ajouterFacture2($data)
    {
        try {
            $sql = "INSERT INTO `Facture`(`numFacture`, `type`,`numpuce`, `motif`, `cout`, `dateFacture`, `crediteur`) VALUES (:tag,:tag3, :tag2 , :tag4,:tag5,:tag6,:tag7)";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "tag" => $data["numFacture"],
                "tag3" => $data["type"],
                "tag4" => $data["motif"],
                "tag5" => $data["cout"],
                "tag6" => $data["dateFacture"],
                "tag7" => $data["crediteur"],
                "tag2" => 'autre',
            );
            $req_prep->execute($values);
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 22007) {
                return false;
            } else if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function modifierFacture($infos)
    {
        try {
            $sql = "UPDATE Facture SET type=:tag3, motif=:tag4, cout=:tag5, dateFacture=:tag6 ,numPuce=:tag2 WHERE numFacture=:tag AND crediteur=:tag7";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "tag" => $infos["numFacture"],
                "tag2" => $infos["numPuce"],
                "tag3" => $infos["type"],
                "tag4" => $infos["motif"],
                "tag5" => $infos["cout"],
                "tag6" => $infos["dateFacture"],
                "tag7" => $infos["crediteur"],
            );
            $req_prep->execute($values);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }

    }

    public static function supprimerFacture($infos)
    {
        try {
            $sql = "DELETE FROM Facture WHERE numFacture=:tag AND crediteur=:tag2";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "tag" => $infos["numFacture"],
                "tag2" => $infos["crediteur"],
            );
            $req_prep->execute($values);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }

    }

    public static function getFactureByNumFacture($infosFacture)
    {
        $sql = "SELECT * FROM Facture WHERE numFacture=:num1 AND crediteur= :crediteur";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "num1" => $infosFacture['numFacture'],
            "crediteur" => $infosFacture['crediteur'],
        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFacture');
        $facture = $req_prep->fetchAll();
        if (empty($facture)) {
            return false;
        }
        return $facture[0];


    }


    public static function getAllFacture()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Facture");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFacture");
            $frais = $rep->fetchAll();
            return $frais;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }


    public static function totaliserFactures()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT sum(cout) AS couts FROM Facture");
            $row = $rep->fetch();
            return $row['couts'];

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function totaliserFacturesNumPuces()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT numPuce AS bd ,sum(cout) AS cout FROM Facture GROUP BY numPuce");
            $rep->setFetchMode(PDO::FETCH_ASSOC);
            $row = $rep->fetchAll();
            return $row;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function totaliserFacturesRaces()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT race AS bd ,sum(cout) AS cout FROM Facture JOIN Chien ON Facture.numpuce=Chien.numpuce GROUP BY race");
            $rep->setFetchMode(PDO::FETCH_ASSOC);
            $row = $rep->fetchAll();
            return $row;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function totaliserFacturesTypes()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT type AS bd ,sum(cout) AS cout FROM Facture GROUP BY type");
            $rep->setFetchMode(PDO::FETCH_ASSOC);
            $row = $rep->fetchAll();
            return $row;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function totaliserFacturesMotifs()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT motif AS bd ,sum(cout) AS cout FROM Facture GROUP BY motif");
            $rep->setFetchMode(PDO::FETCH_ASSOC);
            $row = $rep->fetchAll();
            return $row;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function totaliserFacturesDates()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT dateFacture AS bd ,sum(cout) AS cout FROM Facture GROUP BY dateFacture");
            $rep->setFetchMode(PDO::FETCH_ASSOC);
            $row = $rep->fetchAll();
            return $row;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function totaliserFacturesCrediteurs()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT crediteur AS bd ,sum(cout) AS cout FROM Facture GROUP BY crediteur");
            $rep->setFetchMode(PDO::FETCH_ASSOC);
            $row = $rep->fetchAll();
            return $row;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }


    //Methode pour trier les factures selon numero, numero de puce, type, motif, cout, date, getCrediteur
    //dans l'ordre croissant et Decroissants
    public static function getAllFacturesNums()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Facture ORDER BY numFacture");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFacture");
            $frais = $rep->fetchAll();
            return $frais;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getAllFacturesNumsDecroissants()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Facture ORDER BY numFacture DESC");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFacture");
            $frais = $rep->fetchAll();
            return $frais;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getFacture($num)
    {

        $sql = "SELECT * FROM Facture WHERE numFacture LIKE :num1";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "num1" => '%' . $num . '%',
        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFacture');
        $facture = $req_prep->fetchAll();
        if (empty($facture)) {
            return false;
        }
        return $facture;

    }

    public static function getAllFacturesNumPuces()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Facture ORDER BY numPuce");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFacture");
            $frais = $rep->fetchAll();
            return $frais;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getAllFacturesNumPucesDecroissants()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Facture ORDER BY numPuce DESC");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFacture");
            $frais = $rep->fetchAll();
            return $frais;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getFacturesNumPuces($num)
    {

        $sql = "SELECT * FROM Facture WHERE numPuce LIKE :num1";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "num1" => '%' . $num . '%',
        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFacture');
        $facture = $req_prep->fetchAll();
        if (empty($facture)) {
            return false;
        }
        return $facture;

    }

    public static function getAllFacturesTypes($type)
    {
        $sql = "SELECT * FROM Facture WHERE type=:type1";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "type1" => $type,
        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFacture');
        $typeFacture = $req_prep->fetchAll();
        if (empty($typeFacture)) {
            return false;
        }
        return $typeFacture;

    }

    public static function getAllFacturesTypesDecroisants()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Facture ORDER BY type DESC");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFacture");
            $frais = $rep->fetchAll();
            return $frais;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getAllFacturesMotifs()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Facture ORDER BY motif");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFacture");
            $frais = $rep->fetchAll();
            return $frais;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getAllFacturesMotifsDecroissants()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Facture ORDER BY motif DESC");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFacture");
            $frais = $rep->fetchAll();
            return $frais;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getAllFacturesCouts()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Facture ORDER BY cout");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFacture");
            $frais = $rep->fetchAll();
            return $frais;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getAllFacturesCoutsDecroissants()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Facture ORDER BY cout DESC");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFacture");
            $frais = $rep->fetchAll();
            return $frais;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getFacturesCouts($couts)
    {
        $sql = "SELECT * FROM Facture WHERE cout BETWEEN :min AND :max";
        // Préparation de la requête
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "min" => $couts['min'],
            "max" => $couts['max']
        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFacture');
        $factures = $req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($factures)) {
            return false;
        }
        return $factures;
    }

    public static function getAllFacturesDateFactures($data)
    {
        $sql = "SELECT * FROM Facture WHERE dateFacture>=:datemin AND dateFacture<=:datemax";
        // Préparation de la requête
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "datemin" => $data["min"],
            "datemax" => $data["max"]
        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelFacture');
        $factures = $req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($factures)) {
            return false;
        }
        return $factures;

    }

    public static function getAllFacturesCrediteurs()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Facture ORDER BY crediteur");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFacture");
            $frais = $rep->fetchAll();
            return $frais;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function getAllFacturesCrediteursDecroisants()
    {
        try {
            $PDO = Model::getPDO();
            $rep = $PDO->query("SELECT * FROM Facture ORDER BY crediteur DESC");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelFacture");
            $frais = $rep->fetchAll();
            return $frais;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="index.php?action=accueil"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }


    //Getter
    public function getIdFacture()
    {
        return $this->idFacture;
    }
    public function getNumpuce()
    {
        return $this->numPuce;
    }

    public function getNumFacture()
    {
        return $this->numFacture;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getMotif()
    {
        return $this->motif;
    }

    public function getCout()
    {
        return $this->cout;
    }

    public function getDateFacture()
    {
        return $this->dateFacture;
    }

    public function getCrediteur()
    {
        return $this->crediteur;
    }




}

?>
