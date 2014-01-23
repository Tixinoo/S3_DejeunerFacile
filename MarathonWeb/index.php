<?php

include_once 'SiteController.php';

session_start();
$c = new SiteController();

if (isset($_GET['a']))
    $c->callAction($_GET);
else {
     $c->callAction("default");
}