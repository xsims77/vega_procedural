<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;
require AUTH_MIDDLEWARE;

    
    /**
     * Cette fonction permet de retourner la contenu de la page de profil
     *
     * @return string
     */
    function index() : string
    {
        require USER;

        $user = findUserBy(["id" => $_SESSION['user']['id']]);
        
        
        
        return render("pages/user/profile/index.html.php",[
            "user" => $user
        ]);
        // return render("pages/user/profile/index.html.php", compact('user'));
    }
    

    /**
     * Cette fonction permet de retourner le contenu de la page de modification du profil
     *
     * @return string
     */
    function edit() : string
    {

        require USER;
        $user = findUserBy(["id" => $_SESSION['user']['id']]);

        if (isFormSubmitted($_POST)) 
        {
            require VALIDATOR;

            dd('pause');
            makeValidation(
                $_POST,
                [
                    
                ],
                [

                ]
            );

        }

        return render("pages/user/profile/edit.html.php", [
            "user" => $user
        ]);

    }