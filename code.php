<?php

session_start();
include('dbcon.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token){

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = 'smtp.mail.yahoo.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'emmanueltannas@yahoo.com';
    $mail->Password   = 'cibxzypvjjeudokr';
    $mail->Port       = 587;

    $mail->setFrom('emmanueltannas@yahoo.com', 'Destiny Technology Hub');
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = 'Please verify your email address for Destiny Technology Hub';

    // Attachment
    //$attachment_path = 'images/logo.png'; // Update with the actual path of the logo file
   // $mail->addAttachment($attachment_path, 'Logo');

    $email_template = "
        <img src=''/>
        <p>Dear $name,</p>
        <p>Thank you for registering with Destiny Technology Hub. To complete your registration, please click on the link below to verify your email address:</p>
        
        <p><a href='http://localhost/verification/verify-email.php?token=$verify_token'>Verify email address<a/></p>
        
        <p>If you did not register for an account with Destiny Technology Hub, please disregard this message.</p>
        
        <p>Best regards,</p>
        <p>The Destiny Technology Hub Team</p>
    ";
    
    $mail->Body    = $email_template;

    $mail->send();
}



if(isset($_POST['register_btn']))

{

    $name =  $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    //$s_email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $verify_token = md5(rand());




    // check if email is valid 


    // if(!filter_var($s_email, FILTER_VALIDATE_EMAIL)){

    //     $_SESSION['status'] = "invalid email";
    //     header("Location:register.php");
    //     exit();
    // }

    // check if email exist 

    $check_email = "SELECT email FROM users WHERE email ='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($check_email_run) > 0)

  {
            $_SESSION['status'] = "email already exist";
            header("Location:register.php");
            exit();
    }


    // check comfirm password

    if($password !== $c_password){

        $_SESSION['status'] = "password doesnt match";
        header("Location:register.php");
        exit();
    }




else
    {
                    // insert user // register user 
         //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
       $query = "INSERT INTO users(name,phone,email,password,verify_token) 
       VALUES('$name','$phone','$email','$password','$verify_token')";
       $query_run = mysqli_query($conn, $query);
        

       if($query_run)
       {
           sendemail_verify("$name", "$email", "$verify_token");
            $_SESSION['status'] = "Registration successful, please verify your email";
            header("Location:register.php");
            exit();
            
       }

            else

       {
        $_SESSION['status'] = "Registration failed".mysqli_error($conn);
        header("Location:register.php");

       }
}

}



?>