<?php

include_once ('../base/Theme.php');
$t = new Theme();
$t->nom = "nom";
$t->description = "description";
//var_dump($t);
//$t->insert();
//echo "".$t->id."";
$liste = Theme::findAll();
var_dump($liste);

foreach ($liste as $key => $value)
{
    echo "coucou";
    var_dump($value);
}
