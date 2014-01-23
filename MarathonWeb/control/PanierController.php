<?php

include_once '../base/Plat.php';

class PanierController extends Controller {
    
    public function __construct() {
        $this->tab_action = array(
            'addPanier' => 'addPanierAction',
            'getPanier' => 'getPanierAction',
            'resetPanier' => 'resetPanierAction'
        );
    }
    
    public function addPanier($get) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier'][$plat->id] = array();
        }
        $_SESSION['panier'][$plat->id]['plat'] = Plat::findById($get['idPlat']);
        $_SESSION['panier'][$plat->id]['nbre'] = $get['qte'];
    }

    public function getPanier() {
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

    public function resetPanier() {
        session_destroy();
        session_start();
    }
}