<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

    /**
     * Cette fonction se charge de retourner la réponse repésentant la page d'accueil
     *
     * @return string
     */
    function index() : string
    {
        $firstName = "Sims";

        $somme = 1 + 1;

        return render("test.html.php",[
            "firstName" => $firstName,
            "somme"     => $somme
        ]);

        //exemple d'écriture
        // return render("test.html.php", array(
        //     "firstName" => $firstName,
        //     "somme"     => $somme
        // ));

        // Une autre exemple d'écriture
        // return render("test.html.php", compact("firstName", "somme"));

    }



    function toGreat() : string
    {
        return render("great.html.php");
    }
