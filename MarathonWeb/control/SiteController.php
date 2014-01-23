<?php

include_once 'Controller.php';
include_once 'base/Theme.php';
include_once 'vue/Vue.php';
include_once 'base/Restaurant.php';

class SiteController extends Controller {

    public function __construct() {
        $this->tab_action = array(
                    'listTheme'=>'listThemeAction',
                    'listResto'=>'listRestoAction',
                    'default'=>'defaultAction'
                    );
    }
    
    public function defaultAction() {
        $themes = Theme::findAll();
        $vue = new Vue($themes);
        $vue->vue_all_theme();
    }

    public function listThemeAction() {
        echo "Prout";
        $themes = Theme::findAll();
        var_dump($themes);
        $vue = new Vue($themes);
        echo "Prout";
        $vue->vue_all_theme();
    }
    
    public function listRestoAction($idtheme) {
        $restos = Restaurant::findByTheme($idtheme);
        $vue = new Vue($restos);
        $vue->vue_all_resto($restos); 
    }
    
    public function listPlatAction($idresto) {
        $plats = Plat::findByResto($idresto);
        $vue = new Vue($plats);
        $vue->vue_all_plat($plats);
    }
    
    public function addPanier($plat) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier']['plat'] = array();
            $_SESSION['panier']['nbre'] = array();
        }
        if (isset($_SESSION['panier']['plat'][$plat->id])) {
            $_SESSION['panier']['nbre'][$plat->id] += 1;
        } else {
            $_SESSION['panier']['plat'][$plat->id] = $plat;
            $_SESSION['panier']['nbre'][$plat->id] = 1;
        }
    }

    public function getDetailPanier() {
        $res = NULL;
        if (!isset($_SESSION['panier'])) {
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