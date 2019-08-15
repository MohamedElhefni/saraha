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
    <link rel="stylesheet" href="assets/css/tailwind.min.css">
    <title>Document</title>
</head>

<body class="min-h-screen flex items-center">
    <div class="container mx-auto">
        <div class="w-full  mx-auto max-w-lg">

            <form method="post" class="bg-white   shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h1 class="text-4xl text-gray-700 text-center font-bold">Register</h1>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-gray-500" name="username" id="username" value="<?php echo escape(input::get('username')) ?>" placeholder="Enter Username">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        password
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-gray-500" id="password" name="password" type="password" placeholder="Enter Password">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password_again">
                        password_again
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-gray-500" id="password_again" name="password_again" type="password" placeholder="Enter Password again">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-gray-500" name="name" id="name" value="<?php echo  escape(input::get('name')) ?>" placeholder="Enter name">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:border-gray-500" type="button">
                        Register
                    </button>

                </div>
            </form>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="assets/js/main.js"></script>

    <?php

    if (input::exists()) {
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

            $user = new user();
            $salt = hash::salt(32);
            try {
                $user->create(array(
                    'username' => input::get('username'),
                    'password' => hash::make(input::get('password'), $salt),
                    'salt' => $salt,
                    'name' => input::get('name'),
                    'joined' => date('Y-m-d H:i:s'),
                    'group' => 1,
                ));
                echo "
                    <script>
                        success();
                    </script>
                ";
                echo "<script> setTimeout('window.open(\'login.php\', \'_self\')', 2000) </script>";
            } catch (Exception $e) {
                echo "<script> 
                    error(' " . $e->getMessage() . "');
                </script>";
            }
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
    ?>
</body>

</html>