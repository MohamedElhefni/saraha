<?php
require './core/init.php';
$user = new user();
if (isset($_POST['submit'])) {
    $upload = new upload($_FILES['img']);
    $uploadvalid = $upload->check(array(
        'size' => 5,
        'extensions' => 'jpg,png,jpeg',
        'exists'    => 'unique',
        'image'       => true,
        'writable' => true

    ));

    if ($upload->passed()) {
        if (move_uploaded_file($_FILES['img']['tmp_name'], $upload->file())) {
            echo 'success';
            db::getInstance()->update('users', $user->data()->id, array('avatar' => $upload->file()));
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        print_r($upload->errors());
        echo "FAILED";
    }
}
