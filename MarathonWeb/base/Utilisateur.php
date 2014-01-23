<?php

include_once 'base/Base.php';

class Utilisateur {
    
    //ATTRIBUTS
    private $id;
    
    //CONSTRUCTEUR
    public function __construct() {}
    
    //METHODES
    public function __get($attr_name) {
        
        if (property_exists( __CLASS__, $attr_name)) { 
            return $this->$attr_name;
        } 
        $emess = __CLASS__ . ": unknown member $attr_name (getAttr)";
        throw new Exception($emess, 45);
    }

    public function __set($attr_name, $attr_val) {
        
        if (property_exists( __CLASS__, $attr_name)) { 
            $this->$attr_name = $attr_val;
        } 
        $emess = __CLASS__ . ": unknown member $attr_name (setAttr)";
    }
    
    
}