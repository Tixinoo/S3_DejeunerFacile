<?php

include 'Base.php';

class Restaurant
{
    private $id;
    private $nom;
    private $description;
    private $adresse;
    private $contact;
    private $id_theme;
    
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
            $query = "INSERT INTO Restaurant ($nom,$description,$adresse,$contact,$id_theme) VALUES ('?','?','?','?','?')";
            $statement = $db->prepare($query);
            $statement->bindParam(1,$this->nom);
            $statement->bindParam(2,$this->description);
            $statement->bindParam(3,$this->adresse);
            $statement->bindParam(4,$this->contact);
            $statement->bindParam(5,$this->id_theme);
            $nbl = $statement->execute();
            $this->id = $db->lastInsertId('Restaurant');
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
            $query = "UPDATE Restaurant SET nom = ? , description = ? , adresse = ? , contact = ? , id_theme = ? WHERE id = ?";
            $statement = $db->prepare($query);
            $statement->bindParam(1,$this->nom);
            $statement->bindParam(2,$this->description);
            $statement->bindParam(3,$this->adresse);
            $statement->bindParam(4,$this->contact);
            $statement->bindParam(5,$this->id_theme);
            $statement->bindParam(6,$this->id);
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
                $query = "DELETE FROM Restaurant WHERE id = ?";
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
    
    public function findById()
    {
        try
        {
            $db = Base::getConnection();
            $query = "SELECT * FROM Restaurant WHERE id = ?";
            $statement = $db->prepare($query);
            $statement->bindParam(1,$this->id);
            $dbres = $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $r = new Restaurant();
            $r->id = $row['id'];
            $r->nom = $row['nom'];
            $r->description = $row['description'];
            $r->adresse = $row['adresse'];
            $r->contact = $row['contact'];
            $r->id_theme = $row['id_theme'];
            return $r;
        }
        catch (PDOException $pdoe)
        {
            $trace = $pdoe->getTrace();
            echo "Erreur PDO : $trace";
        }
    }
    
    public function findByNom()
    {
        
    }
    
    public function findByAdresse()
    {
        
    }
    
    public function findByIdTheme()
    {
        
    }
    
    public function findAll()
    {
        
    }
}