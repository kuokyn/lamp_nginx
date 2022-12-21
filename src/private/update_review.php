<?php
echo '<section>
    <h2>Отзыв №'.$result["id"].'</h2>
    <form action="/private/reviews" method="POST">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" value="'.$result["id"].'">
        <label for="name">Отправитель</label>
        <input type="text" id="name" name="name" value="'.$result["name"].'" required>
        <label for="service">Услуга</label>
        <input type="text" id="service" name="service" value="'.$result["service"].'" required>
        <label for="message">Сообщение</label>
        <input type="text" id="message" name="message" value="'.$result["message"].'" required> <br>
        <button class="btn btn-alert">Обновить</button>
    </form>
</section>';
