<?php
if (isset($_COOKIE['theme'])) {
    $theme = $_COOKIE['theme'];
} else {
    $theme = 'css/light_theme.css';
}

echo '<link rel="stylesheet" href="' . $theme . '" type="text/css"/>'
?>