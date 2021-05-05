<?php

if (isset($detail) && $detail) {
    echo "<p>$detail</p>";
} else {
    echo '<p>Le serveur a rencontré une erreur</p>';
}