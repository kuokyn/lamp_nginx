<?php
session_start();
$_SESSION['user_authorized'] = 1;
if(!$_COOKIE['views']) {
    setcookie('views', 1, time()+60*60*24);
} else{
    setcookie('views', ++$_COOKIE['views'],
        time()+60*60*24);
}
if(isset($_POST['username'])) {
    $_SESSION['username'] = $_SERVER['PHP_AUTH_USER'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <?php require('../preferences/theme.php'); ?>
</head>
<body>
<div class="container text-left">
    <br><h2>Запросы</h2>
    <?php
    $conn = new mysqli("MYSQL", "user", "password", "appDB");

    // Check connection
    if ($conn === false) {
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    $sql = "SELECT id, service, message, name, email FROM requests";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table table-striped">
                <thead><tr>
                    <th>id</th>
                    <th>service</th>
                    <th>message</th>
                    <th>name</th>
                    <th>email</th>
                    <th></th>
                    <th></th>
                </tr></thead>';
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tbody>
                    <tr>
                       <td>" . $row["id"] . "</td>
                       <td>" . $row["service"] . "</td>
                       <td>" . $row["message"] . "</td>
                       <td>" . $row["name"] . "</td>
                       <td>" . $row["email"] . "</td>
                    </tr>
                  </tbody>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    echo '<br><h2>Юзеры</h2>';
    $sql = "SELECT id, password, username, email FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table table-striped">
                <thead><tr>
                    <th>id</th>
                    <th>username</th>
                    <th>password</th>
                    <th>email</th>
                </tr></thead>';
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tbody>
                    <tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["username"] . "</td>
                    <td>" . $row["password"] . "</td>
                    <td>" . $row["email"] . "</td>
                    </tr>
                   </tbody>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
    <label for="theme"><?php echo 'theme: ' ?></label>
    <select class="form-select" id="theme" name="theme">
        <option><?php echo 'choose'?></option>
        <option value="css/light.css"><?php echo 'light' ?></option>
        <option value="css/dark.css"><?php echo 'dark' ?></option>
    </select>

    <hr>

    <div class="form-block">
        <form action="" method="POST" enctype="multipart/form-data">
            <input class="form-input" type="file" name="uploading_file" required>
            <button class="btn" type="submit"><?php echo 'send' ?></button>
        </form>

        <div class="response-block">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include("../uploader/upload.php");
            }
            ?>
        </div>
    </div>

    <hr>

    <div class="form-block">
        <form action="../download.php" method="GET" target="_blank">
            <input class="form-input" type="text" name="downloading_file" required>
            <button class="btn" type="submit"><?php echo 'receive' ?></button>
    </div>
    <div>
        <a href="logout.php">Logout</a>
    </div>
    <div>
        <?php
        echo "Hello, {$_SERVER['PHP_AUTH_USER']}<br>";
        echo "Your session id is ".session_id()."<br>";
        echo "You have visited this page {$_COOKIE['views']}<br>";
        echo "You are authorized {$_SESSION['user_authorized']}";
        ?>
    </div>
</div>

<!--<span style="float: right; margin-right: 2%;" class="text-muted"><?php /*echo $_COOKIE['username'] */?></span>
<h1 class="display-3">Cafe Pushkin</h1>

<h5 class="display-4"><?php /*echo $langArray['menu']*/?></h5>
<a class="text-muted large-font" href="./desserts.php"><?php /*echo $langArray['desserts']*/?></a>
<a class="text-muted large-font" href="./drinks.php"><?php /*echo $langArray['drinks']*/?></a>

<h5 class="display-4"><?php /*echo $langArray['other']*/?></h5>
<a class="text-muted large-font" href="./about.php"><?php /*echo $langArray['about']*/?></a>
<hr>

<label for="lang"><?php /*echo $langArray['language'] . ': ' */?></label>
<select class="form-select" id="lang" name="lang">
    <option><?php /*echo $langArray['choose']*/?></option>
    <option value="ru">русский</option>
    <option value="en">english</option>
    <option value="de">deutsch</option>
</select>-->
<script type="text/javascript" src="../js/preferences.js"></script>
</body>
</html>