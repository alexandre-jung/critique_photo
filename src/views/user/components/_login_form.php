<form action="index.php?entity=user&action=login" method="post">
    <?= $csrf_token ?>
    <?php if (isset($from)) {
        echo "<input type='hidden' name='from' value='$from'>";
    } ?>
    <?php include '_login_form_inputs.php' ?>
    <p>
        <input type="submit" class='btn btn-warning' value="Me connecter" tabindex="3">
    </p>
</form>