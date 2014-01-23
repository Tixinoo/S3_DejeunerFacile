<?php

include ('../Restaurant.php');
$r = new Theme();
$r->nom = "nom";
$r->description = "description";
$r->adresse = "adresse";
$r->contact = "contact";
$r->id_theme = "id_theme";
var_dump($r);
$r->insert();
echo "".$r->id."";
$liste = Restaurant::findAll();

foreach ($liste as $key => $value)
{
    var_dump($value);
}
