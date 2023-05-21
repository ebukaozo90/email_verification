<?php
session_start();
include('dbcon.php');


if(isset($_POST['login_btn'])){


    if(!empty(trim($_POST['email']))  && !empty(trim($_POST['password']))){

            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']); 

            // login query 

            $login_query = "SELECT * FROM users WHERE email ='$email' AND password = '$password' LIMIT 1";
            $login_query_run = mysqli_query($conn, $login_query);

            // check if there is existing records 


            if(mysqli_num_rows($login_query_run) > 0){

                $row = mysqli_fetch_array($login_query_run);
                if($row['verify_status'] == "1")
                {
                        $_SESSION['authenticated'] = True;
                        $_SESSION['auth_user'] = [
                        'name'  => $row['name'],
                        'phone'  => $row['phone'],
                        'email'  => $row['email'],


                        ];

                        $_SESSION['status'] = "Youre Logged in Successfully";
                        header('Location:dashboard.php');
                        exit(0);

                }
                

                else

                {
                        $_SESSION['status'] = "Please verify your Email";
                        header('Location:login.php');
                        exit(0);

                }


            }
else{

        $_SESSION['status'] = "invalid email";
        header('Location:login.php');
        exit(0);
}

    }



 }





?>