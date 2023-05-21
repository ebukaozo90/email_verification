<?php
session_start();

unset( $_SESSION['authenticated']);
unset( $_SESSION['auth_user']);
$_SESSION['status'] = "Youre Logged out Sucessfully";
header('Location:login.php');








?>