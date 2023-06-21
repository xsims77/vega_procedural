<?php 
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

    function register() : string
    {

        // Si le formulaire est soumis comme cela se doit
        if ( isFormSubmitted($_POST) )
        {

            // die('pause');test de formulaire

            // Charger le validateur
            require VALIDATOR;


            // Demander au validateur de valider les données
            // Récupérer la réponse du validateur
            $errors = makeValidation(
                $_POST,
                [
                    "firstName" => ["required", "string", "max:255", "regex:/^[a-zA-Z-_]+$/"],
                    "lastName"  => ["required", "string", "max:255", "regex:/^[a-zA-Z-_]+$/"],
                    "email"     => ["required", "string", "max:255", "email", "unique:user,email"],
                    "password"  => ["required", "string", "min:12", "max:255", "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/"],
                    "confirmPassword"  => ["required", "string", "min:12", "max:255", "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/", "same:password"]
                ],
                [
                    "firstName.required" => "Le prénom est obligatoire.",
                    "firstName.string"   => "Veuillez entrer une chaine de caractères.",
                    "firstName.max"      => "Le prénom ne doit pas dépasser 255 caractères.",
                    "firstName.regex"    => "Le prénom ne doit pas contenir de chiffre.",

                    "lastName.required"  => "Le nom est obligatoire.",
                    "lastName.string"    => "Veuillez entrer une chaine de caractères.",
                    "lastName.max"       => "Le nom ne doit pas dépasser 255 caractères.",
                    "lastName.regex"     => "Le nom ne doit pas contenir de chiffre.",

                    "email.required"     => "L'email est obligatoire.",
                    "email.string"       => "Veuillez entrer une chaine de caractères.",
                    "email.max"          => "L'email ne doit pas dépasser 255 caractères.",
                    "email.email"        => "Veuillez entrer un email valide.",
                    "email.unique"       => "Impossible de créer un compte avec cet email.",

                    "password.required"     => "Le mot de passe  est obligatoire.",
                    "password.string"       => "Veuillez entrer une chaine de caractères.",
                    "password.min"          => "Le mot de passe doit contenir au moins 12 caractères.",
                    "password.max"          => "Le mot de passe ne doit pas dépasser 255 caractères.",
                    "password.regex"        => "Le mot de passe doit contenir au moins une lettre minuscule, majuscule, un chiffre et un caractère spécial.",

                    "confirmPassword.required"     => "Le mot de passe  est obligatoire.",
                    "confirmPassword.string"       => "Veuillez entrer une chaine de caractères.",
                    "confirmPassword.min"          => "Le mot de passe doit contenir au moins 12 caractères.",
                    "confirmPassword.max"          => "Le mot de passe ne doit pas dépasser 255 caractères.",
                    "confirmPassword.regex"        => "Le mot de passe doit contenir au moins une lettre minuscule, majuscule, un chiffre et un caractère spécial.",
                    "confirmPassword.same"         => "Le mot de passe doit être identique à sa confirmation.",
                    
                ]
            );

            // Si le validateur dit qu'il y a des erreurs
            if ( count($errors) > 0 ) 
            {
                // Sauvegarder les anciennes données en session
                $_SESSION['old'] = getOldValues($_POST);

                // Sauvagarder les messages d'erreurs en session
                $_SESSION['form_errors'] = $errors;
    
                // Redirige l'utilisateur vers la page de laquelle proviennent les informations
                // Arrêter l'exécution du script
                return redirectBack();
            }

            // Dans le cas contraire,

            // Appeler la manager de la table "user" (model)
            require USER;

            $cleanData = getOldValues($_POST);

            // Demander au manger d'insérer le nouvel utilisateur dans la table "user"
            createUser($cleanData);

            // Généner le message flash attestant de la réussite de la requête
            $_SESSION['success'] = "Votre compte a bien été créé, veuillez vous connecter.";

            // Rediriger l'utilisateur vers la page de connexion             
            // Arrêter l'exécution du script
            return redirectToUrl('/');
        }
        
        return render("pages/visitor/registration/register.html.php");
    }


?>