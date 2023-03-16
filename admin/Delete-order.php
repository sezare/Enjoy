<?php 
        include('../config/constants.php');

//Check if the id and image_name value is set or not
if(isset($_GET['id'])) 
{
    //Get the value and delete
    $id = $_GET['id'];

    //Delete data from database
    $sql = "DELETE FROM tbl_order WHERE id=$id";

    //Execute the query 
    $res = mysqli_query($conn, $sql);

    // Check if the data is deleted from the database or not
    if($res==true)
    {
        //Set success msg and Redirect
        $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully!</div>";
        //Redirect to manage category
        header('location:'.SITEURL.'admin/manage-order.php');
    }
    else
    {
        //Set failed Message and redirect
         $_SESSION['delete'] = "<div class='error'>Failed to Delete the Order</div>";
         //Redirect to manage category
         header('location:'.SITEURL.'admin/manage-order.php');

    }


}
else
{
    //Redirect to manage Category Page
    header('location:'.SITEURL.'admin/manage-order.php');
}



?>