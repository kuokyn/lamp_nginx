<?php
echo '<br><h2>Юзеры</h2>';
if ($result) {
echo '<table class="table table-striped">
    <thead><tr>
        <th>id</th>
        <th>username</th>
        <th>password</th>
        <th>email</th>
    </tr></thead>';
    // output data of each row
    foreach ($result as $row) {
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