
<?php include('partials/menu.php'); ?>

    <div class="main-content">
            <div class="wrapper">
                <h1>Change Password: </h1>
               <br> <br>
            
                <?php
                    if(isset($_GET['id']))
                    {
                        $id=$_GET['id'];
                    }
                ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password: </td>
                        <td>
                            <input type="password" name="current_password" placeholder="Current password">
                        </td>
                    </tr>

                    <tr>
                        <td>New Password: </td>
                        <td>
                            <input type="password" name="new_password" placeholder="New Password">
                        </td>  
                    </tr>

                    <tr>
                        <td>Confirm Password: </td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </td>
                    </tr>

                    <tr>
                       <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                       </td> 
                    </tr>

                </table>
            </form>
        </div>
    </div>  
<?php
            //Check wherther the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the data from form
                $_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);


                //2. Check whether the user with the ID and Current password Exists or not
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                //Execute the Query 
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //Check data is available or not
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                       //User exists and password can be changed
                       //echo "User Found!";

                       //Check whether the new password confirmed or not
                       if($new_password==$confirm_password)
                       {
                            //Update the password
                           $sql2 = "UPDATE tbl_admin SET
                                password='$new_password'
                                WHERE id=$id
                           ";

                           //Execute the query
                           $res2 = mysqli_query($conn, $sql2);
                            
                           //Check if query executed or not
                           if($res2==true)
                           {
                            //Display success message
                             $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully!</div>";
                            
                             //Redirect the user to Manage Admin page
                             header('location:'.SITEURL.'admin/manage-admin.php'); 
                           }
                           else
                           {
                            //Display error message
                                $_SESSION['change-pwd'] = "<div class='error'>Failed to Update Password!</div>";
                            
                                //Redirect the user to Manage Admin page
                                header('location:'.SITEURL.'admin/manage-admin.php'); 
                           }
                       }
                       else
                       {
                          //Redirect the manage Admin page with Error Message
                          $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match!</div>";
                        
                          //Redirect the user to Manage Admin page
                          header('location:'.SITEURL.'admin/manage-admin.php'); 
                       }
                
                    }
                    else
                    {
                        //User does not exist send message and redirect
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found!</div>";
                        
                        //Redirect the user to Manage Admin page
                        header('location:'.SITEURL.'admin/manage-admin.php'); 
                    }
                }

                //3. Check whether the new password and confirmed password macthe or not 

                //4. Update Password,  only if all above are TRUE
            }

?>


<?php include('partials/footer.php'); ?>