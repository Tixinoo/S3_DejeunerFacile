<?php

include_once 'Controller.php';
include_once 'base/Theme.php';
include_once 'base/Plat.php';
include_once 'vue/Vue.php';

class PanierController extends Controller {
    
    public function __construct() {
        $this->tab_action = array(
            'addPanier' => 'addPanierAction',
            'getPanier' => 'getPanierAction',
            'resetPanier' => 'resetPanierAction'
        );
    }
    
    public function addPanierAction($get) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier'][$get['idPlat']] = array();
        }
        $_SESSION['panier'][$get['idPlat']]['plat'] = Plat::findById($get['idPlat']);
        $_SESSION['panier'][$get['idPlat']]['nbre'] = $get['qte'];
    }

    public function getPanierAction() {
        $res = NULL;
        if (isset($_SESSION['panier'])) {
            $res = array();
            foreach ($_SESSION['panier'][$plat->id] as $plat) {
                $res[$plat->id] = array();
                $res[$plat->id]['type'] = Theme::findById(Restaurant::findById($plat->id_resto)->id_theme)->nom;
                $res[$plat->id]['restaurant'] = Restaurant::findById($plat->id_resto)->nom;
                $res[$plat->id]['plat'] = $plat->nom;
                $res[$plat->id]['nbre'] = $_SESSION['panier']['nbre'][$plat->id];
                $res[$plat->id]['pu'] = $plat->prix;
                $res[$plat->id]['total'] = $plat->prix * $_SESSION['panier']['nbre'][$plat->id];
            }
        }
        $vue = new Vue($res);
        $vue->vue_panier();
    }

    public function resetPanierAction() {
        session_destroy();
        session_start();
    }
}