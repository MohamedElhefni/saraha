<?php
require './core/init.php';
$user = new user();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/main.css">
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


                <?php
                if ($user->isloggedIn()) {
                    ?>
                <a href="settings.php" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                    Settings
                </a>
                <a href="logout.php" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white">
                    Logout
                </a>
                <?
                } else {
                    ?>
                <a href="register.php" class="bg-transparent text-white font-semibold hover:text-teal-500 hover:bg-white py-2 px-4 border border-white-500 hover:border-transparent rounded">
                    register
                </a>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>

    <div class="container mx-auto ">
        <div class="send m-4 text-center">
            <img id="avatar" src="https://pbs.twimg.com/profile_images/808164059711504388/CyZa4rBW_400x400.jpg" alt="" class="avatar shadow-xl cursor-pointer w-40 rounded-full mx-auto ">
            <div class="overlay"></div>
            <h2 class="font-bold text-2xl mt-4">Mohamed Hossam</h2>
            <div class="send-body my-4">
                <form action="" method='post'>
                    <?php
                    if ($user->isloggedIn()) {
                        ?>
                    <textarea name="message" id="message" cols="30" rows="10" class="appearance-none border-2 border-gray-400 rounded  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500 mx-auto resize-none w-2/3" disabled id="inline-full-name" placeholder="You Can't Send Messae To Your Self"></textarea>

                    <?php
                    } else {
                        ?>
                    <textarea name="message" id="message" cols="30" rows="10" class="appearance-none border-2 border-gray-400 rounded  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-teal-500 mx-auto resize-none w-2/3" id="inline-full-name" placeholder="Make Your Message Positive"></textarea>
                    <button type="submit" class="  block py-2 px-4 bg-teal-500 text-white mx-auto hover:bg-teal-700 rounded">
                        <div class="flex inline-flex items-center">
                            <span><i class="fa fa-send"></i></span>
                            <span class="ml-3">Send</span>
                        </div>
                    </button>

                    <?php
                    }
                    ?>

                </form>
            </div>
        </div>
    </div>
    <script>
        let avatar = document.getElementById('avatar');
        avatar.addEventListener('click', function() {
            this.classList.toggle('active');
            document.getElementsByClassName('overlay')[0].classList.toggle('block')
        })
    </script>
</body>

</html>