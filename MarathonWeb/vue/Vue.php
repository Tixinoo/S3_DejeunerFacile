<?php

class Vue {

    private $obj;

    public function __construct($param) {
        $this->obj = $param;
    }

    public function vue_general($param) {
        include 'html/header.html';
        $all_themes = Theme::findAll();
        foreach($all_themes as $t) {
            vue_theme($t);
        }
        include 'html/footer.html';
    }
    
    public function vue_theme($theme) {
        $res = "<div id=\"contenu\">\n";
        $res = $res . "<h1>" . $theme->id . " : " . $theme->nom . "</h1>";

        $res = $res . "<p id=catdescription>" . $theme->description . "</p>";
        $res = $res . "</div>";
        return $res;
    }
    
}