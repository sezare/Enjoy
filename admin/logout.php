<?php include ('../config/constants.php'); ?>

<?php
    // Distroy the sesson 
    session_destroy(); //Unsets $_SESSION['user']
    // Redirect to homepage
    header('location:'.SITEURL.'admin/login.php');

?>