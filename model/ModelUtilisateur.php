<?php
require_once(File::build_path(array("model", "Model.php")));


class ModelUtilisateur
{
    private $pseudo;
    private $mail;
    private $motDePasse;
    private $type;

    public function __construct($i = NULL, $c = NULL, $p = NULL, $type = NULL)
    {
        if (!is_null($i) && !is_null($c) && !is_null($p) && !is_null($type)) {
            $this->pseudo = $i;
            $this->mail = $c;
            $this->motDePasse = $p;
            $this->type = $type;

        }
    }

    public static function verifierUtilisateur($data)
    {
        $sql = "SELECT * from Utilisateur WHERE pseudo=:nom_tag AND motDePasse=:nom_tag2";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "nom_tag" => $data["id"],
            "nom_tag2" => $data["password"]
        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        $utilisateur = $req_prep->fetchAll();
        if (empty($utilisateur)) {
            return false;
        }
        return $utilisateur[0];
    }

    public static function creerUtilisateur($data)
    {
        $sql = "INSERT INTO `Utilisateur`(`pseudo`, `motDePasse`, `mail`,`type` ) VALUES (:tag,:tag2,:tag3,:tag4) ";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "tag" => $data["id"],
            "tag2" => $data["password"],
            "tag3" => $data["mail"],
            "tag4" => "0",
        );
        $req_prep->execute($values);
    }

    public static function modifierUtilisateur($infos)
    {
        try {
            $sql = "UPDATE Utilisateur SET mail=:tag2, motDePasse=:tag3 WHERE pseudo=:tag ";
            $req_prep = Model::getPDO()->prepare($sql);

            $values = array(
                "tag" => $infos["pseudo"],
                "tag2" => $infos["mail"],
                "tag3" => $infos["motDePasse"],
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

    public static function getUtilisateurByPseudo($id)
    {
        $sql = "SELECT * from Utilisateur WHERE pseudo=:nom_tag";
        $req_prep = Model::getPDO()->prepare($sql);

        $values = array(
            "nom_tag" => $id,
        );

        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        $utilisateur = $req_prep->fetchAll();
        if (empty($utilisateur)) {
            return false;
        }
        return $utilisateur[0];
    }

    public function getId()
    {
        return $this->pseudo;
    }


    public function getMail()
    {
        return $this->mail;
    }

    public function getType()
    {
        return $this->type;
    }


    public static function getTypeID($id)
    {
        $sql = "SELECT type FROM Utilisateur WHERE pseudo=:tag";

        $req_prep = Model::getPDO()->prepare($sql);

        $value = array(
            'tag' => $id);

        $req_prep->execute($value);

        $req_prep->setFetchMode(PDO::FETCH_COLUMN, 0);
        $pdo = $req_prep->fetchAll();
        return $pdo[0];
    }


}

?>
