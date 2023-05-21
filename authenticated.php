<?php



session_start();

if(!isset($_SESSION['authenticated']))
{

    $_SESSION['status'] = "Please login to acess Dashboard page";
    header('Location:login.php');
    exit(0);
}




?>