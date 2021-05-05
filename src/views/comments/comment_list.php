<?php

/**
 * comments/list.php
 * Affiche une liste de commentaires
 */


$nb = count($comments);
$displayNb = '';

switch ($nb) {
    case 0:
        $displayNb = 'Aucun commentaire';
        break;
    case 1:
        $displayNb = '1 commentaire';
        break;
    default:
        $displayNb = $nb . ' commentaires';
}

echo "<h3 class='mt-5 mb-3'>" . $displayNb . "</h3>";


if (!$comments) {
    echo "Il n'y a aucun commentaire sur cette photo";
}

?>


<?php foreach ($comments as $comment) : ?>
<?php include 'components/_comment.php'; ?>
<?php endforeach ?>

<div class="row mt-4">
    <div class="col-6">
        <?php
        if ($user) include 'components/_comment_form.php';
        else include 'components/_no_comment.php';
        ?>
    </div>
</div>