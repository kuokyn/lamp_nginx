<?php
$target_dir = dirname(__DIR__, 2) . '/storage/pdf/';
$target_file_name = $target_dir . basename($_FILES['uploading_file']['name']);
$file_type = strtolower(pathinfo($target_file_name, PATHINFO_EXTENSION));
$error_flag = false;
$error_message_array = [];

if (file_exists($target_file_name)) {
    $error_flag = true;
    array_push($error_message_array, 'File already exists');
}

if ($_FILES['uploading_file']['size'] > 500000) {
    $error_flag = true;
    array_push($error_message_array, 'File is too heavy');
}

if ($file_type != 'pdf') {
    $error_flag = true;
    array_push($error_message_array, 'Wrong file type');
}
if (!$error_flag) {
    if (!move_uploaded_file($_FILES["uploading_file"]["tmp_name"], $target_file_name)) {
        $error_flag = true;
        array_push($error_message_array, 'Error during the upload');
    }
}

if (!$error_flag) {
    echo '<span>Success</span>';
} else {
    foreach($error_message_array as $error_message) {
        echo '<span>' . $error_message . '</span>';
    }
}
?>