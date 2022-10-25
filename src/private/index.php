<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
</head>
<body>
<div class="container text-left">
    <br><h2>Запросы</h2>
    <?php
    $conn = new mysqli("MYSQL", "user", "toor", "appDB");

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
</div>
</body>
</html>