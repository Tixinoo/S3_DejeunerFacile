<?php

class Panier {
    
    public static function addPanier($plat, $nb=1) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier'][$plat->id] = array();
        }
        $_SESSION['panier'][$plat->id]['plat'] = $plat;
        $_SESSION['panier'][$plat->id]['nbre'] = $nb;
    }

    public static function getDetailPanier() {
        $res = NULL;
        if (isset($_SESSION['panier'])) {
            $res = array();
            foreach ($_SESSION['panier']['plat'] as $plat) {
                $res[$plat->id] = array();
                $res[$plat->id]['type'] = Theme::findById(Restaurant::findById($plat->id_resto)->id_theme)->nom;
                $res[$plat->id]['restaurant'] = Restaurant::findById($plat->id_resto)->nom;
                $res[$plat->id]['plat'] = $plat->nom;
                $res[$plat->id]['nbre'] = $_SESSION['panier']['nbre'][$plat->id];
                $res[$plat->id]['pu'] = $plat->prix;
                $res[$plat->id]['total'] = $plat->prix * $_SESSION['panier']['nbre'][$plat->id];
            }
        }
        return $res;
    }

    public static function resetPanier() {
        session_destroy();
        session_start();
    }
}