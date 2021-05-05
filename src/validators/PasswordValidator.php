<?php

namespace validators;

class PasswordValidator {

    public function validate(string $password): bool {

        $number = preg_match('/\d/', $password);
        $lowercase = preg_match('/[a-z]/', $password);
        $uppercase = preg_match('/[A-Z]/', $password);
        $special = preg_match('/[\W_]/', $password);

        return (strlen($password) >= 8 &&
            $number &&
            $lowercase &&
            $uppercase &&
            $special);
    }
}