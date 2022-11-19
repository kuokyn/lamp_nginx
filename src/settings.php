<?php
session_start();
require('preferences/locale.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <?php require('preferences/theme.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?php echo $langArray['cafe']?></title>
</head>
<body class="body">
<span style="float: right; margin-right: 2%;" class="text-muted"><?php echo $_COOKIE['username'] ?></span>
<h1 class="display-3">Cafe Pushkin</h1>

<h5 class="display-4"><?php echo $langArray['menu']?></h5>
<a class="text-muted large-font" href="./desserts.php"><?php echo $langArray['desserts']?></a>
<a class="text-muted large-font" href="./drinks.php"><?php echo $langArray['drinks']?></a>

<h5 class="display-4"><?php echo $langArray['other']?></h5>
<a class="text-muted large-font" href="./about.php"><?php echo $langArray['about']?></a>
<hr>

<label for="lang"><?php echo $langArray['language'] . ': ' ?></label>
<select class="form-select" id="lang" name="lang">
    <option><?php echo $langArray['choose']?></option>
    <option value="ru">русский</option>
    <option value="en">english</option>
    <option value="de">deutsch</option>
</select>

<label for="theme"><?php echo $langArray['theme'] . ': ' ?></label>
<select class="form-select" id="theme" name="theme">
    <option><?php echo $langArray['choose']?></option>
    <option value="css/light_theme.css"><?php echo $langArray['light'] ?></option>
    <option value="css/dark_theme.css"><?php echo $langArray['dark'] ?></option>
</select>

<hr>

<div class="form-block">
    <form action="" method="POST" enctype="multipart/form-data">
        <input class="form-input" type="file" name="uploading_file" required>
        <button class="btn" type="submit"><?php echo $langArray['send'] ?></button>
    </form>

    <div class="response-block">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include("uploader/upload.php");
        }
        ?>
    </div>
</div>

<hr>

<div class="form-block">
    <form action="download.php" method="GET" target="_blank">
        <input class="form-input" type="text" name="downloading_file" required></div>
<button class="btn" type="submit"><?php echo $langArray['receive'] ?></button>
</form>
</div>

</body>
<script type="text/javascript" src="js/preferences.js"></script>
</html>
