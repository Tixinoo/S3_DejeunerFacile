<?php

include_once 'control/PanierController.php';

session_start();
$p = new PanierController();

if (isset($_GET['a'])) {
    $p->callAction($_GET);
}