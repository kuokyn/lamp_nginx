<?php
if (isset($_POST["register"])) {
    if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $con = new mysqli("MYSQL", "user", "toor", "appDB");
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $query_result = $con->query("SELECT * FROM users WHERE username='" . $username . "'");
        $result = $query_result->fetch_row();
        if (!empty($result)) {
            echo '<script>';
            echo 'alert("Юзернэйм занят")';
            echo '</script>';
        } else {
            $password = crypt($password);
            $stmt = $con->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $username, $password, $email);
            $stmt->execute();
            echo '<script>';
            echo 'window.location.replace("login.html");';
            echo '</script>';
        }
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Регистрация</title>
    <link href="style.css" media="screen" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container mlogin" style="width: 400px;">
    <div id="login">
        <h1>Регистрация</h1>
        <form action="register.php" id="registerform" method="post" name="registerform">
            <p><label for="email">E-mail<br>
                    <input class="input" id="email" name="email" size="32" type="email" value=""></label></p>
            <p><label for="username">Имя пользователя<br>
                    <input class="input" id="username" name="username" size="20" type="text" value=""></label></p>
            <p><label for="password">Пароль<br>
                    <input class="input" id="password" name="password" size="32" type="password" value=""></label></p>
            <p class="submit"><input class="button" id="register" name="register" type="submit"
                                     value="Зарегистрироваться"></p>
            <p class="regtext">Уже зарегистрированы? <a href="login.html">Логин</a>!</p>
        </form>
    </div>
</div>
</body>
</html>
