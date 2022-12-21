<?php
/*
 * 1. Общие настройки (включение-выключение ошибок, установка констант и др.)
 * 2. Подключение файлов системы
 * 3. Установка соединения с базой данных
 * 4. Вызов Router
*/
session_start();
require('model/Database.php');
require('Router.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('ROOT', dirname(__FILE__));
$connection = new Database();
$conn = $connection->connect();
$router = new Router();
$router->run();
include('view/shared/footer.php');


