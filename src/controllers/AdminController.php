<?php

/**
 * AdminController.php
 * AdminController class for project 230-TP04_Php_Poo_Critique_photo
 */


namespace controllers;

use dao\PhotoManager;

class AdminController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function home(array $context = []) {
        $user = $_SESSION['user'] ?? null;
        if ($user && $user->isAdmin()) {
            $context['title'] = "Section d'administration du site";
            $this->render('admin/home', $context);
            exit();
        }
        echo 'Accès interdit';
        die();
    }

    public function cleanMediaFiles(array $context = []) {
        $user = $_SESSION['user'] ?? null;
        if ($user && $user->isAdmin()) {
            $photos = (new PhotoManager())->all();

            $mediaFiles = scandir('media');
            $mediaFiles = array_diff($mediaFiles, ['.', '..']);

            $toKeep = [];
            foreach ($photos as $photo) {
                $toKeep[] = basename($photo->getFile());
            }

            $toDelete = array_diff($mediaFiles, $toKeep);

            foreach ($toDelete as $delFile) {
                unlink('media/' . $delFile);
            }
            header('Location: index.php?entity=admin');
        }
        echo 'Accès interdit';
        die();
    }
}