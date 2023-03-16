 <?php include('../config/constants.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fooder Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    
        <div class="login">
            <h1 class="text-center">Login</h1>
                    <br> <br>
            <?php
                if(isset($_SESSION['login'])) 
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }


                ?>

            <!-- Login form Starts here -->
            <br>
                <form action="" method="POST">
                    Username: <br>
                    <input type="text" name="username" placeholder="Enter username"> <br><br>
                    Password: <br>
                    <input type="password" name="password" placeholder="Enter password"> <br>
                        <br>
                    <input type="submit" name="submit" value="Login" class="button">
                
                </form>

            
            <!-- Login form Ends here -->
                <br>
            <p class="text-center">Created by - <a href="www.sezarem.com">Sezare Miguel</a> </p>
        </div>
</body>
</html>

<?php

    //Check is submit button is clicked
    if(isset($_POST['submit']))
    {
        //Process for login
        //Get the data from the form
       $username = $search = mysqli_real_escape_string($conn, $_POST['username']);
       
       $raw_password = md5($_POST['password']);
       $password = mysqli_real_escape_string($conn, $raw_password);

       //SQL to check whether username and password exists or not
       $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

       //3. Execute the query
       $res = mysqli_query($conn, $sql);

       //4. Count rows to check if user exists or not
       $count = mysqli_num_rows($res);
       if($count==1)
       {
        // User available and Login success
        $_SESSION['login'] = "<div class='success'>Loged in Successfully!</div>";
        $_SESSION['user'] = $username; //This controls the logedin access/ Logout will unset it all.
        //Redirect to home page/ Dashboard
       header('location:'.SITEURL.'admin/');

       }
       else
       {
        //user not Available
        $_SESSION['login'] = "<div class='error'>Username or Password did not Match...</div>";
        //Redirect to login page
        header('location:'.SITEURL.'admin/login.php');
 

       }
    }