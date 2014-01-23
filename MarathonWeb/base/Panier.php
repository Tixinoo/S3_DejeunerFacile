<?php

class Panier {
    
    public static function addPanier($plat, $nb=1) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier']['plat'] = array();
            $_SESSION['panier']['nbre'] = array();
        }
        $_SESSION['panier']['plat'][$plat->id] = $plat;
        $_SESSION['panier']['nbre'][$plat->id] = $nb;
    }

    public static function getDetailPanier() {
        $res = NULL;
        if (isset($_SESSION['panier'])) {
            $res = array();
            $res['type'] = array();
            $res['restaurant'] = array();
            $res['plat'] = array();
            $res['nbre'] = array();
            $res['pu'] = array();
            $res['total'] = array();
            foreach ($_SESSION['panier']['plat'] as $plat) {
                $res['type'][$plat->id] = Theme::findById(Restaurant::findById($plat->id_resto)->id_theme)->nom;
                $res['restaurant'][$plat->id] = Restaurant::findById($plat->id_resto)->nom;
                $res['plat'][$plat->id] = $plat->nom;
                $res['nbre'][$plat->id] = $_SESSION['panier']['nbre'][$plat->id];
                $res['pu'][$plat->id] = $plat->prix;
                $res['total'][$plat->id] = $plat->prix * $_SESSION['panier']['nbre'][$plat->id];
            }
        }
        return $res;
    }

    public static function resetPanier() {
        session_destroy();
        session_start();
    }
}