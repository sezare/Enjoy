<?php 
        include('../config/constants.php');

//Check if the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //Get the value and delete
    //echo "Get value and delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remove the physical image file if its available
    if($image_name != "")
    {
        //image is available, remove it
        $path = "../images/Category/".$image_name;
        //Remove the image
        $remove = unlink($path);
        
        //If failed to remove the image name, send error msg and stop the process
        if($remove==false)
        {
            //Send the sesssion message 
            $_SESSION['remove'] = "<div class='error'>Failed to remove Category Image...</div>";
             
            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
            //Stop the process
            die();
        }
    }

    //Delete data from database
    //Delete sql Query the database
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //Execute the query 
    $res = mysqli_query($conn, $sql);

    // Check if the data is deleted from the database or not
    if($res==true)
    {
        //Set success msg and Redirect
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        //Redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        //Set failed Message and redirect
         $_SESSION['delete'] = "<div class='error'>Failed to Delete Category</div>";
         //Redirect to manage category
         header('location:'.SITEURL.'admin/manage-category.php');

    }


}
else
{
    //Redirect to manage Category Page
    header('location:'.SITEURL.'admin/manage-category.php');
}



?>