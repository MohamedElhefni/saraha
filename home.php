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
    <title>Saraha</title>
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
                        <form action="./imgupload.php" id="upload_img" method="post">
                            <label for="open"><img src="<?php echo $user->data()->avatar ?>" alt="" class="avatar shadow-xl cursor-pointer w-40 rounded-full mx-auto -mt-20"></label>
                            <input type="file" name="profile_img" class="hidden" id="open">
                            <input type="submit" value="upload" name="profile_pic">
                        </form>
                        <?php

                        ?>
                    </div>
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2 text-center"><?php echo $user->data()->name ?></div>

                    </div>
                    <div class="px-6 py-4">
                        <input disabled value="https://www.googe.com" type="text" class="block appearance-none w-full bg-white border border-grey-light focus:border-grey px-2 py-2 rounded shadow">
                    </div>
                </div>
            </div>
            <div class="w-2/3 ">
                <div class="messages flex justify-center items-center  flex-col-reverse ">

                    <div class="card relative rounded-lg overflow-hidden  w-full  shadow-xl my-3 bg-white  text-center">
                        <div class="card-body border border-gray-200 p-5">
                            <p class="text-gray-800">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore, dicta fuga asperiores sed dolorem ad modi iusto veritatis! Perspiciatis tempore nobis architecto corporis veritatis voluptatem inventore nisi distinctio id saepe?</p>
                        </div>
                        <div class="card-footer w-full">
                            <div class="flex items-center bg-teal-500 text-white p-3 justify-between">
                                <div class="date">
                                    <p class="font-bold">9 months ago</p>
                                </div>
                                <div class="times">
                                    <i class="fa fa-times cursor-pointer"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

</body>

</html>