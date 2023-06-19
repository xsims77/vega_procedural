<?php

    /**
     * --------------------------------------------------------------------------
     *                      Amorçage de l'application
     * 
     * L'amorçage fait référence au processus de préparation de l'environnement avant qu'une application ne * démarre, pour résoudre et traiter une requête d'entrée. 
     * L'amorçage se fait en deux endroits : le script d'entrée et l'application.
     * 
     * Ses rôles :
     *     - Charger les (raccourcis) constances
     *     - Charger les variables d'environnement
     *     - Charger la configuration système
     *     - Charger la configuration session
     *     - Charger le monolog
     * -----------------------------------------------------------------------------
    */

    // Chargement des constantes 
    require __DIR__ . "/constants.php";


    // Charger et traitements des variables d'environnement
    require CONFIG . "/environnement.php";


    //Chargement de la configuration du système
    require CONFIG . "/system.php";


    //Chargement de la configuration session
    require CONFIG . "/session.php";


    //Chargement de la configuration monolog
    require CONFIG . "/monolog.php";
