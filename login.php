<?php 
session_start();



if(isset($_SESSION['authenticated']))
{

    $_SESSION['status'] = "Youre Already Logged In";
    header('Location:dashboard.php');
    exit(0);
}

$page_title = "Login Form";
include('include/header.php');
include('include/navbar.php');

?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <?php
                if(isset($_SESSION['status']))
                {

                    ?>

                    <div class="alert alert-success">
                        <h5><?= $_SESSION['status']; ?></h5>

                    </div>

                    <?php

                    unset($_SESSION['status']);
                }
                
                
                ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Login form</h5>
                        <div class="card-body">
                            <form action="logincode.php" Method="POST">
                                
                                <div class=" form-group mb-3">
                                    <label for="name">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class=" form-group mb-3">
                                    <label for="name">password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
            
                                <div class="form-group">
                                    <button type="submit" name="login_btn" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include('include/footer.php');?>