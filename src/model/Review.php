<?php

class Review
{

    public function getReviewById($id)
    {
        global $conn;
        $query = "SELECT * FROM reviews WHERE id='" . $id . "'";
        $result = mysqli_query($conn, $query);
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    public function createReview($name, $service, $message)
    {
        global $conn;
        $query = "INSERT INTO reviews (name, service, message) VALUES (?,?,?)";
        $stmt = $conn->prepare($query);
        if ($stmt)
            $stmt->bind_param("sss", $name, $service, $message);
        $reviews = $stmt->execute();
        return $reviews;
    }

    public function getReviewList()
    {
        global $conn;
        $query = "SELECT * FROM reviews";
        $result = mysqli_query($conn, $query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateReview($id, $name, $service, $message)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM reviews WHERE id = ?;");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 1) {
            $query = "UPDATE reviews SET name = ?, service =?, message = ? WHERE id= ?;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssi', $name, $service, $message, $id);}
        $review = $stmt->execute();
        if ($review) {
            $review = self::getReviewById($id);
        }
        return $review;
    }

    public function deleteReview($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM reviews WHERE id = ?;");
        $stmt->bind_param('s', $id);
        $reviews = $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        if ($count === 1) {
            $query = "DELETE FROM reviews WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $id);
            if ($stmt->execute()) {
                $count = $stmt->num_rows;
            }
        }
        if ($count) {
            return null;
        }
        else {
            return $reviews;
        }
    }
}