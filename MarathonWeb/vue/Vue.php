<?php

class Vue {

    private $controller;

    public function __construct($param) {
        $this->controller = $param;
    }

    public function vue_general($param) {
        include 'html/header.html';
        echo "coucou";
        include 'html/footer.html';
    }
    
}