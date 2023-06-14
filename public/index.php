<?php


    /**
     * -----------------------------------------------------------------------------
     *                      Bienvenue sur Vega
     * 
     * L'index.php représente le contrôleur frontal
     * https://en.wikipedia.org/wiki/Front_controller
     * 
     * Ses rôles:
     * 
     *  - Amorcer l'application (charger les fichiers de configuration)
     *  - Charger le noyau
     *  - Exécuter le noyau
     *  - Récupérer la réponse du noyau
     *  - Retourne cette réponse au serveur
     *  - Le serveur envoie la réponse au navigateur du client
     *  - Le navigateur affiche la réponse au client sous forme de page web
     * ------------------------------------------------------------------------------
     */


    // Amorçage de l'application
     require __DIR__ . "/../config/bootstrap.php";

     
    // Chargement du noyau de l'application
    require SRC . "/kernel.php";

    
    // Si le client essaie de récupérer la réponse du noyau via autre chose que le terminal
    if (php_sapi_name() !== "cli") 
    {
        //  Soumission de la requête et récupération de la réponse du noyau
        $response = handleRequest();
        
        // Affichage de cette réponse au client
        echo $response;
    }
