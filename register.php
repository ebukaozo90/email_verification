<?php 
session_start();
$page_title = "Registration Form";
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
                        <h5>Registration form</h5>
                        <div class="card-body">
                            <form action="code.php" method="POST">
                                <div class=" form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class=" form-group mb-3">
                                    <label for="name">telephone</label>
                                    <input type="telephone" name="phone" class="form-control">
                                </div>
                                <div class=" form-group mb-3">
                                    <label for="name">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class=" form-group mb-3">
                                    <label for="name">password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class=" form-group mb-3">
                                    <label for="name">Comfirm password</label>
                                    <input type="password" name="c_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="register_btn" class="btn btn-primary">Register</button>
                                </div>

                                <hr>
                                <h5>Did not get activation <a href="resend.php">Resend</a></h5>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include('include/footer.php');?>