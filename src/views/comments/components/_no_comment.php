<?php
$params = http_build_query([
    'entity' => 'user',
    'action' => 'login',
    'from' => 'photo/view/' . $photo->getId(),
]);
?>

<p>
    <a class='text-warning' href="index.php?<?= $params ?>">Identifiez-vous</a>
    pour commenter cette photo
</p>