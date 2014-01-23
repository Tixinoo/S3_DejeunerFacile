<?php

include_once ('../base/Theme.php');
$t = new Theme();
$t->nom = "nomtheme";
$t->description = "descriptiontheme";

$t->insert();
echo $t->id;

$liste = Theme::findAll();

foreach ($liste as $key => $value)
{
    echo "" . $value->nom . " ; " . $value->description . "<br/>";
}

$tt = Theme::findById($t->id);
$tt->description = "une autre description";
var_dump($tt);

$tt->delete();


$liste2 = Theme::findAll();

foreach ($liste2 as $key => $value)
{
    echo "" . $value->nom . " ; " . $value->description . "<br/>";
}