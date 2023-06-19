<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

    function index() : string
    {
        // return "Welcome"; // Permet de voir si la fonction s'affiche correctement
        return render("pages/visitor/welcome/index.html.php");
    }