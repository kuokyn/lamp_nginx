<?php
session_start();
if (isset($_SESSION['user_authorized'])) {
    setcookie (session_id(), "", time() - 3600);
    session_destroy();
}
header("Location: http://localhost/");
