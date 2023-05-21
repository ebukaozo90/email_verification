<?php

session_start();

include('dbcon.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

 function resend_email($name, $email, $verify_token){

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
    $mail->Subject = 'Resend - Please verify your email address for Destiny Technology Hub';

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

if(isset($_POST['resend_btn'])){

    if(!empty(trim($_POST['email'])))
    
    {
                $email = mysqli_real_escape_string($conn, $_POST['email']);

            // process the query 

                $query = "SELECT * FROM users WHERE email = '$email'";
                $query_run = mysqli_query($conn, $query);


                // check if email exist 

                if(mysqli_num_rows($query_run) > 0 )

                {
                        $row = mysqli_fetch_array($query_run);
                        if($row['verify_status'] == "0")
                        {

                            $name = $row['name'];
                            $email = $row['email'];
                            $verify_token = $row['verify_token'];
                            
                            resend_email($name, $email, $verify_token);
                            $_SESSION['status'] = "Verification Link has been sent";
                            header('Location:login.php');
                            exit(0);

                        }


                        else

                        {
                                $_SESSION['status'] = "Your Email is Already Verifield, Login";
                                header('Location:login.php');
                                exit(0);

                        }
                }


                else

                {

                    $_SESSION['status'] = "Your Email is not Register, Please Register";
                    header('Location:register.php');
                    exit(0);
                }

    }

    else{

        $_SESSION['status'] = "please enter an email";
        header('Location:resend_email.php');
        exit(0);
    }

}




?>