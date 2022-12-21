<?php

class User
{

    public function getUserById($id)
    {
        global $conn;
        $query = "SELECT * FROM user WHERE id='" . $id . "'";
        $result = mysqli_query($conn, $query);
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    public function createUser($name, $email, $surname, $password, $authority_title, $id)
    {
        global $conn;
        $query = "INSERT INTO user (id, name, email, surname, password, authority_title) 
                  VALUES (?, ?, ?, ?,?,?)";
        $stmt = $conn->prepare($query);
        if ($stmt)
            $stmt->bind_param("ssssss", $id, $name, $email, $surname, $password, $authority_title);
        $user = null;
        if ($stmt->execute()) {
            $user = self::getUserByPhone($id);
        }
        return $user;
    }

    public function getUserList()
    {
        global $conn;
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUser($name, $email, $surname, $password, $authority_title, $id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM user WHERE id = ?;");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 1) {
            $query = "UPDATE user SET name = ?, email =?, surname= ?,  password= ?,  authority_title= ? WHERE id= ?;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssssss', $name, $email, $surname, $password, $authority_title, $id);
        }
        $user = null;
        if ($stmt->execute()) {
            $user = self::getUserByPhone($id);
        }
        return $user;
    }

    public function deleteUser($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM user WHERE id = ?;");
        $stmt->bind_param('s', $id);
        $user = $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        if ($count === 1) {
            $query = "DELETE FROM user WHERE id = ?";
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
            return $user;
        }
    }
}