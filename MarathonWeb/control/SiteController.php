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
    
}