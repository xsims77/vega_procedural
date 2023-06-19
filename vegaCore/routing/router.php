<?php
declare(strict_types=1);


    /**
     * --------------------------------------------------------------------------
     *                          Le routeur
     * --------------------------------------------------------------------------
     */

    /**
     * Cette méthode du routeur permet de générer la route dont l'application attend la réception via la méthode "GET"
     *
     * @param string $route_uri
     * @param array $route_action
     * 
     * @return void
     */
    function get(string $route_uri, array $route_action = []) : void
    {
        collectRoutes("GET", $route_uri, $route_action);
    }

    /**
     * Cette méthode du routeur permet de générer la route dont l'application attend la réception via la méthode "POST"
     *
     * @param string $route_uri
     * @param array $route_action
     * 
     * @return void
     */
    function post(string $route_uri, array $route_action = []) : void
    {
        collectRoutes("POST", $route_uri, $route_action);
    }
    
    /**
     * Cette méthode du routeur lui permet de collectionner les différentes routes 
     * dont l'application attend la réception.
     * Puis, elle se charge de les trier en fonction de leur méthode d'envoi dans un tableau
     * 
     *
     * @param string $http_method
     * @param string $route_uri
     * @param array $route_action
     * @return void
     */
    function collectRoutes(string $http_method, string $route_uri, array $route_action ) : void
    {
        global $routes;
        $route = [];

        $route[] = $route_uri;
        $route[] = $route_action;

        $routes[$http_method][] = $route;
    }

    /**
     * Cette méthode permet d'exécuter le routeur 
     *
     * @return array|null
     */
    function run() : ? array
    {
        global $routes;

        if ( !isset($routes) || empty($routes)) 
        {
            throw new Exception("No route found");
        }


        $request_uri = urldecode(parse_url(strip_tags(trim($_SERVER['REQUEST_URI'])), PHP_URL_PATH));
        
        foreach ($routes[$_SERVER['REQUEST_METHOD']] as $route) 
        {
            // var_dump(($route));
            $route_uri = $route[0];
            
            $pattern = preg_replace("#{[a-z]+}#", "([0-9a-zA-Z-_]+)", $route_uri);
            $pattern = "#^$pattern$#";
            if (preg_match($pattern, $request_uri, $matches)) 
            {
                array_shift($matches);
                $parameters = $matches;

                $controller = $route[1][0];
                $action     = $route[1][1];

                if ( isset($parameters) && !empty($parameters)) 
                {
                    return[
                        "controller" => $controller,
                        "action"     => $action,
                        "parameters" => $parameters
                    ];
                }

                return[
                    "controller" => $controller,
                    "action"     => $action
                ];
            }
        }
        return null;

    }

    /**
     * Cette fonction du routeur lui permet e vérifier si au moins un contrôleur existe
     *
     * @return boolean
     */
    function controller_exists() : bool
    {

        $controllers = [];

        $controllers_files =  new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(CONTROLLER),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($controllers_files as $file) 
        {
            if ( ($file->isFile()) && ($file->getExtension() === "php") ) 
            {
                $controllers[] = $file->getPathname();
            }
        }
        if (count($controllers) === 0) 
        {
            return false;
        }
        return true;
    }