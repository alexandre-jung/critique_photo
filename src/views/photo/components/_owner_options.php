<?php if (isset($user) && isset($photo)) {

    $isOwner = $user->getId() == $photo->getid_User();
    $isAdmin = $user->isAdmin();

    if ($isOwner) {
        echo "<span class='me-3'>Vous avez publié cette image</span>";
    }
    if (($isOwner) || $isAdmin) {
        $role = $isAdmin && !$isOwner ? ' (admin)' : '';
        echo "<a class='btn btn-danger' href='index.php?entity=photo&action=delete&id={$photo->getId()}'>Supprimer$role</a>";
    }
}