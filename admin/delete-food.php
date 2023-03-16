<?php
//Include constants page
include('../config/constants.php');

//echo "Delete Food";

//
if(isset($_GET['id']) && isset($_GET['image_name']))//u can use the ,&&, or ,AND,
{
    //Process to Delete
    //echo "Process to delete";

    //1. Get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //2. Delete the image if available
    //Check whether the image is available or not and delete if availale
    if($image_name != "")
    {
        //It has image and need to remove folder
        //Get the image path
        $path = "../images/food/".$image_name;

        //Remove Image File from Folder
        $remove = unlink($path);

        //Check whether the image is removed or not
        if($remove==false)
        {
            //Failed to upload 
            $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
            //Redirect to Manage Page
            header('location:'.SITEURL.'admin/manage-food.php');
            //Stop the proccess of deleting Food
            die();
        }
    } 

    //3. Delete Food from Database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check if the query executed respectively
    if($res==true)
    {
        //Food Deleted
        $_SESSION['delete'] ="<div class='success'>Food Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

    }
    else
    {
        //Failed to Delete food
         $_SESSION['delete'] ="<div class='error'> Failed to Delete Food</div>";
         header('location:'.SITEURL.'admin/manage-food.php');
 
    }

    //4.Redirect to Manage Food page with the session message

}
else
{
    //Redirect to manage Food Page
    //echo "Redirect";
    $_SESSION['delete'] = "<div class='error'>Unthorised Access</div>";
    header('location:'.SITEURL.'admin/manage-food.php');

}


?>