<?php

/**
 * HttpException.php
 * Exceptions for http errors for project 230-TP04_Php_Poo_Critique_photo
 */


namespace exceptions\http;

use Exception;
use controllers\HttpController;

class HttpException extends \Exception {

    private bool $fatal;

    public function __construct(int $code = 500, string $message = '', bool $fatal = false) {
        parent::__construct($message, $code);
        $this->fatal = $fatal;
    }

    public function isFatal(): bool {
        return $this->fatal;
    }
}