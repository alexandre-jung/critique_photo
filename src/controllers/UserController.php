<?php

/**
 * UserController.php
 * UserController class for project 230-TP04_Php_Poo_Critique_photo
 */


namespace controllers;

use dao\UserManager;
use models\UserModel;
use validators\PasswordValidator;
use validators\EmailValidator;

class UserController extends BaseController {

    private UserManager $connection;

    public function __construct() {
        parent::__construct();
        $this->connection = new UserManager();
    }

    public function signup(array $context = []) {

        // Default values
        $login = '';
        $pseudo = '';
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Get POST parameters
            $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $passwordCheck = filter_input(INPUT_POST, 'passwordCheck', FILTER_SANITIZE_STRING);
            $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);

            $passwordValidator = new PasswordValidator();
            $passwordOK = $passwordValidator->validate($password);

            $emailValidator = new EmailValidator();
            $emailOK = $emailValidator->validate($login);

            // Validate parameters
            if (!$passwordOK) {
                $error = 'Le mot de passe n\'est pas valide';
            } elseif (!$emailOK) {
                $error = 'L\'identifiant doit être une adresse email valide';
            } elseif ($password == $passwordCheck) {
                $user = UserModel::create($login, $password, $pseudo);
                $this->connection->add($user);

                $_SESSION['user'] = $user;
                header('Location: index.php?entity=user&action=success');
                exit();
            }
        }

        $context['js'] = ['login.js'];
        $context['login'] = $login;
        $context['pseudo'] = $pseudo;
        $context['error'] = $error;
        $context['formTitle'] = 'Créez votre compte';
        $this->render('user/signup', $context);
    }

    public function login(array $context = []) {

        // Already logged in: redirect to home
        $user = $_SESSION['user'] ?? null;
        if ($user) {
            header('Location: index.php');
            exit();
        }

        // Default variables
        $error = $context['error'] ?? null;
        $login = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Authentication: verify login and password
            $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $from = filter_input(INPUT_POST, 'from', FILTER_SANITIZE_STRING);
            $user = $this->connection->getByLogin($login);

            if (!$login || !$password) {
                $error = 'Vous devez remplir les champs !';
            } elseif ($user && $user->verifyPassword($password)) {

                $to = 'index.php';
                if ($from) {
                    $params = explode('/', $from);
                    if (count($params) == 3) {
                        list($e, $a, $id) = $params;
                    }
                    $to .= "?entity=$e&action=$a&id=$id";
                }

                // Login OK: redirect to home
                $_SESSION['user'] = $user;
                header('Location: ' . $to);
                exit();
            } else {
                // Login error: set $error
                $error = 'Identifiant ou mot de passe incorrect';
            }
        }

        // Get request / error
        $from = filter_input(INPUT_GET, 'from', FILTER_SANITIZE_STRING);
        $context['error'] = $error;
        $context['login'] = $login;
        $context['from'] = $from;
        $context['js'] = ['login.js'];
        $context['formTitle'] = 'Connectez-vous';
        $this->render('user/login', $context);
    }

    public function success(array $context = []) {
        $this->render('user/success', $context);
    }

    public function logout() {
        session_destroy();
        session_write_close();

        header('Location: index.php');
        exit();
    }
}