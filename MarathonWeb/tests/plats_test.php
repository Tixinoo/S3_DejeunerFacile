<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include ('../Plat.php');
// Création d'un plat 
$p = new Plat();
$p->nom = "test";
$p->description = "Juste un test, il a l'air très bon";
$p->insert();

$liste = $p->findAll();
foreach($liste as $key => $value) {
    var_dump($value);
}


