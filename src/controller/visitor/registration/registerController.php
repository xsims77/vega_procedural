<?php 
declare(strict_types=1);

require ABSTRACT_CONTROLLER;

    function register() : string
    {

        // Si les données arrivent au serveur via la méthode http : "POST",
        if ($_SERVER["REQUEST_METHOD"] === "POST")
        {
            // Protection contre les failles de type CSRF

            // Protection contre les spams grâce au ^pot de miel

            // Charger le validateur

            // Demander au validateur de valider les données

            // Récupérer la réponse du validateur

            // Si le validateur dit qu'il y a des erreurs

                // Sauvegarder les anciennes données en session

                // Sauvagarder les messages erreurs

                // Redirige l'utilisateur vers la page de laquelle proviennent les informations
                // Arrêter l'exécution du script

            // Dans le cas contraire,

            // Appeler la manager de la table "user" (model)

            // Demander au manger d'insérer le nouvel utilisateur dans la table "user"

            // Généner le message flash attestant de la réussite de la requête

            // Rediriger l'utilisateur vers la page de connexion 
            
            // Arrêter l'exécution du script


        }
        
        return render("pages/visitor/registration/register.html.php");
    }


?>