<?php

    // Récupérons la durée de vie de la session souhaitée en secondes
    $sessionLifeTime = $_ENV['SESSION_LIFE_TIME'] * 60;

    // Modification de la valeur dans le fichier de configuration prévu par PHP
    ini_set("session.gc_maxlifetime", $sessionLifeTime);

    // Modification du cookie de session
    session_set_cookie_params($sessionLifeTime);

    // activation de l'utilisation des sessions
    session_start();
    
    // test pour voir si la modification a bien été changer 
    // echo ini_get("session.gc_maxlifetime") / 60;

    //Chargement du monolog
    // require CONFIG . "/monolog.php";