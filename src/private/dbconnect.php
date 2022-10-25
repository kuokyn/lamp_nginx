<?php
function connect()
{
    $conn = new mysqli("MYSQL", "user", "toor", "appDB");
    return $conn;
}
