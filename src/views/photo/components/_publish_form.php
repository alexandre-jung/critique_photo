<form action="index.php?entity=photo&action=publish" method="post" enctype="multipart/form-data">
    <?= $csrf_token ?>
    <p class='form-group'>
        <label for="">Choisissez la photo à publier</label><br>
        <input type="file" class='form-control' name="photo" id="photo" accept="image/jpeg">
    </p>
    <p class='form-group'>
        <label for="">Titre de la photo</label><br>
        <input type="text" class='form-control' name="title" id="title">
    </p>
    <p>
        <input type="submit" class='btn btn-warning' value="Publier">
    </p>
</form>