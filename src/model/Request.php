<?php

class Request
{

    public function getRequestById($id)
    {
        global $conn;
        $query = "SELECT * FROM requests WHERE id='" . $id . "'";
        $result = mysqli_query($conn, $query);
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    public function createRequest($name,$email,$service,$message)
    {
        global $conn;
        $query = "INSERT INTO requests (name, email, service, message) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($query);
        if ($stmt)
            $stmt->bind_param("ssss", $name, $email, $service, $message);
        return $stmt->execute();
    }

    public function getRequestList()
    {
        global $conn;
        $query = "SELECT * FROM requests";
        $result = mysqli_query($conn, $query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

/*    public function updateRequest($name, $email, $surname, $password, $authority_title, $id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM requests WHERE id = ?;");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 1) {
            $query = "UPDATE requests SET name = ?, email =?, surname= ?,  password= ?,  authority_title= ? WHERE id= ?;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssssss', $name, $email, $surname, $password, $authority_title, $id);
        }
        $requests = null;
        if ($stmt->execute()) {
            $requests = self::getRequestByPhone($id);
        }
        return $requests;
    }*/

    public function deleteRequest($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM requests WHERE id = ?;");
        $stmt->bind_param('s', $id);
        $requests = $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        if ($count === 1) {
            $query = "DELETE FROM requests WHERE id = ?";
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
            return $requests;
        }
    }
}