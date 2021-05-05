<?php

/**
 * UserModel.php
 * Class for managing users for project 230-TP04_Php_Poo_Critique_photo
 */


namespace dao;

use models\UserModel;


class UserManager extends BaseManager {

    public function __construct() {
        parent::__construct('user', 'UserModel');
    }

    public function getByLogin($login): ?UserModel {
        return parent::getBy('login', $login);
    }
}
