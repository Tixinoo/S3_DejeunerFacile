<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include ('../base/Plat.php');
 //Création d'un plat 
/*$p = new Plat();
$p->nom = 'Monrepas';
$p->description = 'Description de mon repas';
$p->prix = 12;
$p->photo = 'Photo.jpg';
$p->id_resto =1;

var_dump($p);
$p->insert();

$liste = Plat::findAll();

foreach($liste as $key => $value) {
    echo "" . $value->nom . " ; " . $value->description  . " <br>";
}


$p->description = "Bonjour";
$p->update();
var_dump($p);

$p->delete();*/

$liste = Plat::findByResto(1);
foreach($liste as $key => $value) {
    echo "" . $value->nom . " ; " . $value->description  . " <br>";
}
