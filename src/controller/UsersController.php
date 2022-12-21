<?php

include_once(ROOT . '/model/User.php');

class UsersController
{
    private $uri;
    private $user_model;
    public function __construct($uri) {
        $this->uri = $uri;
        $this->user_model = new User();
    }

    public function processMethod(): void
    {
        switch ($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                if ($this->uri == "users") {
                    $result = $this->user_model->getUserList();
                    include_once(ROOT . '/private/users.php');
                }
            default:
                break;
        }
    }

}