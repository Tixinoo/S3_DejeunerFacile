<?php

include_once 'Controller.php';
include_once 'base/Theme.php';
include_once 'base/Plat.php';
include_once 'base/Restaurant.php';
include_once 'vue/Vue.php';

class PanierController extends Controller {

    public function __construct() {
        $this->tab_action = array(
            'addPanier' => 'addPanierAction',
            'getPanier' => 'getPanierAction',
            'resetPanier' => 'resetPanierAction',
            'suppPanier' => 'suppPanierAction'
        );
    }

    public function addPanierAction($get) {
        
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier'][$get['idPlat']] = array();
        }
        
        $_SESSION['panier'][$get['idPlat']]['plat'] = Plat::findById($get['idPlat']);
        
        if (!isset($_SESSION['panier'][$get['idPlat']]['nbre']))
            $_SESSION['panier'][$get['idPlat']]['nbre'] = $get['qte'];
        else
            $_SESSION['panier'][$get['idPlat']]['nbre'] = $_SESSION['panier'][$get['idPlat']]['nbre'] + $get['qte'];

        if (isset($_SESSION['panier'])) {
            $res = array();
            $_SESSION['total'] = 0;
            foreach ($_SESSION['panier'] as $idplat => $ligne) {
                $res[$idplat] = array();
                $res[$idplat]['total'] = $ligne['plat']->prix * $_SESSION['panier'][$idplat]['nbre'];
                $_SESSION['total'] = $_SESSION['total'] +  $res[$idplat]['total'];
            }
            /*if (!isset($_SESSION['total'])) {
                $_SESSION['total'] = 0;
            }
            else {
                $_SESSION['total'] = $_SESSION['total'] + 1;
            }*/
            
        }
        
        include ('html/header.html');
        echo "<div id=\"divaff\"><p id=\"paff\"> " . htmlspecialchars("Plat ajouté au panier avec succès !") . "<br/><br/>";
        echo "Redirection dans 3 secondes, <br/><a href=\"panier.php?a=getPanier\">-Rediriger maintenant</a>";
        echo "</p></div>";
        header('Refresh: 3; url=panier.php?a=getPanier');
        include ('html/footer.html');
    }

    public function getPanierAction() {
        $res = NULL;
        if (isset($_SESSION['panier'])) {
            $res = array();
            foreach ($_SESSION['panier'] as $idplat => $ligne) {
                $res[$idplat] = array();
                $res[$idplat]['type'] = Theme::findById(Restaurant::findById($ligne['plat']->id_resto)->id_theme)->nom;
                $res[$idplat]['restaurant'] = Restaurant::findById($ligne['plat']->id_resto)->nom;
                $res[$idplat]['plat'] = $ligne['plat']->nom;
                $res[$idplat]['nbre'] = $_SESSION['panier'][$idplat]['nbre'];
                $res[$idplat]['pu'] = $ligne['plat']->prix;
                $res[$idplat]['total'] = $ligne['plat']->prix * $_SESSION['panier'][$idplat]['nbre'];
            }
        }
        $vue = new Vue($res);
        $vue->vue_panier();
    }

    public function suppPanierAction($get) {
        if (isset($_SESSION['panier'][$get['idPlat']])) {
            $_SESSION['panier'][$get['idPlat']]['nbre'] = $_SESSION['panier'][$get['idPlat']]['nbre'] - 1;
            include ('html/header.html');
            echo "<div id=\"divaff\"><p id=\"paff\"> " . htmlspecialchars("Plat ajouté au panier avec succès !") . "<br/><br/>";
            echo "Redirection dans 3 secondes, <br/><a href=\"panier.php?a=getPanier\">-Rediriger maintenant</a>";
            echo "</p></div>";
            header('Refresh: 3; url=panier.php?a=getPanier');
            include ('html/footer.html');
        }
        if ($_SESSION['panier'][$get['idPlat']]['nbre'] == 0)
            unset($_SESSION['panier'][$get['idPlat']]);
        /*
        if (isset($_SESSION['panier'][$get['idPlat']])) {
            unset($_SESSION['panier'][$get['idPlat']]);

            include ('html/header.html');
            echo "<div id=\"divaff\"><p id=\"paff\"> " . htmlspecialchars("Plat ajouté au panier avec succès !") . "<br/><br/>";
            echo "Redirection dans 3 secondes, <br/><a href=\"panier.php?a=getPanier\">-Rediriger maintenant</a>";
            echo "</p></div>";
            header('Refresh: 3; url=panier.php?a=getPanier');
            include ('html/footer.html');
        }*/
        if (isset($_SESSION['panier'])) {
            $res = array();
            $_SESSION['total'] = 0;
            foreach ($_SESSION['panier'] as $idplat => $ligne) {
                $res[$idplat] = array();
                $res[$idplat]['total'] = $ligne['plat']->prix * $_SESSION['panier'][$idplat]['nbre'];
                $_SESSION['total'] = $_SESSION['total'] +  $res[$idplat]['total'];
            }
            /*if (!isset($_SESSION['total'])) {
                $_SESSION['total'] = 0;
            }
            else {
                $_SESSION['total'] = $_SESSION['total'] + 1;
            }*/
            
        }
    }

    public function resetPanierAction() {
        session_destroy();
        session_start();
    }

}
