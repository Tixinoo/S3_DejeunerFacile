<?php

include_once 'Controller.php';
include_once 'base/Theme.php';
include_once 'vue/Vue.php';
include_once 'base/Restaurant.php';
include_once 'base/Plat.php';

class SiteController extends Controller {

    public function __construct() {
        $this->tab_action = array(
            'listTheme' => 'listThemeAction',
            'listResto' => 'listRestoAction',
            'listPlat' => 'listPlatAction',
            'affPlat' => 'afficherPlat',
            'default' => 'defaultAction'
        );
    }
    
    public function afficherPlat($get) {
        if(isset($get['idplat'])) {
            $plat = Plat::findById($get['idplat']);
            $vue = new Vue($plat);
            $vue->afficherplat();
        } else {
            $this->defaultAction();
        }
    }

    public function defaultAction() {
        $themes = Theme::findAll();
        $vue = new Vue($themes);
        $vue->vuedefault();
    }

    public function listThemeAction() {
        $themes = Theme::findAll();
        $vue = new Vue($themes);
        $vue->vue_all_theme();
    }

    public function listRestoAction($get) {
        $idtheme = 0;
        if (isset($get['idtheme'])) {
            $idtheme = $get['idtheme'];
            $restos = Restaurant::findByTheme($idtheme);
        } else {
            $restos = Restaurant::findAll();
        }
        $vue = new Vue($restos);
        $vue->vue_all_resto($idtheme);
    }

    public function listPlatAction($get) {
        $idresto = 0;
        if (isset($get['idresto'])) {
            $idresto = $get['idresto'];
            $plats = Plat::findByResto($idresto);
        } else {
            $plats = Plat::findAll();
        }

        $vue = new Vue($plats);
        $vue->vue_all_plat($idresto);
    }

}
