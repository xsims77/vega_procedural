<?php $theme = "themes/baseUser.html.php"; ?>

<?php
$title = <<<HTML
Profil
HTML;
?>

<?php
$description = <<<HTML
Vega - Espace d'administration - Profil
HTML;
?>

<h1 class="text-center my-3 display-5">Mon profil</h1>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto shadow p-4 bg-white">
            <div class="card text-start">
                <div class="card-body">
                    <p class="card-text"><strong>Prénom</strong> : <?= protect($user['first_name']); ?> </p>
                    <p class="card-text"><strong>Nom</strong> : <?= protect($user['last_name']); ?> </p>
                    <p class="card-text"><strong>Email</strong> : <?= protect($user['email']); ?> </p>
                    <p class="card-text"><strong>Roles</strong> : 
                        <?php foreach(json_decode($user['roles']) as $role) : ?>
                            <?php if ($role === "ROLE_USER") :?>
                                <span class="badge text-bg-dark">Utilisateur</span>
                            <?php endif ?>
                        <?php endforeach ?>
                    </p>
                    <div class="d-flex justfy-content-center align-items-center my-3">
                        <a href="/user/profile/edit" class="btn btn-secondary m-2">Modifier le profil</a>
                        <a href="" class="btn btn-secondary m-2">Modifier le mot de passe</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>