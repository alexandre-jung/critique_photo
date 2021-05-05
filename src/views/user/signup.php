<?php

/**
 * signup.php
 * Account registration page for project 230-TP04_Php_Poo_Critique_photo
 */

?>


<div class="row justify-content-center">
    <div class="col col-md-8 col-lg-6 col-xl-4">
        <h2 class='mb-4'><?= $formTitle ?? '' ?></h2>
        <?php if ($error) : ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
        <?php endif;
        include 'components/_create_form.php';
        ?>
    </div>
</div>
<div class="row justify-content-center mt-2">
    <div class="col col-md-8 col-lg-6 col-xl-4">
        <div class="text-muted">
            Déjà inscrit ?
            <a href='index.php?entity=user&action=login' class='text-warning'>Identifiez-vous</a>
        </div>
    </div>
</div>