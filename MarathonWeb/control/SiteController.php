<?php

class SiteController extends Controller {

    public function __construct() {
        $this->tab = array(
                    'listTheme'=>'listThemeAction',
                    'listResto'=>'listRestoAction',
                    'default'=>'defaultAction'
                    );
    }
    
    public function defaultAction() {
        $themes = Theme::findAll();
        $vue = new Vue($themes);
        $vue->vue_generale();
    }

    public function listThemeAction() {
        $themes = Theme::findAll();
        $vue = new Vue($themes);
        $vue->vue_all_theme();
    }
    
    public function listRestoAction($idtheme) {
        $restos = Restaurant::findByTheme($idtheme);
        $vue = new Vue($restos);
        $vue->vue_all_resto($restos); 
    }
}