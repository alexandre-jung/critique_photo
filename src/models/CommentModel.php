<?php

/**
 * CommentModel.php
 * Comment model class for project 230-TP04_Php_Poo_Critique_photo
 */


namespace models;

use DateTime;

class CommentModel extends BaseModel {

    private ?string $content;
    private ?string $created = null;
    private ?int $id_User;
    private ?int $id_Photo;
    private ?string $userPseudo = null;

    public function __construct(?string $comment = null, ?int $userId = null, ?int $photoId = null) {
        $this->content = $comment;
        $this->id_User = $userId;
        $this->id_Photo = $photoId;
    }

    public function hydrate(array $data): void {

        foreach ($data as $field => $value) {
            if (property_exists($this, $field)) {
                $this->$field = $value;
            }
        }
    }

    public function getContent() {
        return $this->content;
    }


    public function getCreated() {
        return new DateTime($this->created);
    }


    public function getUserPseudo() {
        return $this->userPseudo;
    }

    public function getId_User() {
        return $this->id_User;
    }

    public function getId_Photo() {
        return $this->id_Photo;
    }

    public function getFieldNames(): array {
        $all = parent::getFieldNames();
        $all = array_diff($all, ['created', 'userPseudo']);
        return $all;
    }
}