<br><h2>Отзывы</h2>
<?php
if ($result) {
    echo '<table class="table table-striped">
                <thead><tr>
                <th>id</th>
                    <th>name</th>
                    <th>service</th>
                    <th>message</th>
                    <th></th>
                    <th></th>
                </tr></thead>';
    // output data of each row
    foreach ($result as $row) {
        echo '<tbody>
                    <tr>
                    <td>' . $row["id"] . '</td>
                       <td>' . $row["name"] . '</td>
                       <td>' . $row["service"] . '</td>
                       <td>' . $row["message"] . '</td>
                       <td><form action="/private/reviews" method="GET">
    <input type="hidden" id="id" name="id" value="' . $row["id"] . '">
        <button class="btn red">Изменить</button>
    </form></td>
                       <td><form action="/private/reviews" method="POST">
    <input type="hidden" id="id" name="id" value="' . $row["id"] . '">
    <input type="hidden" name="action" value="delete">
        <button class="btn red">Удалить</button>
    </form></td>
                    </tr>
                  </tbody>';
    }
    echo "</table>";
} else {
    echo "0 results";
} ?>