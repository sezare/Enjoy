<?php include('partials/menu.php'); ?>

 <div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
            //Get the id of sekected of the admin
            $id=$_GET['id'];

            //Create the sql to get the details
            $sql="SELECT * FROM tbl_admin WHERE id=$id"; 

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check wherether the query is executed or not
            if($res==true);
            {
                //Check if data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we admin data or not
                if($count==1)
                {
                   //Get the Details
                    //echo "Admin Available";
                    $rows=mysqli_fetch_assoc($res);

                    $full_name = $rows['full_name'];
                    $username = $rows['username'];
                }
                else
                {
                    //Redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

        ?>


        <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full name:</td>
                            <td><input type="text" name="full_name" value="<?php echo $full_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                            <td><input type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
        </form>
    </div>
 </div>

<?php
    //Check whether the submit Button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //Get all the values from form to update
       $id = $_POST['id'];
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];

       // Create a SQL Query to update admin
       $sql = "UPDATE tbl_admin SET
       full_name = '$full_name',
       username = '$username' 
       WHERE id='$id'
       ";
       // Execute the Query
       $res = mysqli_query($conn, $sql);

       //Check if the query is executed successfully
       if($res==true)
       {
        //Query  executed and admin updated 
        $_SESSION['update'] = "<div class='success'>Admin updated successfully!</div>";
        //Redirect to Manage Admin page
        header('location:'.SITEURL.'admin/manage-admin.php'); 

       }
       else
       {
            //Failed to update the admin
        
            $_SESSION['update'] = "<div class='error'>Failed to update admin.</div>";
            //Redirect to Manage Admin page
            header('location:'.SITEURL.'admin/manage-admin.php'); 
    
       }
    }

?>

<?php include('partials/footer.php'); ?>