<?php

class Router
{
    // метод будет принимать управление от фронтконтроллера
    public function run()
    {
        $uri = $this->getURI();
        $segments = explode('/', $uri);
//        echo json_encode($segments);
        $controller = null;
        if ($segments[0] == "private") {
            if (count($segments) == 1) {
                include(ROOT . '/view/shared/header.php');
                include_once(ROOT . '/controller/RequestsController.php');
                $controller = new RequestsController("requests");
                $controller->processMethod();
            } else {
                $string = str_replace("&", "?", $segments[1]);
                switch ($string) {
                    case 'requests':
                        include(ROOT . '/view/shared/header.php');
                        include_once(ROOT . '/controller/RequestsController.php');
                        $controller = new RequestsController($string);
                        $controller->processMethod();
                        break;
                    case 'reviews':
                        include(ROOT . '/view/shared/header.php');
                        include_once(ROOT . '/controller/ReviewsController.php');
                        $controller = new ReviewsController($string);
                        $controller->processMethod();
                        break;
                    case 'users':
                        include(ROOT . '/view/shared/header.php');
                        include_once(ROOT . '/controller/UsersController.php');
                        $controller = new UsersController($string);
                        $controller->processMethod();
                        break;
                    case 'upload':
                        include(ROOT . '/view/shared/header.php');
                        include_once(ROOT . '/controller/UploadController.php');
                        $controller = new UploadController($string);
                        $controller->processMethod();
                        break;
                    case 'statistics':
                        include(ROOT . '/view/shared/header.php');
                        include_once(ROOT . '/private/statistics.php');
                        break;
                    case '':
                        include(ROOT . '/view/shared/header.php');
                        include_once(ROOT . '/controller/RequestsController.php');
                        $controller = new RequestsController($string);
                        $controller->processMethod();
                    case 'reviews?id='. $_GET["id"]:
                        include(ROOT . '/view/shared/header.php');
                        include_once(ROOT . '/controller/ReviewsController.php');
                        $controller = new ReviewsController($string);
                        $controller->processMethod();
                        break;
                    default:
                        include(ROOT . '/private/404.php');
                        break;
                }
            }
        } else {
            switch ($segments[0]) {
                case 'about': // для пользователей
                    include_once(ROOT . '/view/about.php');
                    break;
                case 'contacts': // для пользователей
                    include_once(ROOT . '/controller/RequestsController.php');
                    $controller = new RequestsController($segments[0]);
                    $controller->processMethod();
                    break;
                case 'portfolio': // для пользователей
                    include_once(ROOT . '/view/portfolio.php');
                    break;
                case 'services': // для пользователей
                    include_once(ROOT . '/view/services.php');
                    break;
                case 'reviews': // для пользователей
                    include(ROOT . '/view/shared/header.php');
                    include_once(ROOT . '/controller/ReviewsController.php');
                    $controller = new ReviewsController("");
                    $controller->processMethod();
                case '': // для пользователей
                    include_once(ROOT . '/view/index.php');
                    break;
                default:
                    include(ROOT . '/view/404.php');
                    break;
            }
        }
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $uri = explode('q=', $_SERVER['REQUEST_URI']);
            // trim - удаляет пробелы или другие символы из начала и конца строки
            $uri2 = rtrim(trim($uri[1], '/'), '&');
//            echo json_encode($uri2);
            return $uri2;
        }
    }
}