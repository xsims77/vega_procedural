<?php
declare(strict_types=1);



    /**
     * Cette fonction se charge de retourner le contenu de la vue génerée.
     *
     *  
     * @param string $view_path
     * @param array $params
     * 
     * @return string
     */
    function render(string $view_path, array $params =[]) : string
    {

        ob_start();
        extract($params);
        require TEMPLATES . "/$view_path";
        $content = ob_get_clean();


        if (isset($theme) && !empty($theme)) 
        {
            ob_start();
            require TEMPLATES . "/$theme";
            return ob_get_clean();    
        }
        return $content;
    }


    /**
     * Cette fonction se charge de vérifier si :
     * _ Les données ont bien été envoyées au serveur via la méthode POST
     * _ La protection CSRF est valide
     * _ Le pot de miel a capturé un robot spameur ou non 
     *
     * @param array $dataArray
     * 
     * @return boolean
     */
    function isFormSubmitted(array $formData) : bool
    {
        // Si les données arrivent au serveur via la méthode http : "POST",
        if ( $_SERVER['REQUEST_METHOD'] === "POST" ) 
        {
            // Protection contre les failles de type CSRF
            if ( isset($_SESSION['csrf_token']) && !empty($_SESSION['csrf_token']) ) 
            {
                if ( $_SESSION['csrf_token'] !== $formData['csrf_token'] ) 
                {
                    unset($_SESSION['csrf_token']);
                    return false;
                }
            }
            unset($_SESSION['csrf_token']);

            // Protection contre les spams grâce au pot de miel
            if ( isset($formData['honey_pot']) ) 
            {
                if ( $formData['honey_pot'] !== "" ) 
                {
                    return false;
                }
            }

            return true;
        }

        return false;
    }


    /**
     * Cette fonction génère le jeton de sécurité contre les failles de types CRSF
     * et le stock en session
     *
     * @return string
     */
    function csrf_token() : string
    {
        $token = bin2hex(random_bytes(30));

        $_SESSION['csrf_token'] = $token;

        return $token;
    }

    /**
     * Cette fonction affiche les données et termine immédiatement l'exécution du script.
     *
     * @param mixed $data
     * @return void
     */
    function dd(mixed $data)
    {
        var_dump($data);
        die();
    }

    /**
     * Cette fonction affiche les données.
     *
     * @param mixed $data
     * @return void
     */
    function dump(mixed $data)
    {
        var_dump($data);
    }
