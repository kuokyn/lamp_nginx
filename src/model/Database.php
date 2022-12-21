<?php
class Database
{
    public function connect() {
        $conn = new mysqli("MYSQL", "user", "password", "appDB");
        if ($conn === false)
        {
            $error = mysqli_connect_error();
            return $error;
        }
        return $conn;
    }
}
?>