<?php

/**
 * Http500.php
 * Exception for http 500 errors for project 230-TP04_Php_Poo_Critique_photo
 */


namespace exceptions\http;


class Http500 extends HttpException {

    public function __construct(string $message = 'Internal Server Error', bool $fatal = true) {
        parent::__construct(500, $message, $fatal);
    }
}