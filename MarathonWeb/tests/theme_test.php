<?php

include ('../base/Theme.php');
$t = new Theme();
$t->nom = "nom";
$t->description = "description";
$t->insert();

$liste = $t->findAll();

foreach ($liste as $key => $value)
{
    var_dump($value);
}
