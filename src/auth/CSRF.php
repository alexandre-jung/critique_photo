<?php

/**
 * csrf.php
 * CSRF tokens for project 230-TP04_Php_Poo_Critique_photo
 */


namespace auth;


class CSRF {

    private string $token;
    private int $timestamp;
    private int $validity;

    public function __construct() {
        $this->generate();
    }

    public function generate(int $length = 32, int $validity = 600): string {
        $this->token = bin2hex(random_bytes($length));
        $this->timestamp = time();
        $this->validity = $validity;
        return $this->token;
    }

    public function check(string $token) {
        if ((time() - $this->validity) < $this->timestamp) {
            return hash_equals($this->token, $token);
        }
        return false;
    }

    public function __toString() {
        return "<input type='hidden' name='csrf_token' value='$this->token'>";
    }
}