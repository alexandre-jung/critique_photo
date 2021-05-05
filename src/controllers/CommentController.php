<?php

/**
 * CommentController.php
 * CommentController class for project 230-TP04_Php_Poo_Critique_photo
 */


namespace controllers;

use dao\CommentManager;
use models\CommentModel;


class CommentController extends BaseController {

    private ?CommentManager $manager = null;

    public function __construct() {
        parent::__construct();
        $this->manager = new CommentManager();
    }

    public function add(array $context = []) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $user = $_SESSION['user'] ?? null;
            if ($user) {
                $photoId = filter_input(INPUT_POST, 'photoId', FILTER_SANITIZE_NUMBER_INT);
                $content = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $userId = $user->getId();
                $comment = new CommentModel($content, $userId, $photoId);
                $this->manager->add($comment);
                header('Location: index.php?entity=photo&action=view&id=' . $photoId);
                exit();
            }
        }

        // Unauthorised attempt
        echo 'Non autorisé';
        die();
    }

    public function delete(array $context = []) {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $user = $_SESSION['user'] ?? null;
            if ($user && $user->isAdmin()) {
                $commentId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                $from = filter_input(INPUT_GET, 'from', FILTER_SANITIZE_STRING);

                $to = 'index.php';
                if ($from) {
                    $params = explode('/', $from);
                    if (count($params) == 3) {
                        list($e, $a, $id) = $params;
                    }
                    $to .= "?entity=$e&action=$a&id=$id";
                }

                $comment = $this->manager->getById($commentId);
                $this->manager->delete($comment);
                header('Location: ' . $to);
                exit();
            }
        }

        echo 'Non autorisé';
        die();
    }
}