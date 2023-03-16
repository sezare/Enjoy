<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
           <h1>Add Admin</h1> 

            <br>  <br>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //Displaying the session message
                    unset($_SESSION['add']); //this is removing session message
                }
            ?>


            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Full name:</td>
                            <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                    </tr>

                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Your username"></td>
                    </tr>

                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Your password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>


<?php include("partials/footer.php"); ?>

<?php
    // process the value from the form and save it to Database
    if(isset($_POST['submit']))
    {
        // Button clicked
        // echo "Button clicked"
        // Get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encrypted with md5
    //2. SQL Query to save data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name', 
            username='$username',
            password='$password'
        ";
     
    // 3.executing query and saving the data to the database 
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    // 4. Check whether the (Query is executed) data is inserted and displayed appropriate message.
    if($res==TRUE)
    { 
        // Data inserted
        // echo "Data inserted";
        // create a ssession variable to display message
        $_SESSION['add'] = "Admin Added Successfully";
        // redirect page to MANAGER ADMIN
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // Failed to insert Data
        // echo "Data not inserted"; 
        $_SESSION['add'] = "Failed to add Admin";
        // redirect page to MANAGER ADMIN
        header('location:'.SITEURL.'admin/add-admin.php'); 
    }

    }
?>