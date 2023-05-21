<?php


$page_title = "Resend Form";
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
                        <h5>Resend Email Activation Link</h5>
                        <div class="card-body">
                            <form action="resend_email.php" Method="POST">
                                
                                <div class=" form-group mb-3">
                                    <label for="name">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
            
                                <div class="form-group">
                                    <button type="submit" name="resend_btn" class="btn btn-primary">Resend</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

