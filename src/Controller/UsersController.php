<?php

namespace Controller;

use View\View;
use Models\Users\Users;
use Exeptions\InvalidUserData;

class UsersController
{

    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../templates');


    }

    public function signUp()
    {

        if (!empty($_POST)) {
            try {
                $user = Users::signUp($_POST);

            } catch (InvalidUserData $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }
            if ($user instanceof Users) {
                $this->view->renderHtml('users/sacsfullReg.php');
            }

        }

        $this->view->renderHtml('users/signUp.php');

    }

}