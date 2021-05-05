<?php

/**
 * FrontController.php
 * Front controller for project 230-TP04_Php_Poo_Critique_photo
 */


namespace controllers;

use exceptions\http\Http404;
use exceptions\http\Http500;

class FrontController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->handleRequest();
    }

    public function home() {
        $controller = new PhotoController();
        $controller->list();
    }

    public function handleRequest() {

        $entity = filter_input(INPUT_GET, 'entity', FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

        switch ($entity) {

            case 'user':
                $controller = new UserController();
                switch ($action) {
                    case 'login':
                        $controller->login();
                        break;
                    case 'signup':
                        $controller->signup();
                        break;
                    case 'logout':
                        $controller->logout();
                        break;
                    case 'success':
                        $controller->success();
                        break;
                }
                break;

            case 'photo':
                $controller = new PhotoController();
                switch ($action) {
                    case 'publish':
                        $controller->publish();
                        break;
                    case 'view':
                        $controller->view();
                        break;
                    case 'delete':
                        $controller->delete();
                        break;
                }
                break;

            case 'comment':
                $controller = new CommentController();
                switch ($action) {
                    case 'add':
                        $controller->add();
                        break;
                    case 'delete':
                        $controller->delete();
                        break;
                }

            case 'admin':
                $controller = new AdminController();
                switch ($action) {
                    case 'clean_media_files':
                        $controller->cleanMediaFiles();
                        break;
                    default:
                        $controller->home();
                }
                break;

            default:
                $this->home();
        }
    }
}