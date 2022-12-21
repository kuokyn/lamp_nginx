<?php

include_once(ROOT . '/model/Request.php');

class RequestsController
{
    private $uri;
    private $request_model;
    public function __construct($uri) {
        $this->uri = $uri;
        $this->request_model = new Request();
    }

    public function processMethod(): void
    {
        switch ($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                if ($this->uri == "requests") {
                    $result = $this->request_model->getRequestList();
                    include_once(ROOT . '/private/requests.php');
                } else {
                    include_once(ROOT . '/view/contacts.php');
                }
                break;
            case 'POST':
                if ($_POST["action"] == "delete"){
                    $id = $_POST["id"];
                    $deleted = $this->request_model->deleteRequest($id);
                    if ($deleted) {
                        echo json_encode([
                            "message" => "Request $id was deleted",
                            "deleted" => $deleted
                        ]);
                    } else {
                        echo json_encode([
                            "message" => "Request $id was NOT deleted",
                            "deleted" => $deleted
                        ]);
                    }
                } else if ($_POST["action"] == "create") {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $service = $_POST['service'];
                    $message = $_POST['message'];
                    $created = $this->request_model->createRequest($name, $email, $service, $message);
                   if ($created) {
                       echo json_encode([
                           "message" => "Request was successfully added",
                           "deleted" => $created
                       ]);
                   } else {
                       echo json_encode([
                           "message" => "Request was NOT addded",
                           "created" => $created
                       ]);
                   }
                }
            default:
                break;
        }
    }

}