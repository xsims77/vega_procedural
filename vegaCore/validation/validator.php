<?php 
declare(strict_types=1);

    function makeValidation(array $formDataArray, array $validationRulesArray, array $validationMessageArray) : array
    {
        // Protection contre les failles de type XSS
        $formDataArray = xssProtection($formDataArray);

        // Initialisation du tableau des erreurs
        $errors = [];
        
        // Pour chaque tableau de règle de validation du grand tableau de régles de validation
        foreach ($validationRulesArray as $inputName => $validationRules) 
        {
            // Vérifie si l'input dont on souhaite valider la valeur existe dans le tableau des données envoyées.
            // Si ce n'est pas le cas,
            if ( ! array_key_exists($inputName, $formDataArray)) 
            {
                // Levons une exception et arrêtons l'exécution du script
                throw new Exception("$inputName not found.");
            }

            // Dans le cas contraire,

            // Parcourir le tableau des règles de validation de chaque input
            foreach ($validationRules as $validationRule) 
            {
                // Parcourir le tableau de messages personnalisés pour chaque règle
                foreach ($validationMessageArray as $messageKey => $messageValue) 
                {
                    // Si le nom de la règle de validation est "required" et que son message personnalisé existe 
                    if ( ($validationRule === "required") && ($messageKey === "$inputName.required") ) 
                    {
                        // Procéder à la validation
                        // S'il y a des erreurs
                        if ( _required($formDataArray[$inputName]) ) 
                        {
                            // Remplir le tableau des erreurs avec les messages d'erreurs correspondant prévus.
                            $errors[$inputName][] = $messageValue;
                            
                        }                        
                    }                    
                    // Si le nom de la règle de validation est "string" et que son message personnalisé existe 
                    else if ( ($validationRule === "string") && ($messageKey === "$inputName.string") ) 
                    {
                        // Procéder à la validation
                        // S'il y a des erreurs
                        if ( _string($formDataArray[$inputName]) ) 
                        {
                            // Remplir le tableau des erreurs avec les messages d'erreurs correspondant prévus.
                            $errors[$inputName][] = $messageValue;
                            
                        }                        
                    }                    
                    // Si le nom de la règle de validation est "string max" et que son message personnalisé existe 
                    else if ( substr($validationRule, 0 ,3) === "max" && ($messageKey === "$inputName.max") ) 
                    {
                        // Procéder à la validation
                        // S'il y a des erreurs
                        if ( _max($formDataArray[$inputName], $validationRule) ) 
                        {
                            // Remplir le tableau des erreurs avec les messages d'erreurs correspondant prévus.
                            $errors[$inputName][] = $messageValue;
                            
                        }                        
                    }                    
                    // Si le nom de la règle de validation est "string min" et que son message personnalisé existe 
                    else if ( substr($validationRule, 0 ,3) === "min" && ($messageKey === "$inputName.min") ) 
                    {
                        // Procéder à la validation
                        // S'il y a des erreurs
                        if ( _min($formDataArray[$inputName], $validationRule) ) 
                        {
                            // Remplir le tableau des erreurs avec les messages d'erreurs correspondant prévus.
                            $errors[$inputName][] = $messageValue;
                            
                        }                        
                    }                    
                    // Si le nom de la règle de validation est "email" et que son message personnalisé existe 
                    else if ( ($validationRule === "email") && ($messageKey === "$inputName.email") ) 
                    {
                        // Procéder à la validation
                        // S'il y a des erreurs
                        if ( _email($formDataArray[$inputName]) ) 
                        {
                            // Remplir le tableau des erreurs avec les messages d'erreurs correspondant prévus.
                            $errors[$inputName][] = $messageValue;
                            
                        }                        
                    }   
                    // Si le nom de la règle de validation est "unique" et que son message personnalisé existe 
                    else if ( substr($validationRule, 0 ,6) === "unique" && ($messageKey === "$inputName.unique") ) 
                    {
                        // Procéder à la validation
                        // S'il y a des erreurs
                        if ( _unique($formDataArray[$inputName], $validationRule) ) 
                        {
                            // Remplir le tableau des erreurs avec les messages d'erreurs correspondant prévus.
                            $errors[$inputName][] = $messageValue;
                            
                        }                        
                    }                           
                    // Si le nom de la règle de validation est "regex" et que son message personnalisé existe 
                    else if ( substr($validationRule, 0 ,5) === "regex" && ($messageKey === "$inputName.regex") ) 
                    {
                        // Procéder à la validation
                        // S'il y a des erreurs
                        if ( _regex($formDataArray[$inputName], $validationRule) ) 
                        {
                            // Remplir le tableau des erreurs avec les messages d'erreurs correspondant prévus.
                            $errors[$inputName][] = $messageValue;
                            
                        }                        
                    }                           
                    // Si le nom de la règle de validation est "same" et que son message personnalisé existe 
                    else if ( substr($validationRule, 0 ,4) === "same" && ($messageKey === "$inputName.same") ) 
                    {
                        // Procéder à la validation
                        // S'il y a des erreurs
                        if ( _same($formDataArray[$inputName], $validationRule, $formDataArray) ) 
                        {
                            // Remplir le tableau des erreurs avec les messages d'erreurs correspondant prévus.
                            $errors[$inputName][] = $messageValue;
                            
                        }                        
                    }                           
                }
                
            }
        }
        // Retourner le tableau d'erreurs
        return $errors;
    }



    function getOldValues(array $data) : array
    {
        return xssProtection($data);
    }


    function _same(string $value, string $validationRule, array $formDataArray) : bool
    {
        $tab = explode(':', $validationRule);
        $key = $tab[1];
        $value_to_compare = $formDataArray[$key];

        if ( $value === $value_to_compare)
        {
            return false;
        }
        return true;
    }


    /**
     * Cette fonction du validateur lui permet de vérifier si la valeur envoyée par l'utilisateur correspond à l'expression régulière prévue.
     *
     * @param string $value
     * @param string $validationRule
     * @return boolean
     */
    function _regex(string $value, string $validationRule) : bool
    {
        $tab = explode(':', $validationRule);
        $pattern = $tab[1];

        if (preg_match($pattern, $value)) 
        {
            return false;
        }
        return true;
    }


    /**
     * Cette fonction du validateur lui permet de vérifier si la valeur envoyée par l'utilisateur existe déjà dans la table de la base de données ou non.
     *
     * @param string $value
     * @param string $validationRule
     * @return boolean
     */
    function _unique(string $value, string $validationRule) : bool
    {
        $tab = explode(':', $validationRule);
        $tab = explode(',', $tab[1]);

        $table = $tab[0];
        $column = $tab[1];
        

        require DB;

        $req = $db->prepare("SELECT * FROM {$table} WHERE {$column}=:{$column} LIMIT 1");
        $req->bindValue(":{$column}", $value);
        $req->execute();

        if( $req->rowCount() == 1 )
        {
            return true;
        }
        
        return false;
    }


    /**
     * Cette fonction du validateur lui permet de vérifire si la valeur est un email valide ou non.
     *
     * @param string $value
     * @return boolean
     */
    function  _email(string $value) : bool
    {
        if ( filter_var($value, FILTER_VALIDATE_EMAIL)) 
        {
            return false;
        }
        return true;
    }

    /**
     * Cette fonction du validateur lui permet de vérifier si la longueur de la chaine de caractère à vérifier ne soit pas inférieur à la longueur minimale prévue.
     *
     * @param string $value
     * @param string $validationRule
     * @return boolean
     */
    function _min(string $value, string $validationRule) : bool
    {
        $tab = explode(':', $validationRule);

        $min = $tab[1];

        
        if ( mb_strlen($value) < $min)
        {
            return true;
        }
        return false;
    }


    /**
     * Cette fonction du validateur lui permet de vérifier si la longueur de la chaine de caractère à vérifier dépasse la longueur maximale prévue.
     *
     * @param string $value
     * @param string $validationRule
     * @return boolean
     */
    function _max(string $value, string $validationRule) : bool
    {
        $tab = explode(':', $validationRule);
        
        $max = $tab[1];
        
        if ( mb_strlen($value) > $max)
        {
            return true;
        }
        return false;
    }


    /**
     * Cette fonction du validateur lui permet de vérifier si la valeur est une chaine de caratères ou non.
     *
     * @param string $value
     * @return boolean
     */
    function _string(string $value) : bool
    {
        if ( is_string($value)) 
        {
            return false;
        }
        return true;
    }


    /**
     * Cette fonction lui permet de vérifier si la valeur est vide ou non.
     * Elle retourne :
     *  - True s'il y a de erreurs
     *  - False dans le cas contraire
     *
     * @param string $value
     * 
     * @return boolean
     */
    function _required(string $value) : bool
    {
        // var_dump($value); die();test
        if ( isset($value) && !empty($value) ) 
        {
            return false;
        }
        return true;
    }


    /**
     * Cette fonction du validateur permet de protéger le serveur contre les failles de types XSS.
     *
     * @param array $formDataArray
     * @return array
     */
    function xssProtection(array $formDataArray) : array
    {
        unset($formDataArray['csrf_token']);
        unset($formDataArray['honey_pot']);

        $clean = [];

        foreach ($formDataArray as $key => $value) 
        {
            $clean[$key] = htmlspecialchars(addslashes(trim($value)));
        }

        return $clean;
    }