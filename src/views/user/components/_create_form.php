<form action="index.php?entity=user&action=signup" method="post" autocomplete="off">
    <?= $csrf_token ?>
    <?php
    include '_login_form_inputs.php';
    include '_create_form_inputs.php';
    ?>
    <p>
        <input type="submit" class='btn btn-warning' value="Créer mon compte" tabindex="5">
    </p>
</form>