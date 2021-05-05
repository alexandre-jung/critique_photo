<?php
if (isset($subView)) {
    include $subView;
}
if (!$fatal) {
    echo "<a href='index.php' class='btn btn-warning'>Retourner à l'accueil</a>";
}