<?php
declare(strict_types=1);

    /**
     * --------------------------------------------------------------------------
     *                          Le noyau
     * 
     * Le composant kernel fournit un processus structuré pour convertir une requête en réponse.
     * 
     * Le processus : 
     *  - Charger le routeur
     *  - Charger toutes les routes dont l'application attend la réception
     *  - Exécuter le routeur
     *  - Le routeur lui retourne comme réponse, le contrôleur en charge de la requête
     *  - Excécuter le contrôleur afin qu'il génère la réponse correspondant à la requête 
     *  - Récupérer cette réponse
     *  - Retourner cette réponse au contrôleur frontal
     * 
     * @author Sims 
     * @version 1.0.0
     * @copyright (c) 2023
     * -------------------------------------------------------------------------------
     */

    /**
     * Cette fonction du noyau permet de soumettre la requête du client et de récupérer la réponse correspondante
     *
     * @return string
     */
    function handleRequest() : string
    {
        
        // Chargement du routeur
        require VEGA_CORE . "/routing/router.php";

        // Si aucun contrôleur n'existe,
        if ( ! controller_exists()) 
        {
            // Affiche la page de bienvenue dans le framework
            return loadHttpKernelResources("defaultWelcome");

        }

        // Dans le cas contraire,

        // Charger les routes dont l'application attend la réception
        require CONFIG . "/routes.php";

        //Exécution du routeur et récupération de sa réponse
        $router_response = run();


        // Exécution du contrôleur pour générer la réponse correspondant à la requête
        // Récupération de cette réponse
        $controller_response = getControllerResponse($router_response);

        // Retour de cette réponse au contrôleur frontal

        return $controller_response;
    }

    /**
     * Cette fonction du routeur permet de récupérer la réponse générée 
     * par le contrôleur en charge de la requête
     *
     * @param string $router_response
     * @return array|null
     */
    function getControllerResponse(array|null $router_response)
    {
        if ($router_response === null)
        {
            generateLog(2, "L'url : $_SERVER[REQUEST_URI] n'a pas été trouvée.");
            http_response_code(404);
            return loadHttpKernelResources("notFound");
        }

        $controller = $router_response['controller'];
        $action     = $router_response['action'];

        if (isset($router_response['parameters']) && !empty($router_response['parameters'])) 
        {
            $parameters = $router_response['parameters'];

            require CONTROLLER . "/$controller.php";
            return $action(...$parameters);
        }
        
        require CONTROLLER . "/$controller.php";
        return $action();

    }

    /**
     * Cette fonction du noyau lui permet de charger une ressource
     *
     * @param string $resource_name
     * @return string
     */
    function loadHttpKernelResources(string $resource_name) : string
    {
        ob_start();
        require VEGA_CORE . "/httpKernel/resources/$resource_name.html.php";
        return ob_get_clean();
    }