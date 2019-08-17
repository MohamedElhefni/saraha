<?php
require './core/init.php';
header('Content-type: application/json');
$user = new user();
if (!empty($_FILES)) {
    $upload = new upload($_FILES['img']);
    $uploadvalid = $upload->check(array(
        'size' => 5,
        'extensions' => 'jpg,png,jpeg',
        'exists'    => 'unique',
        'image'       => true,
        'writable' => true

    ));

    if ($upload->passed()) {
        $result = array();
        if (move_uploaded_file($_FILES['img']['tmp_name'], $upload->file())) {
            $result['status'] = array('success', $upload->file());

            db::getInstance()->update('users', $user->data()->id, array('avatar' => $upload->file()));
        } else {
            $result['status'] = 'failes';
        }
    } else {
        foreach ($upload->errors() as $error) {
            if ($error == 'sorry the file already Exists') {
                db::getInstance()->update('users', $user->data()->id, array('avatar' => $upload->file()));
                $result['status'] = array('success', $upload->file());
            } else {
                $result['status'] = array('error', $upload->errors());
            }
        }
    }
    echo json_encode($result);
}
