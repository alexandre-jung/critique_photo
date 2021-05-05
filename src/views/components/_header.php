<header class='navbar navbar-expand-md navbar-dark bg-dark p-3'>
    <div class="container">
        <div class='navbar-nav flex-row'>
            <a href="index.php" class="navbar-brand fs-3 fw-bold">Critique photo</a>
        </div>

        <?php if ($user) : ?>
        <div class="navbar-nav flex-row">
            <a class='btn btn-outline-warning fw-bold' href="index.php?entity=photo&action=publish">+ Publier une
                photo</a>
        </div>
        <?php endif ?>


        <div class="navbar-nav flex-row">
            <?php if ($user) : ?>
            <span class="navbar-text me-4 fw-bold">
                <span class='text-light'><?= $user->getPseudo() ?></span>
                <small class='fw-bold'>
                    <!-- <?= $user->getIs_admin() ? ' (Administrateur)' : '' ?> -->
                    <?php
                        if ($user->isAdmin())
                            echo "<a href='index.php?entity=admin' class='text-warning ms-2'>Administration</a>";
                        ?>
                </small>
            </span>
            <li class='navbar-nav flex-row ms-2'>
                <a class='btn btn-warning' href="index.php?entity=user&action=logout">Déconnexion</a>
            </li>
            <?php else : ?>
            <li class='navbar-nav flex-row ms-md-auto'>
                <a class='btn btn-outline-light me-2' href="index.php?entity=user&action=login">Connexion</a>
            </li>
            <li class='navbar-nav flex-row ms-2'>
                <a class='btn btn-warning' href="index.php?entity=user&action=signup">Créer un compte</a>
            </li>
            <?php endif ?>
        </div>
    </div>
</header>