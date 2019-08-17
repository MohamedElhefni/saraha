<?php
require './core/init.php';

$user = new user();

if (!$user->isloggedIn()) {
    header('Location:login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/tailwind.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Settings</title>
</head>

<body>

    <nav class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
        <a href="home.php">
            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <img src="assets/img/logo300.png" class=" w-20 mr-4" alt="">
                <span class="font-semibold text-xl tracking-tight">Saraha</span>
            </div>
        </a>

        <div class="block flex-grow flex items-center w-auto">
            <div class="text-sm lg:flex-grow">
            </div>
            <div class="flex items-center ">


                <a href="update.php" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                    Settings
                </a>
                <a href="logout.php" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white">
                    Logout
                </a>
            </div>
        </div>
    </nav>
    <div class="container mx-auto mt-5">
        <div class="flex">
            <div class="w-1/3 ">
                <div class=" ml-4 shadow-xl lg:fixed max-w-sm rounded overflow-hidden shadow-lg">
                    <div class="card-img">
                        <img class="w-full " src="assets/img/nature.jpeg" alt="Sunset in the mountains">
                        <img src="<?php echo $user->data()->avatar ?>" alt="" class="avatar shadow-xl cursor-pointer w-40 rounded-full mx-auto -mt-20">
                    </div>
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2 text-center "><?php echo $user->data()->name ?></div>

                    </div>
                    <div class="px-6 py-4">
                        <input disabled value="https://www.googe.com" type="text" class="block appearance-none w-full bg-white border border-grey-light focus:border-grey px-2 py-2 rounded shadow">
                    </div>
                </div>
            </div>
            <div class="w-2/3 ">
                <div class="settings flex justify-center items-center  flex-col-reverse ">

                    <div class="settings-card shadow-2xl p-4 w-full ">
                        <form method="post">
                            <h1 class="text-4xl text-gray-700 text-center font-bold">Settings</h1>


                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    username
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-gray-500" name="username" id="username" value="<?php echo  $user->data()->username ?>" disabled>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    name
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-gray-500" name="name" id="name" value="<?php echo  $user->data()->name ?>" placeholder="Enter name">
                            </div>

                            <div class="flex items-center justify-between">
                                <button type="submit" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">
                                    Update
                                </button>


                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="assets/js/main.js"></script>
        <?php
        if (input::exists()) {
            $validate = new validate();
            $validation = $validate->check($_POST, array(

                'name' => array(
                    'required' => true,
                    'min'   => 2,
                    'max'   => 20,
                ),
            ));

            if ($validation->passed()) {
                try {

                    $user->update(array(
                        'name' => input::get('name')
                    ));
                } catch (Exception $e) {
                    echo "<script> error(" . $e->getMessage() . ") </script>";
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