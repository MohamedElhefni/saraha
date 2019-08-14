<?php
require 'core/init.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Document</title>
</head>

<body>
    <div class="register">
        <div class="container">
            <div class="register-form">
                <form action="" method="post">
                    <h1 class="main-header">Register</h1>
                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?php echo escape(input::get('username')) ?>" placeholder="Enter Username">
                    </div>
                    <div class="field">
                        <label for="password">password</label>
                        <input type="password" name="password" id="password" placeholder="Enter Password">
                    </div>
                    <div class="field">
                        <label for="password_again">password again</label>
                        <input type="password" name="password_again" id="password_again" placeholder="Enter Password again">
                    </div>
                    <div class="field">
                        <label for="name">name</label>
                        <input type="text" name="name" id="name" value="<?php echo  escape(input::get('name')) ?>" placeholder="Enter name">
                    </div>
                    <input type="hidden" name="token" value="<?php echo token::generate() ?>">
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="assets/js/main.js"></script>

    <?php

    if (input::exists()) {
        if (token::check(input::get('token'))) {
            $validate = new validate();
            $validation = $validate->check($_POST, array(
                'username'      => array(
                    'required'  => true,
                    'min'   => 2,
                    'max'   => 20,
                    'unique' => 'users'
                ),
                'password'      => array(
                    'required'  => true,
                    'min'   => 6,
                ),
                'password_again'      => array(
                    'required'  => true,
                    'min'   => 6,
                    'matches' => 'password'

                ),
                'name'      => array(
                    'required'  => true,
                    'min'   => 2,
                    'max'   => 50,
                ),
            ));
            if ($validation->passed()) {
                echo "
            <script>
                success();
            </script>
        ";
            } else {
                $err = '';
                foreach ($validation->errors() as $valid) {
                    $err .= $valid . '<br>';
                }
                echo "
            <script>
                error('$err')
            </script>
        ";
            }
        }
    }
    ?>
</body>

</html>