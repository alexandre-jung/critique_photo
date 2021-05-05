<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4" style='position: relative; top: -24px;'>

    <?php
    if (isset($photos) && $photos) {
        foreach ($photos as $photo) {
    ?>

    <div class="col mt-4">
        <a href='index.php?entity=photo&action=view&id=<?= $photo->getId() ?>'
            class="card text-dark text-decoration-none">
            <img src='<?= $photo->getFile() ?>' class="card-img-top" alt='<?= $photo->getTitle() ?>'>
            <div class="card-body">
                <h5 class='card-title'>
                    <?php if ($photo->getTitle()) : ?>
                    <span class='fw-bold'>
                        <?= $photo->getTitle() ?>
                    </span>
                    <?php else : ?>
                    <div class="text-muted">Sans titre</div>
                    <?php endif ?>
                </h5>

                <em class="card-text small">
                    Publié par <?= $photo->fetchUser()->getPseudo() ?><br>
                    <small class='text-muted'>le <?= $photo->getCreated()->format('d/m/Y h:i') ?></small>
                </em>
            </div>
        </a>
    </div>

    <?php }
    } ?>

</div>