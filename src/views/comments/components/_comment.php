<div class="row">
    <div class="col mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>Par <?= $comment->getUserPseudo() ?> le <?= $comment->getCreated()->format('d/m/Y h:i') ?></div>
                <?php
                if (isset($user) && $user && $user->isAdmin()) {
                    $href = "index.php?entity=comment&action=delete&id={$comment->getId()}&from=$from";
                    echo "<div><a class='text-danger' href='$href'>Supprimer</a></div>";
                }
                ?>
            </div>
            <div class="card-body d-flex">
                <?= $comment->getContent() ?>
            </div>
        </div>
    </div>
</div>