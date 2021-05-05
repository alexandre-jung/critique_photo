<?php

/**
 * Http404.php
 * Exception for http 404 errors for project 230-TP04_Php_Poo_Critique_photo
 */


namespace exceptions\http;


class Http403 extends HttpException {

    public function __construct(string $message = 'Forbidden') {
        parent::__construct(403, $message);
    }
}