<?php

/**
 * UserModel.php
 * User model class for project 230-TP04_Php_Poo_Critique_photo
 */


namespace models;


class UserModel extends BaseModel {

    private string $login;
    private string $hash;
    private string $pseudo;
    private bool $is_admin;

    public static function create($login, $password, $pseudo, $is_admin = false): UserModel {
        $user = new UserModel();
        $user->setLogin($login);
        $user->setPassword($password);
        $user->setPseudo($pseudo);
        $user->setIs_admin($is_admin);
        return $user;
    }

    private function __construct() {
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function setLogin(string $login): UserModel {
        $this->login = $login;
        return $this;
    }

    public function getPseudo(): string {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): UserModel {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getHash(): string {
        return $this->hash;
    }

    public function setPassword(string $password): UserModel {
        $this->hash = password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }

    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->hash);
    }

    public function getIs_admin(): int {
        return $this->is_admin;
    }

    public function setIs_admin(bool $admin) {
        $this->is_admin = $admin;
    }

    public function isAdmin(): bool {
        return $this->is_admin;
    }
}