<?php

class Vue {

    private $obj;

    public function __construct($param) {
        $this->obj = $param;
    }

    public function vue_all_theme() {
        include 'html/header.html';
        foreach($this->obj as $t) {
            echo $this->vue_theme($t);
        }
        include 'html/footer.html';
    }
    
    public function vue_theme($theme) {
        $res = "<div class=\"contenu\">\n";
        $id = $theme->id;
        $res = $res . "<h1><a href=\"index.php?a=listResto&idtheme=$id\">" . $id . " : " . $theme->nom . "</a></h1>";

        $res = $res . "<p class=catdescription>" . $theme->description . "</p>";
        $res = $res . "</div>";
        return $res;
    }
    
    public function vue_all_resto() {
        include 'html/header.html';
        foreach($this->obj as $r) {
            echo $this->vue_resto($r);
        }
        include 'html/footer.html';
    }
    
    public function vue_resto($resto) {
        $res = "<div class=\"contenu\">\n";
        $id = $resto->id;
        $res = $res . "<h1><a href=\"index.php?a=listPlat&idresto=$id\">" . $id . " : " . $resto->nom . "</a></h1>";

        $res = $res . "<p class=catdescription>" . $resto->description . "</p>";
        $res = $res . "</div>";
        return $res;  
    }
    
    public function vue_all_plat() {
        include 'html/header.html';
        $plat = $this->obj;
        foreach($this->obj as $p) {
            echo $this->vue_plat($p);
            echo '<p class="lienpanier"><a href="panier.php?a=addPanier&idPlat=' . $p->id . '&qte=' . 1 . '">Ajouter au panier</a></p></br>';
        }
        include 'html/footer.html';
    }
    
    public function vue_plat($plat) {
        $res = "<div class=\"contenu\">\n";
        $res = $res . "<h1>" . $plat->id . " : " . $plat->nom . "</h1>";

        $res = $res . "<p class=catdescription>" . $plat->description . "</p>";
        $res = $res . "</div>";
        return $res;  
    }
    
    public function vue_panier($panier) {
        $res = '<div id=panier>\n<table><tr><td>Theme</td><td>Plat</td><td>Restaurant</td><td>Quantité</td><td>P.U.</td><td>Total</td></tr>';
        foreach ($panier as $p) {
            $res = $res . '<tr><td>'. $p->type .'</td><td>'. $p->restaurant .'</td><td>'. $p->plat .'</td><td>'. $p->nbre .'</td><td>'. $p->pu .'</td><td>'. $p->total .'</td></tr>';
        }
        $res = $res . '</table></div>';
        return $res;
    }
}