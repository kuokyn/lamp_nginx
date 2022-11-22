<?php
if (isset($_COOKIE['theme'])) {
    $theme = $_COOKIE['theme'];
} else {
    $theme = '/css/light.css';
}

echo '<link rel="stylesheet" href="../' . $theme . '" type="text/css"/>'
?>