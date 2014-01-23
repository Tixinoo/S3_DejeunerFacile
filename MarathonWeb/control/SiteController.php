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
        echo "A voir";
    }

    public function listThemeAction($param) {
        $theme = Theme::findAll();
        $vue = new Vue($theme);
        $vue->vue_general('liste');
    }
    
    public function listRestoAction($param) {
        $resto = Restaurant::findAll();
        $vue = new Vue($resto);
        $vue->vue_general('liste'); 
    }
}