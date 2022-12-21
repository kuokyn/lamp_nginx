<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <?php if (isset($_COOKIE['theme'])) {
        $theme = $_COOKIE['theme'];
    } else {
        $theme = '/css/light.css';
    }
    echo '<link rel="stylesheet" href="../' . $theme . '" type="text/css"/>';
    $_SESSION['user_authorized'] = 1;?>
</head>
<body>
<header class="header">
    <div class="container header-container" id="header">
        <nav class="menu list-reset">
            <ul class="menu-list">
                <li class="menu-item"><a href="/private/upload" class="menu-link">Загрузка файлов</a></li>
                <li class="menu-item"><a href="/private/statistics" class="menu-link">Статистика</a></li>
                <li class="menu-item"><a href="/private/users" class="menu-link">Пользователи</a></li>
                <li class="menu-item"><a href="/private/requests" class="menu-link">Запросы</a></li>
                <li class="menu-item"><a href="/private/reviews" class="menu-link">Отзывы</a></li>
            </ul>
        </nav>
        <div class="menu-btn">
            <div class="menu-btn_burger"></div>
        </div>
    </div>
</header>
<div class="container text-left">