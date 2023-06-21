<?php
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

    function login() : string
    {
        if ( isFormSubmitted($_POST) ) 
        {

            // Charger le validateur
            require VALIDATOR;

            // Demander au validateur de valider les données
            // Récupérer la réponse corrspondante
            $errors = makeValidation(
                $_POST,
                [
                    "email"     => ["required", "max:255", "email"],
                    "password"  => ["required", "string", "max:255", "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/"]
                ],
                [
                    "email.required"    => "L'email est obligatoire.",
                    "email.string"      => "Veuillez entrer une chaine de caractères.",
                    "email.max"         => "L'email ne doir pas dépasser 255 caractères.",
                    "email.email"       => "Veuillez entrer un email valide.",

                    "password.required" => "Le mot de passe est obligatoire.",
                    "password.string"   => "Veuillez entrer une chaine de caractères.",
                    "password.min"      => "Le mot de passe doit contenir au minimum 12 caractères.",
                    "password.max"      => "Le mot de passe doit contenir au maximum 255 caractères..",
                    "password.regex"    => "Le mot de passe doit contenir au moins une lettre minuscule, majuscule, un chiffre et un caractère spécial.",
                ]
            );

            // S'il y a au moins une erreur,
            if (count($errors) > 0 ) 
            {
                
                // Sauvegarder les anciennes valeurs provenant du formulaire en session
                $_SESSION['old'] = getOldValues($_POST);

                // Sauvegarder les messages d'erreurs en session
                $_SESSION['form_errors'] = $errors;

                // Redirige l'utilisateur vers la page de laquelle proviennent les informations
                return redirectBack();
            }
        }
        return render("pages/visitor/authentication/login.html.php");
    }