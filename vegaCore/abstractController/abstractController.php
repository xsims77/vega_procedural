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