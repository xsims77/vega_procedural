<?php $theme = "themes/baseUser.html.php"; ?>

<?php
$title = <<<HTML
Modification de profil
HTML;
?>

<?php
$description = <<<HTML
Modification de profil
HTML;
?>

<h1 class="text-center my-3 display-5">Modifier mon profil</h1> 


<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto p-4 shadow bg-white">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="firstName">Prénom</label>
                    <input type="text" name="firstName" id="firstName" class="from-control" autofocus value="<?= old('fistName') ?: $user['firstName']; ?>">
                </div>
                <div class="mb-3">
                    <label for="lastName">Nom</label>
                    <input type="text" name="lastName" id="lastName" class="from-control" value="<?= old('lastName') ?: $user['lastName']; ?>">
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="from-control" value="<?= old('email') ?: $user['email']; ?>">
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary shadow" value="Modifier">
                </div>
            </form>
        </div>
    </div>
</div>