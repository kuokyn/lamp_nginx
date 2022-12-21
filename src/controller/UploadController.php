<?php

include_once(ROOT . '/model/User.php');

class UploadController
{
    private $uri;
    public function __construct($uri) {
        $this->uri = $uri;
    }

    public function processMethod(): void
    {
        switch ($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                if ($this->uri == "upload") {
                    include_once(ROOT . '/private/upload.php');
                }
                break;
            case 'POST':
                    include(ROOT . "/private/uploader.php");
                break;
            default:
                break;
        }
    }

}