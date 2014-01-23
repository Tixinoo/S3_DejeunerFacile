<?php

include_once 'Base.php';

class Plat {

    // Attributs d'un plat
    private $id, $nom, $description, $prix, $photo, $id_resto;

    public function __construct() {
        //Constructeur vide
    }

    // Getter magique !
    public function __get($attr_name) {
        if (property_exists(__CLASS__, $attr_name)) {
            return $this->$attr_name;
        }
        $emess = __CLASS__ . ": unknown member $attr_name (getAttr)";
        throw new Exception($emess, 45);
    }

    //Setter magique !
    public function __set($attr_name, $attr_val) {

        if (property_exists(__CLASS__, $attr_name)) {
            $this->$attr_name = $attr_val;
        }
    }

    /**
     * Méthode qui met un jour un Plat dans la table
     * @return type
     * @throws Exception
     */
    public function update() {

        if (!isset($this->id)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }

        $c = Base::getConnection();

        //$id, $nom, $description, $prix, $photo, $id_resto

        $query = $c->prepare("update plats set nom= ?, description= ?, prix= ?, photo= ?, id_resto= ?
				                   where id=?");

        /*
         * liaison des paramêtres : 
         */
        $query->bindParam(1, $this->nom, PDO::PARAM_STR);
        $query->bindParam(2, $this->description, PDO::PARAM_STR);
        $query->bindParam(3, $this->prix, PDO::PARAM_INT);
        $query->bindParam(4, $this->photo, PDO::PARAM_STR);
        $query->bindParam(5, $this->id_resto, PDO::PARAM_INT);
        $query->bindParam(6, $this->id, PDO::PARAM_INT);

        /*
         * exécution de la requête
         */

        return $query->execute();
    }

    /**
     *   Suppression dans la base
     *
     *   Supprime la ligne dans la table corrsepondant à l'objet courant
     *   L'objet doit posséder un OID
     */
    public function delete() {

        if (!isset($this->id)) {
            throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
        }

        $c = Base::getConnection();


        $query = $c->prepare("DELETE FROM plats where id=?");
        $query->bindParam(1, $this->id, PDO::PARAM_INT);



        return $query->execute();
    }

    /**
     * Ajoute un plat dans la base
     */
    public function insert() {

        $c = Base::getConnection();

        try {
            
            $query = $c->prepare('INSERT INTO plats(nom, description, prix, photo, id_resto) VALUES (?, ?, ?, ?, ?)');
            
            echo "avant exe";
            $res = $query->execute(array($this->nom, $this->description, $this->prix, $this->photo, $this->id_resto));
            var_dump($res);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }




        //Il faut récupérer l'ID et le mettre dans l'objet
        echo "last id : " . $c->lastInsertId();
        $this->id = $c->lastInsertId();
    }

    public static function findById($id) {

        $c = Base::getConnection();
        $query = $c->prepare("select * from plats where id=?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        $dbres = $query->execute();


        $d = $query->fetch(PDO::FETCH_BOTH);

        $p = new Plat();

        $p->id = $d['id'];
        $p->nom = $d['nom'];
        $p->description = $d['description'];
        $p->prix = $d['prix'];
        $p->photo = $d['photo'];
        $p->id_resto = $d['id_resto'];

        return $p;
    }

    /**
     *   Finder All
     *
     *   Renvoie toutes les lignes de la table categorie
     *   sous la forme d'un tableau d'objet
     *  
     *   @static
     *   @return Array renvoie un tableau de categorie
     */
    public static function findAll() {


        $res = array();

        $c = Base::getConnection();
        $query = $c->prepare("select * from plats");
        $dbres = $query->execute();

        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $p = new Plat();

            $p->id = $d['id'];
            $p->nom = $d['nom'];
            $p->description = $d['description'];
            $p->prix = $d['prix'];
            $p->photo = $d['photo'];
            $p->id_resto = $d['id_resto'];


            $res[] = $p;
        }

        return $res;
    }
    
    public static function findByResto($idresto) {
        $res = array();

        $c = Base::getConnection();
        $query = $c->prepare("select * from plats where id_resto= ?");
        
        $dbres = $query->execute(array($idresto));

        while ($d = $query->fetch(PDO::FETCH_BOTH)) {
            $p = new Plat();

            $p->id = $d['id'];
            $p->nom = $d['nom'];
            $p->description = $d['description'];
            $p->prix = $d['prix'];
            $p->photo = $d['photo'];
            $p->id_resto = $d['id_resto'];

            $res[] = $p;
        }

        return $res;
    }
    
    public static function getUrl() {
        $res = "index.php?a=listResto&idtheme=" . $this->id;
    }

}
