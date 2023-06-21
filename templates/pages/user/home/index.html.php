<?php $theme = "themes/baseUser.html.php"; ?>

<?php 
    $title = <<<HTML
Accueil
HTML;
?>

<?php 
    $description = <<<HTML
Accueil
HTML;
?>

<h1 class="text-center my-3 display-5">Hello <?= $_SESSION['user']['first_name']; ?></h1>