<?php

/**
 * UserController.php
 * Base class for controllers for project 230-TP04_Php_Poo_Critique_photo
 */


namespace controllers;

use auth\CSRF;
use exceptions\http\Http403;


class BaseController {

    private string $directory;
    private string $base;

    public function __construct(string $directory = 'views/', string $base = 'base.php') {
        $this->directory = $directory;
        $this->base = $base;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$this->validate_csrf()) {

                $test = 'exceptions\http\HttpException';
                if (!($this instanceof HttpController)) {
                    throw new Http403('Accès refusé');
                }
            }
        }
    }

    public function getDirectory() {
        return $this->directory;
    }

    public function getBaseName() {
        return $this->base;
    }

    public function getBase() {
        return $this->directory . $this->base;
    }

    public function render(string $view, array $context = []) {
        $context['csrf_token'] = $this->generate_csrf();
        extract($context);
        $user = $_SESSION['user'] ?? null;
        $view = $this->directory . "$view.php";
        include $this->getBase();
    }

    public function generate_csrf() {
        $token = new CSRF();
        $context['csrf_token'] = $token;
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    public function validate_csrf() {
        $user_token = filter_input(INPUT_POST, 'csrf_token', FILTER_SANITIZE_STRING);
        $registered_token = $_SESSION['csrf_token'] ?? null;
        if ($registered_token && $user_token) {
            return $registered_token->check($user_token);
        }
        return false;
    }
}