<br><h2>Запросы</h2>
<?php
if ($result) {
    echo '<table class="table table-striped">
                <thead><tr>
                    <th>id</th>
                    <th>service</th>
                    <th>message</th>
                    <th>name</th>
                    <th>email</th>
                    <th></th>
                </tr></thead>';
    // output data of each row
    foreach ($result as $row) {
        echo '<tbody>
                    <tr>
                       <td>' . $row["id"] . '</td>
                       <td>' . $row["service"] . '</td>
                       <td>' . $row["message"] . '</td>
                       <td>' . $row["name"] . '</td>
                       <td>' . $row["email"] . '</td>
                        <td><form action="/private/requests" method="POST">
    <input type="hidden" id="id" name="id" value="'.$row["id"].'">
    <input type="hidden" name="action" value="delete">
        <button class="btn red">Удалить</button>
    </form></td>
                    </tr>
                  </tbody>';
    }
    echo "</table>";
} else {
    echo "0 results";
}