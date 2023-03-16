<?php
 
 //include constant.php file
    include('../config/constants.php');

    //Get the dD of the admin to be Deleted
   echo $id = $_GET['id'];

    //2. Create SQL Query 
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check if the query is executed fully or not
    if($res==TRUE)
    {
        //Query Executed successfully and Admin Deleted.
        //echo "Admin Deleted";
        //create session message variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted successfully!</div>";
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
     else
     { 
       // Failed to delete admin
       //echo "Failed to delete Admin";
       $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin, Try again later.</div>";
       header('location:'.SITEURL.'admin/manage-admin.php');

    }

    //3. Redirect to manage admin page + message of success or error
?>