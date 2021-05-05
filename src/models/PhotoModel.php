<?php

/**
 * PhotoModel.php
 * Photo model class for project 230-TP04_Php_Poo_Critique_photo
 */


namespace models;

use dao\UserManager;

class PhotoModel extends BaseModel {

    private string $title;
    private ?string $created = null;
    private string $file;
    private int $id_User;

    public ?UserModel $user = null;

    public static function create(string $title, string $file, int $userId) {
        $photo = new PhotoModel;
        $photo->title = $title;
        $photo->file = $file;
        $photo->id_User = $userId;
        return $photo;
    }

    public function getCreated(): ?\DateTime {
        if ($this->created)
            return new \DateTime($this->created);
        return null;
    }

    public function getTitle() {
        return $this->title;
    }


    public function getFile() {
        return $this->file;
    }

    public function getId_User() {
        return $this->id_User;
    }

    public function getFieldNames(): array {
        $all = parent::getFieldNames();
        $all = array_diff($all, ['created', 'user']);
        return $all;
    }

    public function fetchUser(): UserModel {
        if ($this->user)
            return $this->user;
        $userManager = new UserManager();
        $this->user = $userManager->getById($this->id_User);
        return $this->user;
    }
}