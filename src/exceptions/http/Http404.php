<?php

/**
 * Http404.php
 * Exception for http 404 errors for project 230-TP04_Php_Poo_Critique_photo
 */


namespace exceptions\http;


class Http404 extends HttpException {

    public function __construct(string $message = 'Not Found') {
        parent::__construct(404, $message);
    }
}
