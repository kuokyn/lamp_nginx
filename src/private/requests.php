<?php
/*$requestMethod = $_SERVER["REQUEST_METHOD"];
header('Content-Type: application/json');
$con = new mysqli("MYSQL", "user", "toor", "appDB");
$answer = array();
switch ($requestMethod) {
    case 'GET':
        if (empty(isset($_GET['id']))) {
            $result = $con->query("SELECT * FROM `order`;");
            while ($row = $result->fetch_assoc()) {
                $answer[] = $row;
            }
        } else {
            $query_result = $con->query("SELECT * FROM `order` WHERE ID = " . $_GET['id'] . ";");
            $result = $query_result->fetch_row();
            $answer = $result;
        }
        if (!empty($result)) {
            http_response_code(200);
            echo json_encode($answer);
        } else {
            http_response_code(204);
        }
        break;
    case 'POST':
        $json = file_get_contents('php://input');
        $order = json_decode($json);
        if (!empty($order->{'name'}) && !empty($order->{'description'}) && !empty($order->{'price'})) {
            $name = $order->{'name'};
            $description = $order->{'description'};
            $price = $order->{'price'};
            $query_result = $con->query("SELECT * FROM `order` WHERE name='" . $name . "'");
            if (!empty($result)) {
                http_response_code(409);
            } else {
                $stmt = $con->prepare("INSERT INTO `order` (name, description, price) VALUES (?, ?, ?)");
                $stmt->bind_param('sss', $name, $description, $price);
                $stmt->execute();
                http_response_code(201);
            }
        } else {
            http_response_code(422);
        }

        break;
    case 'PUT':
        $json = file_get_contents('php://input');
        $order = json_decode($json);
        if (!empty($order->{'name'}) && !empty($order->{'price'})&& !empty($order->{'description'})) {
            if (empty(isset($_GET['id']))) {
                http_response_code(422);
            } else {
                $query_result = $con->query("SELECT * FROM `order` WHERE ID='" . $_GET['id'] . "'");
                $result = $query_result->fetch_row();
                if (!empty($result)) {
                    $query_result = $con->query("SELECT * FROM `order` WHERE name='" . $order->{'name'} . "' AND ID!='" . $_GET['id'] . "'");
                    $result = $query_result->fetch_row();
                    if (!empty($result)) {
                        http_response_code(409);
                    } else {
                        $con->query("UPDATE `order` SET name='" . $order->{'name'} . "', price='" . $order->{'price'} . "' WHERE ID='" . $_GET['id'] . "'");
                        http_response_code(200);
                    }
                } else {
                    http_response_code(204);
                }
            }
        } else {
            http_response_code(422);
        }
        break;
    case 'DELETE':
        if (empty(isset($_GET['id']))) {
            http_response_code(422);
        } else {
            $query_result = $con->query("SELECT * FROM `order` WHERE ID='" . $_GET['id'] . "'");
            $result = $query_result->fetch_row();
            if (!empty($result)) {
                $query_result = $con->query("DELETE FROM `order` WHERE ID='" . $_GET['id'] . "'");
                http_response_code(204);
            } else {
                http_response_code(204);
            }
        }
        break;
    default:
        http_response_code(405);
        break;
}
*/ ?>


<?php require_once '../dbconnect.php';
$mysqli=connect();
header('Content-Type: application/json');
try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            addRequest($mysqli);
            break;
        case 'DELETE':
            deleteRequest($mysqli);
            break;
        case 'PUT':
            updateRequest($mysqli);
            break;
        case 'GET':
            getRequest($mysqli);
            break;
        default:
            outputStatus(2, 'Invalid Mode');
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    outputStatus(2, $message);
};

function addRequest($mysqli)
{
    if (!isset($_GET['name']) || !isset($_GET['email']) || !isset($_GET['service'])) {
        throw new Exception("No input provided");
    }
    $name = $_GET['name'];
    $email = $_GET['email'];
    $service = $_GET['service'];
    $message = $_GET['message'];
    $query = "INSERT INTO requests (name, email. service, password) VALUES ('" . $name . "', '" . $email . "', '" . $service . "', '" . $message . "');";
    $mysqli->query($query);
    $mysqli->close();
    $output = 'Request is successfully added';
    outputStatus(0, $output);
}

function deleteRequest($mysqli)
{
    if (!isset($_GET['id'])) {
        throw new Exception("No input provided");
    }
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM requests WHERE id = '{$id}';");
    if ($result->num_rows === 1) {
        $query = "DELETE FROM requests WHERE id = '" . $id . "';";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Removed request ' . $id;
        outputStatus(0, $message);
    } else {
        $message = 'Request with id=' . $id . ' does not exist';
        outputStatus(1, $message);
    }
}

function updateRequest($mysqli)
{
    if (!isset($_GET['id']) || !isset($_GET['name']) || !isset($_GET['email']) || !isset($_GET['service']) || !isset($_GET['message'])) {
        throw new Exception("No input provided");
    }
    $id = $_GET['id'];
    $name = $_GET['name'];
    $email = $_GET['email'];
    $service = $_GET['service'];
    $message = $_GET['message'];
    $result = $mysqli->query("SELECT * FROM requests WHERE id = '{$id}';");
    if ($result->num_rows === 1) {
        $query = "UPDATE requests SET name = '" . $name . "',  email = '" . $email . "',  service = '" . $service . "', message = '" . $message . "' WHERE name = '" . $id . "';";
        $mysqli->query($query);
        $mysqli->close();
        outputStatus(0, $message);
    } else {
        $message = $id . ' does not exist';
        outputStatus(1, $message);
    }
}


function getRequest($mysqli)
{
    if (!isset($_GET['id'])) {
        throw new Exception("No input provided");
    }
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM requests WHERE id = '{$id}';");
    if ($result->num_rows === 1) {
        foreach ($result as $info) {
            echo "{status: 0, name: '" . $info['name'] . "}";
        }
        $mysqli->close();
    } else {
        $message = 'Request with id=' . $id . ' does not exist';
        outputStatus(1, $message);
    }
}

function outputStatus($status, $message)
{
    echo '{status: ' . $status . ', message: "' . $message . '"}';
}
