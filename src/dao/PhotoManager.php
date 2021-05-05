<?php

/**
 * PhotoManager.php
 * Class for managing photos for project 230-TP04_Php_Poo_Critique_photo
 */


namespace dao;

use models\PhotoModel;


class PhotoManager extends BaseManager {

    public function __construct() {
        parent::__construct('photo', 'PhotoModel');
    }

    public function getByUserId(int $userId): ?PhotoModel {
        return parent::getBy('id_User', $userId);
    }

    public function getById($id): ?PhotoModel {
        return parent::getById($id);
    }
}