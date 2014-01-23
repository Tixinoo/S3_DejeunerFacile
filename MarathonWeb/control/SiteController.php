<?php

include_once 'Controller.php';
include_once 'base/Theme.php';
include_once 'vue/Vue.php';
include_once 'base/Restaurant.php';
include_once 'base/Plat.php';

class SiteController extends Controller {

    public function __construct() {
        $this->tab_action = array(
                    'listTheme'=>'listThemeAction',
                    'listResto'=>'listRestoAction',
                    'listPlat' =>'listPlatAction',
                    'default'=>'defaultAction'
                    );
    }
    
    public function defaultAction() {
        $themes = Theme::findAll();
        $vue = new Vue($themes);
        $vue->vue_all_theme();
    }

    public function listThemeAction() {
        $themes = Theme::findAll();
        $vue = new Vue($themes);
        $vue->vue_all_theme();
    }
    
    public function listRestoAction($get) {
        $idtheme = $get['id'];
        $restos = Restaurant::findByTheme($idtheme);
        $vue = new Vue($restos);
        $vue->vue_all_resto($restos); 
    }
    
    public function listPlatAction($get) {
        $idresto = $get['id'];
        $plats = Plat::findByResto($idresto);
        $vue = new Vue($plats);
        $vue->vue_all_plat($plats);
    }
    
    public function addPanier($plat, $nb=1) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier']['plat'] = array();
            $_SESSION['panier']['nbre'] = array();
        }
        $_SESSION['panier']['plat'][$plat->id] = $plat;
        $_SESSION['panier']['nbre'][$plat->id] = $nb;
    }

    public function getDetailPanier() {
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

    public function resetPanier() {
        session_destroy();
        session_start();
    }
}