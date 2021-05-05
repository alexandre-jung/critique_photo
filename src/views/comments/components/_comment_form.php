<form action="index.php?entity=comment&action=add" method="post">
    <?= $csrf_token ?>
    <input type="hidden" name="photoId" value='<?= $photo->getId() ?>'>
    <p class='form-group'>
        <label for="comment">Votre commentaire</label><br>
        <textarea class='form-control' cols="30" rows="6" name="comment" id="comment"></textarea>
    </p>
    <p><input type="submit" class='btn btn-warning' value="Envoyer"></p>
</form>