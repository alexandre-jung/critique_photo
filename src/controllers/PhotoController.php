<?php

/**
 * PhotoController.php
 * PhotoController class for project 230-TP04_Php_Poo_Critique_photo
 */


namespace controllers;

use dao\PhotoManager;
use dao\CommentManager;
use models\PhotoModel;

class PhotoController extends BaseController {

    private PhotoManager $manager;

    public function __construct() {
        parent::__construct();
        $this->manager = new PhotoManager();
    }

    public function list(array $context = []) {
        $photos = $this->manager->all('created', true);
        $context['photos'] = $photos;
        $context['title'] = 'Dernières photos publiées';
        $this->render('photo/list', $context);
    }

    public function publish(array $context = []) {

        // Visitor: redirect to the login page
        $user = $_SESSION['user'] ?? null;
        if (!$user) {
            header('Location: index.php?entity=user&action=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Check POST request data and process uploaded file
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $file = null;
            if (isset($_FILES['photo'])) {
                $file = $_FILES['photo'];
                $name = $file['name'];
                $type = $file['type'];
                $tmp_sname = $file['tmp_name'];
                $error = $file['error'];
                $size = $file['size'];
                $ext = pathinfo($name, PATHINFO_EXTENSION);
            }

            if (
                $file &&
                $error == 0 &&
                $size < 2000000 &&
                $type == 'image/jpeg' &&
                $ext == 'jpg' || $ext == 'jpeg'
            ) {
                // Make destination path and copy to media/
                $dst_name = bin2hex(random_bytes(12));
                $file_path = "media/$dst_name.$ext";
                move_uploaded_file($tmp_sname, $file_path);

                // Create the model and save it to database
                $photo = PhotoModel::create($title, $file_path, $user->getId());
                $this->manager->add($photo);

                // Photo successfully published
                header('Location: index.php');
            }
        }

        // GET from connected user: display publish form view
        $context['formTitle'] = 'Publier une photo';
        $this->render('photo/publish', $context);
    }

    public function view(array $context = []) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $photo = $this->manager->getById($id);
        $title = $photo->getTitle();

        // get comments
        $manager = new CommentManager();
        $comments = $manager->getCommentsOnPhoto($photo->getId());

        $context['photo'] = $photo;
        $context['title'] = $title;
        $context['comments'] = $comments;
        $context['from'] = 'photo/view/' . $photo->getId();

        // // Generate a CSRF token
        // $token = new \CSRF();
        // $context['csrf_token'] = $token;
        // $_SESSION['csrf_token'] = $token;

        $this->render('photo/view', $context);
    }

    public function delete(array $context = []) {

        $user = $_SESSION['user'] ?? null;
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        // Get photo && current user
        $photo = $this->manager->getById($id);

        // If user is connected, photo exists and user is the owner, delete the photo
        if ($user && $photo && ($user->getId() == $photo->getId_User())) {
            $file = $photo->getFile();
            if ($this->manager->delete($photo)) {
                unlink($file);
                header('Location: index.php');
            }
        } else {
            echo 'Non autorisé';
            die();
        }
    }
}