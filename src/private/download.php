<?php
if (isset($_GET['downloading_file'])) {
    $file_name = $_GET['downloading_file'];
    $target_file_name = dirname(__DIR__) . '/../storage/pdf/' . $file_name;
    if (!file_exists($target_file_name)) {
        echo "File doesn't exist";
        echo $target_file_name;
        echo '<script type="text/javascript">window.close();</script>';
    } else {
        header('Content-type: application/pdf');

        readfile($target_file_name);
        exit;
    }
}
?>


