<?php

include 'Base.php';

class Theme
{
    private $id;
    private $nom;
    private $description;
    
    public function __construct() {}
    
    public function __get($attr_name) 
    {
        if (property_exists(__CLASS__, $attr_name)) {
            return $this->$attr_name;
        }
        $emess = __CLASS__ . ": unknown member $attr_name (getAttr)";
        throw new Exception($emess, 45);
    }
    
    public function __set($attr_name, $attr_val) 
    {

        if (property_exists(__CLASS__, $attr_name)) {
            $this->$attr_name = $attr_val;
        }
    }
    
    public function insert()
    {
        try
        {
            $db = Base::getConnection();
            $query = "INSERT INTO Theme (nom,description) VALUES ('?','?')";
            $statement = $db->prepare($query);
            $statement->bindParam(1,$this->nom);
            $statement->bindParam(2,$this->description);
            $nbl = $statement->execute();
            $this->id = $db->lastInsertId('Theme');
            return $nbl;
        }
        catch (Exception $e)
        {
            $trace = $e->getTrace();
            echo "Erreur INSERT : $trace";
        }
    }
    
    public function update()
    {
        try
        {
            if (!isset($this->id))
            {
                throw new Exception(__CLASS__." : clé primaire indéfinie : mise à jour impossible");
            }
            
            $db = Base::getConnection();
            $query = "UPDATE Theme SET nom = ? , description = ? WHERE id = ?";
            $statement = $db->prepare($query);
            $statement->bindParam(1,$this->nom);
            $statement->bindParam(2,$this->description);
            $statement->bindParam(3,$this->id);
            $nbl = $statement->execute();
            return $nbl;
        }
        catch (Exception $e)
        {
            $trace = $e->getTrace();
            echo "Erreur UPDATE : $trace";
        }
    }
    
    public function delete()
    {
        if ($this->id != null)
        {
            try
            {
                $db = Base::getConnection();
                $query = "DELETE FROM Theme WHERE id = ?";
                $statement = $db->prepare($query);
                $statement->bindParam(1,$this->id);
                $nbl = $statement->execute();
                return $nbl;
            }
            catch (Exception $e)
            {
                $trace = $e->getTrace();
                echo "Erreur DELETE : $trace";
            }
        }
    }
    
    public function findById($id)
    {
        try
        {
            $db = Base::getConnection();
            $query = "SELECT * FROM Theme WHERE id = ?";
            $statement = $db->prepare($query);
            $statement->bindParam(1,$id);
            $dbres = $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $r = new Theme();
            $r->id = $row['id'];
            $r->nom = $row['nom'];
            $r->description = $row['description'];
            return $r;
        }
        catch (PDOException $pdoe)
        {
            $trace = $pdoe->getTrace();
            echo "Erreur PDO : $trace";
        }
    }
    
    public function findByNom($nom)
    {
        try
        {
            $db = Base::getConnection();
            $query = "SELECT * FROM Theme WHERE nom = ?";
            $statement = $db->prepare($query);
            $statement->bindParam(1,$nom);
            $dbres = $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $r = new Theme();
            $r->id = $row['id'];
            $r->nom = $row['nom'];
            $r->description = $row['description'];
            return $r;
        }
        catch (PDOException $pdoe)
        {
            $trace = $pdoe->getTrace();
            echo "Erreur PDO : $trace";
        }
    }
    
    public function findAll()
    {
        try 
        {
            $db = Base::getConnection();
            $query = "SELECT * FROM Theme";
            $statement = $db->prepare($query);
            $dbres = $statement->execute();
            $tab = array();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
            $r = new Theme();
            $r->id = $row['id'];
            $r->nom = $row['nom'];
            $r->description = $row['description'];
            $tab[] = $r;
            }
            return $tab;
        }
        catch (PDOException $pdoe)
        {
            $trace = $pdoe->getTrace();
            echo "Erreur PDO : $trace";
        }
    }
}
