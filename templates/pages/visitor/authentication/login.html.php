<?php $theme = "themes/baseVisitor.html.php"; ?>


<!-- On peut utiliser plusieur manière de faire pour le "title" -->
<!-- <?php $title = "Hello"; ?> -->

<?php
$title = <<<HTML
Connexion
HTML;
?>
<?php
$title = <<<HTML
Connectez-vous!
HTML;
?>

<h1 class="text-center my-3 display-5">Connexion</h1>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-5 mx-auto p-4 shadow bg-white">

        <?php if(isset($_SESSION['bad_credentials']) && !empty($_SESSION['bad_credentials']) ) : ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= $_SESSION['bad_credentials']; ?>
            </div>
            <?php unset($_SESSION['bad_credentials']); ?>
        <?php endif ?>

            <form method="post">
                <div class="mb-3">
                    <label for="email">Email</label>
                    <div class="text-danger"><?= formErrors('email'); ?></div>
                    <input type ="email" class="form-control" name="email" id="email" autofocus value="<?= old('email')?>">
                </div>
                <div class="mb-3">
                    <label for="password">Mot de passe</label>
                    <div class="text-danger"><?= formErrors('password'); ?></div>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="mb-3 d-none">
                    <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
                </div>
                <div class="mb-3 d-none">
                    <input type="hidden" name="honey_pot" value="">
                </div>
                <div class="mb-3">
                    <input formnovalidate type="submit" class="btn btn-primary shadow" value="Se connecter">
                </div>
            </form>
        </div>
    </div>
</div>