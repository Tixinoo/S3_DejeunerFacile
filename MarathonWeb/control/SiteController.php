<?php

include_once 'Controller.php';
include_once 'base/Theme.php';
include_once 'vue/Vue.php';

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
}