<?php
declare(strict_types=1);

    /**
     * Cette fonction permet d'authentifier un utilisateur.
     *
     * @param array $formData
     * @return array|null
     */
    function authenticate(array $formData) : ?array
    {
        // Etablir la connexion avec la base de données
        require DB;

        // Effectuer la requête afin de vérifier si l'email envoyé par l'utilisateur correspond à celui d'un utilisateur de la table "user".
        $req = $db->prepare("SELECT * FROM user WHERE email=:email LIMIT 1");
        $req->bindValue(":email", $formData['email']);
        $req->execute();

        // Si l'email ne correspond pas,
        if ( $req->rowCount() !== 1) 
        {
            // Retourne une valeur nulle
            return null;
        }

        // Dans le cas contraire,

        //Récupérons les données de l'utilisateur en question 
        $user = $req->fetch();
        $req->closeCursor();

        // Verifie si le mot de passe envoyé par l'utlisateur correspond à celui de l'utilisateur hashé dans la base de données.
        // Si le mot de passe ne correspond pas,
        if ( ! password_verify($formData['password'], $user['password']) ) 
        {
            // Retourne une valeur nulle.
            return null;
        }



        // Dans le cas contraire,
        // Retourne une tableau contenant les données de l'utilisateur
        return $user;
    }
