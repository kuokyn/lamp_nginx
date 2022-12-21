<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
</head>
<body>
<div class="container text-left">
    <label for="theme"><?php echo 'theme: ' ?></label>
    <select class="form-select" id="theme" name="theme">
        <option><?php echo 'choose'?></option>
        <option value="css/light.css"><?php echo 'light' ?></option>
        <option value="css/dark.css"><?php echo 'dark' ?></option>
    </select>

    <hr>

    <div class="form-block">
        <form action="/private/upload" method="POST" enctype="multipart/form-data">
            <input class="form-input" type="file" name="uploading_file" required>
            <button class="btn" type="submit"><?php echo 'Send' ?></button>
        </form>

        <div class="response-block">
        </div>
    </div>
    <hr>
    <div class="form-block">
        <form action="download.php" method="GET" target="_blank">
            <input class="form-input" type="text" name="downloading_file" required>
            <button class="btn" type="submit"><?php echo 'receive' ?></button>
    </div>
    <div>
        <?php
        echo "Hello, {$_SERVER['PHP_AUTH_USER']}<br>";
        echo "Your session id is ".session_id()."<br>";
        echo "You are authorized {$_SESSION['user_authorized']}";
        ?>
    </div>
</div>
<script type="text/javascript" src="../js/preferences.js"></script>
</body>
</html>