<?php
require './core/init.php';

$user = new user();
$con = db::getInstance();

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
                        <form enctype="multipart/form-data" action="uploadimg.php" id="upload_img" method="post">
                            <label for="open"><img id="profilePicture" src="<?php echo $user->data()->avatar ?>" alt=""  class="avatar shadow-xl cursor-pointer w-40 rounded-full mx-auto -mt-20"></label>
                            <input type="file" name="img" class="hidden" id="open">
                        </form>
                        <?php

                        ?>
                    </div>
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2 text-center"><?php echo $user->data()->name ?></div>

                    </div>
                    <div class="px-6 py-4">
                        <div class="flex w-full items-center " >
                            <div class="w-4/5">
                                <input readonly='readonly' id="link" value="<?php echo "http://localhost/php_oop_projects/login_register/send.php?user_id=" . "{$user->data()->id}" ?>" type="text" class="block appearance-none w-full bg-white border border-grey-light focus:border-grey px-2 py-2 rounded shadow">
                            </div>                        
                            <div class="w-1/5">
                            <i class="fa fa-copy fa-2x cursor-pointer text-teal-500 ml-2" id = 'copy'></i>
                        </div>
                        </div>
                </div>
                </div>
            </div>
            <div class="w-2/3 ">
                <div class="messages flex justify-center items-center  flex-col-reverse ">

                    <?php
                        $result = $con->get('messages', array('to_user_id','=', $user->data()->id));
                        if ($result->count()) {
                                foreach($result->result() as $res){
                                    
                               
                    ?>

                    <div class="card relative rounded-lg overflow-hidden  w-full  shadow-xl my-3 bg-white  text-center">
                        <div class="card-body border border-gray-200 p-5">
                            <p class="text-gray-800"><?php echo $res->message ?></p>
                        </div>
                        <div class="card-footer w-full">
                            <div class="flex items-center bg-teal-500 text-white p-3 justify-between">
                                <div class="date">
                                    <p class="font-bold"><?php echo time::convert_time(strtotime($res->date)) ?></p>
                                </div>
                                <div class="times">
                                    <i class="fa fa-times cursor-pointer" id='delete' data-id="<?php echo $res->message_id ?>"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                         }
                        }else {
                            echo "<p class='text-2xl text-gray-500'> There is no Messages </p>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/jquery.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script> 

        <script>
        $(document).ready(function() {

            $('#copy').on('click', function() {
                let text = $('#link')
                text.select();
                document.execCommand('copy');
                success('Copied')
            })
            
                
            $('#open').on('change', function() {
                    $('#upload_img').ajaxSubmit(
                        {
                            success: function(data) {
                               if (data.status[0] == 'success'){
                                success('Picture Updated Successfully');
                                $('#profilePicture').attr('src', data.status[1]);
                               }
                               if (data.status[0] == 'error'){
                                data.status.shift();
                                var Err = data.status.join();
                                error(Err);
                               }
                            }
                        }
                    );
                })

               $(document).on('click', '#delete', function() {
                    let message_id = $(this).data('id');
                    
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            'Deleted!',
                            ' message has been deleted.',
                            'success'
                        )
                        deletMessage(message_id)
                    }
                })

                function deletMessage(message_id) {
                    $.ajax({
                        url: 'delete_message.php',
                        method: "POST",
                        data: {
                            message_id: message_id
                        },
                        success: function(data) {
                 setTimeout('window.open(\'home.php\', \'_self\')', 2000);
                            
                        }
                    })
                }
                })
            });
        </script>

</body>

</html>