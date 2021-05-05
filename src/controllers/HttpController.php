<?php

/**
 * HttpController.php
 * Controller for rendering error pages for project 230-TP04_Php_Poo_Critique_photo
 */


namespace controllers;

use controllers\BaseController;
use exceptions\http\Http500;

class HttpController extends BaseController {

    private $code = 500;

    public function __construct() {
        parent::__construct();
    }

    public function render(string $view, array $context = []) {

        $error = $context['error'] ?? new Http500();

        $subView = "{$this->getDirectory()}http/{$error->getCode()}.php";

        if (!file_exists($subView)) {
            $subView = 'views/http/500.php';
        }

        $context['title'] = $error->getMessage();
        $context['subView'] = $subView;

        http_response_code($error->getCode());
        parent::render($view, $context);
        exit();
    }
}