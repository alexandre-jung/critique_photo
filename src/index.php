<?php

/**
 * index.php
 * Website entry point for project 230-TP04_Php_Poo_Critique_photo
 */


use controllers\HttpController;
use exceptions\http\HttpException;

spl_autoload_register();
session_start();

try {
    $controller = new controllers\FrontController();
} catch (HttpException $exc) {
    $controller = new HttpController();
    $controller->render('http/error', [
        'error' => $exc,
        'detail' => $exc->isFatal() ? 'Merci de revenir plus tard' : null,
        'fatal' => $exc->isFatal(),
    ]);
}