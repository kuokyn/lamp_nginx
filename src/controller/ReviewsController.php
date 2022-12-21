<?php

include_once(ROOT . '/model/Review.php');

class ReviewsController
{
    private $uri;
    private $review_model;
    public function __construct($uri) {
        $this->uri = $uri;
        $this->review_model = new Review();
    }

    public function processMethod(): void
    {
        switch ($_SERVER["REQUEST_METHOD"]) {
            case 'GET':
                if (isset($_GET["id"])) {
                    $result = $this->review_model->getReviewById($_GET["id"]);
                    include_once(ROOT . '/private/update_review.php');
                } else
                if ($this->uri == "reviews") {
                    $result = $this->review_model->getReviewList();
                    include_once(ROOT . '/private/reviews.php');
                } else {
                    $result = $this->review_model->getReviewList();
                    include_once(ROOT . '/view/reviews.php');
                }
                break;
            case 'POST':
                if ($_POST["action"] == "delete") {
                    $id = $_POST["id"];
                    $deleted = $this->review_model->deleteReview($id);
                    if ($deleted) {
                        echo json_encode([
                            "message" => "Review $id was deleted",
                            "deleted" => $deleted
                        ]);
                    } else {
                        echo json_encode([
                            "message" => "Review $id was NOT deleted",
                            "deleted" => $deleted
                        ]);
                    }
                } else if ($_POST["action"] == "create") {
                    if (isset($_POST["name"]) && isset($_POST["service"]) && isset($_POST["message"])) {
                        $review = $this->review_model->createReview($_POST["name"], $_POST["service"], $_POST["message"]);
                        if ($review) {
                            http_response_code(201);
                            echo json_encode([
                                "message" => "Review was successfully created",
                                "created" => $review
                            ]);
                        } else {
                            echo json_encode([
                                "message" => "Review was NOT created, database error"
                            ]);
                        }
                    } else {
                        echo json_encode([
                            "message" => "Review was NOT created, not enough params"
                        ]);
                    }
                } else if ($_POST["action"] == "update") {
                    if (isset($_POST["name"]) && isset($_POST["id"]) && isset($_POST["service"]) && isset($_POST["message"])) {
                        $review = $this->review_model->updateReview($_POST["id"], $_POST["name"], $_POST["service"], $_POST["message"]);
                        if ($review) {
                            http_response_code(201);
                            echo json_encode([
                                "message" => "Review was successfully updated",
                                "updated" => $review
                            ]);
                        } else {
                            echo json_encode([
                                "message" => "Review was NOT updated, database error"
                            ]);
                        }
                    } else {
                        echo json_encode([
                            "message" => "Review was NOT updated, not enough params"
                        ]);
                    }
                }
            default:
                break;
        }
    }
}