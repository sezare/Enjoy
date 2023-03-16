<?php
        //Authoralization - Access contorl
        //Check if the user is signed in or not
        if(!isset($_SESSION['user']))
        {
           //user is not logedin
           //Redirect to login page with message
           $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
            header('location:'.SITEURL.'admin/login.php');
        }

?>