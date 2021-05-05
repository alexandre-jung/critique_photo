<?php

/**
 * Dao.php
 * Data access object for project 230-TP04_Php_Poo_Critique_photo
 */


namespace dao;

use exceptions\http\Http500;

class Dao {

    public static function connect(string $name = 'default') {

        // Load database configuration into local variables
        require_once '../var/config.php';
        $config = \config\DATABASE[$name];
        extract($config);

        // Build DSN and return a PDO object
        $DSN = "mysql:host=$host;dbname=$dbname;charset=utf8";
        try {
            $pdo = new \PDO($DSN, $user, $password);
        } catch (\PDOException $e) {
            throw new Http500('Le site est actuellement indisponible');
        }
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function getPhotoComments(int $photoId) {

        $sql = "SELECT
        c.id,
        content,
        created,
        id_Photo,
        id_User,
        pseudo AS userPseudo
        FROM comment AS c
        JOIN user AS u ON u.id = c.id_User
        WHERE c.id_Photo = :id_Photo
        ORDER BY c.created DESC";

        $connexion = self::connect();
        $request = $connexion->prepare($sql);
        $request->execute(['id_Photo' => $photoId]);
        return $request->fetchAll(\PDO::FETCH_ASSOC);
    }
}