<?php

include ('../base/Theme.php');
$t = new Theme();
$t->nom = "nom";
$t->description = "description";
var_dump($t);
$t->insert();
echo "".$t->id."";
$liste = Theme::findAll();

foreach ($liste as $key => $value)
{
    var_dump($value);
}
