<?php

include 'SiteController.php';

$c = new SiteController();

if (isset($_GET['a']))
    $c->callAction($_GET);
else {
     $c->callAction("default");
}