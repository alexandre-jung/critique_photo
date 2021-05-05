<?php

namespace validators;


class EmailValidator {

    public function validate(string $email): bool {

        $regex = '/^[\w.-]+@\w+\.(\w{2,3})/';
        return preg_match($regex, $email);
    }
}