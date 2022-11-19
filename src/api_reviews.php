<?php
$mysqli = new mysqli("MYSQL", "user", "toor", "appDB");
header('Content-Type: application/json');
try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            addReview($mysqli);
            break;
        case 'DELETE':
            deleteReview($mysqli);
            break;
        case 'PUT':
            updateReview($mysqli);
            break;
        case 'GET':
            getReview($mysqli);
            break;
        default:
            response('Invalid Mode');
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    response($message);
};

function addReview($mysqli)
{
    $json = file_get_contents('php://input');
    $review = json_decode($json);
    if (!empty($review->{'name'}) && !empty($review->{'service'}) && !empty($review->{'message'})) {
        $name = $review->{'name'};
        $service = $review->{'service'};
        $message = $review->{'message'};
        $query = "INSERT INTO reviews (name, service, message) VALUES (?, ?, ?);";
        $stmt = $mysqli->prepare($query);
        if ($stmt)
            $stmt->bind_param("sss", $name, $service, $message);
        if ($stmt->execute()) {
            $output = 'Review is successfully added';
            response($output);
            $mysqli->close();
        } else {
            $output = 'Review is not added';
            response( $output);
        }
    } else {
        response( 'No input');
    }
}

function deleteReview($mysqli)
{
    if (!isset($_GET['id'])) {
        throw new Exception("No input provided");
    }
    $id = $_GET['id'];
    $stmt = $mysqli->prepare("SELECT * FROM reviews WHERE id = ?;");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    if ($stmt->num_rows === 1) {
        $query = "DELETE FROM reviews WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $id);
        if ($stmt->execute()) {
            response("Removed review $id");
        } else {
            response( "Review is not updated");
        }
        $mysqli->close();
    } else {
        $message = 'Review with id=' . $id . ' does not exist';
        response( $message);
    }
}

function updateReview($mysqli)
{
    $json = file_get_contents('php://input');
    $review = json_decode($json);
    if (!empty($review->{'id'}) && !empty($review->{'name'}) && !empty($review->{'service'}) && !empty($review->{'message'})) {
        $id = $review->{'id'};
        $name = $review->{'name'};
        $service = $review->{'service'};
        $message = $review->{'message'};
        $stmt = $mysqli->prepare("SELECT * FROM reviews WHERE id = ?;");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id);
        if ($stmt->num_rows === 1) {
            $query = "UPDATE reviews SET name = ?, service =?, message = ? WHERE id= ?;";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('ssss', $name, $service, $message, $id);
            if ($stmt->execute()) {
                response("Review is updated");
            } else {
                response( "Review is not updated");
            }
            $mysqli->close();
        } else {
            $message = $id . ' does not exist';
            response( $message);
        }
    } else {
        response( 'No input');
    }
}


function getReview($mysqli)
{
    if (!isset($_GET['id'])) {
        $answer = array();
        $result = $mysqli->query("SELECT * FROM reviews;");
        if ($result->num_rows > 0) {
            foreach ($result as $info) {
                $answer[] = $info;
            }
            $mysqli->close();
            echo json_encode($answer);
        } else {
            response("0 records");
        }
    } else {
        $id = $_GET['id'];
        $result = $mysqli->query("SELECT * FROM reviews WHERE id = '{$id}';");
        if ($result->num_rows === 1) {
            foreach ($result as $info) {
                echo json_encode($info);
            }
            $mysqli->close();
        } else {
            $message = 'Review with id=' . $id . ' does not exist';
            response($message);
        }
    }
}

function response($message)
{
    echo 'message: "' . $message . '"';
}
