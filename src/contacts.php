<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <title>Contact Viktoria Nikiforova</title>
</head>
<body>
<header class="header">
    <div class="container header-container" id="header">
        <a class="logo" href="index.php">
            <img src="img/logo.png" alt="Vika">
        </a>
        <nav class="menu list-reset">
            <ul class="menu-list">
                <li class="menu-item"><a href="index.php" class="menu-link">Home</a></li>
                <li class="menu-item"><a href="about.php" class="menu-link">About</a></li>
                <li class="menu-item"><a href="portfolio.php" class="menu-link">Portfolio</a></li>
                <li class="menu-item"><a href="services.php" class="menu-link">Services</a></li>
                <li class="menu-item"><a href="contacts.php" class="menu-link">Contacts</a></li>
            </ul>
        </nav>
        <div class="menu-btn">
            <div class="menu-btn_burger"></div>
        </div>
    </div>
</header>
<main>
    <section>
        <div class="title anim-items">
            <div class="background-title">
                Contacts
            </div>
            <div class="main-title">
                Contacts
            </div>
        </div>
    </section>
</main>
<section class="contacts-subtitle anim-items">Have a question or want to work together?</section>
<div class=" container form-container">
    <section id="form" class="form-section anim-items">
        <form class="form" action="contacts.php" method="post">
            <div class="field">
                <input type="text" id="name" name="name" placeholder="Your name" required>
            </div>
            <div class="field">
                <input type="text" id="email" name="email" placeholder="Your email" required>
            </div>
            <div class="field">
                <select id="service" name="service" required>
                    <option value="" disabled selected>Service</option>
                    <option value="Graphic design">Graphic design</option>
                    <option value="Illustration">Illustration</option>
                    <option value="Frontend">Frontend</option>
                    <option value="UI/UX">UI/UX</option>
                </select>
            </div>
            <div class="field">
                    <textarea type="text" id="message" name="message" cols="30" rows="1"
                              placeholder="Message" required></textarea>
            </div>
            <input type="submit" id="submitBtn" value="Send Message">
        </form>
        <?php

        $conn = new mysqli("MYSQL", "user", "password", "appDB");

        // Check connection
        if ($conn === false) {
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $service = $_POST['service'];
        $message = $_POST['message'];

        if ($name =="" || $email =="" || $service =="" || $message =="") {
            mysqli_close($conn);
        } else {
            $sql = "INSERT INTO requests (name, email, service, message) VALUES ('$name','$email','$service','$message')";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($conn);
            }
            mysqli_close($conn);
        }

        ?>
    </section>
    <section class="contacts-section anim-items">
        <div class="contacts">
            <div class="conctact-item">
                EMAIL
                <span class="conctact-item-descr">
                        viktoria@gmail.com
                    </span>
            </div>
            <div class="conctact-item">
                PHONE
                <span class="conctact-item-descr">
                        +70000000000
                    </span>
            </div>
            <div class="conctact-item">
                ADDRESS
                <span class="conctact-item-descr">
                        Moscow, Russia
                    </span>
            </div>
        </div>
    </section>
</div>
<footer class="footer" style="top: 150px;">
    <div class="container footer-container">
        <div class="footer-copyright">
            <small class="copyright">
                &#169; 2021 Viktoria Nikiforova
            </small>
        </div>
    </div>
</footer>
<script src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/autoresize.jquery.min.js"></script>
<script>
    const textarea = document.querySelector("textarea");
    textarea.addEventListener("keyup", e => {
        textarea.style.height = "auto";
        let scHeight = e.target.scrollHeight;
        textarea.style.height = `${scHeight}px`;
    });
</script>
</body>
</html>
