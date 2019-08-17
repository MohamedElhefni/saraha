<?php
require 'core/init.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/tailwind.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="dist.css">

    <title>Login</title>
</head>

<body class="bg-grey-lighter linear h-screen font-sans">
    <div class="container mx-auto h-full flex justify-center items-center">
        <div class="xl:w-1/3 md:w-1/2 xs:w-1">
            <img class=" mb-6 mx-auto text-center" src="assets/img/logo.png">
            <form action="" method="post">
                <div class="border-teal p-8 border-t-12 shadow-2xl bg-white mb-6 rounded-lg shadow-lg">
                    <div class="mb-4">
                        <label class="font-bold text-grey-darker block mb-2">Username </label>
                        <input name="username" type="text" class="block appearance-none w-full bg-white border border-grey-light focus:border-grey px-2 py-2 rounded shadow" placeholder="Your Username">
                    </div>

                    <div class="mb-4">
                        <label class="font-bold text-grey-darker block mb-2">Password</label>
                        <input name="password" type="password" class="block appearance-none w-full bg-white border border-grey-light focus:border-grey px-2 py-2 rounded shadow" placeholder="Your Password">
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">
                            Login
                        </button>


                        <div class="no-underline inline-block align-baseline font-bold text-sm text-blue hover:text-blue-dark float-right" href="#">
                            <input type="checkbox" name="remember" class="cursor-pointer" id="remember">
                            <label for="remember" class="select-none cursor-pointer text-gray-500">Remember Me</label>
                        </div>
                    </div>
            </form>

        </div>
        <div class="text-center">
            <p class="text-white text-sm">Don't have an account? <a href="register.php" class="no-underline text-blue font-bold">Create an Account</a>.</p>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="assets/js/main.js"></script>
    <?php
    $user = new user();

    if ($user->isloggedIn()) {
        header('Location:home.php');
    }
    if (input::exists()) {
        $validate = new validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true),
        ));

        if ($validation->passed()) {

            $user = new user();
            $login = $user->login(input::get('username'), input::get('password'));

            if ($login) {
                $msg = 'Loged in successfully';
                echo "<script> success('$msg') </script>";
                echo "<script> setTimeout('window.open(\'home.php\', \'_self\')', 2000) </script>";
            } else {
                echo "
                <script>
                    error('Please Check The User Again Or A Password')
                </script>
            ";
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