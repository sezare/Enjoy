<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br> <br> 

        <?php 
            //Check whether the id is set or not
         if(isset($_GET['id']))
        {
            //Get all the details and id
            $id = $_GET['id'];
            //Create the sql query to get all the details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            //Execute the query 
            $res = mysqli_query($conn, $sql);

            //Count the rows if the id is valid or not
            $count = mysqli_num_rows($res);

                if($count==1)
                    {
                            //Get the data
                            $row = mysqli_fetch_assoc($res);
                            $title = $row['title'];
                            $current_image = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                    }
                    else
                    {
                        //Redirect to manage category with session msg
                        $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');

                    } 
        }
                else
                {
                //Redirect to manage Category page
                header('location:'.SITEURL.'admin/manage-category.php');
                }
        
        ?>
 

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td> 
                        <?php 
                            if($current_image != "")
                            {
                               //Display the image 
                               ?>
                               <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                               <?php
                               
                            }
                            else
                            {
                                //display the msg
                                echo  "<div class='error'>Image Not Added</div>";
                            }

                        ?>

                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                    <input <?php if($featured=="Yes"){echo "Checked";} ?> type="radio" name="featured" value="Yes">Yes
                   
                    <input <?php if($featured=="No"){echo "Checked";} ?> type="radio" name="featured" value="No">No

                </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                    <input <?php if($active=="Yes"){echo "Checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "Checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                // Get all the values from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //updating the new image if selected
                //check if image selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the image details 
                    $image_name = $_FILES['image']['name'];

                    //Check if image available or not
                    if($image_name != "")
                    {
                        //Check if image available

                        //Upload new image


                          //Auto rename the image 
                                //Get the extension of the image: jpg, png, gif, etc. @godfood.jpg
                                $ext = end(explode('.', $image_name));

                                //Rename the image
                                $image_name = "Food_Category_".rand(000, 999).'.'.$ext;// New name will be eg.Food_Category_567.jpg 
                                //U can aslo add date and time once image is posted or uploaded

                                $source_path = $_FILES['image']['tmp_name'];

                                $destination_path = "../images/category/".$image_name;

                                //Upload the image
                                $upload = move_uploaded_file($source_path, $destination_path);

                                //Check image if uploaded or not

                                //And if image is not uploaded, then stop the process and redirect with an error message
                                if($upload==false)
                                {
                                    //Set message
                                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                                    //Redirect to the Add Category Page
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    //Stop the proccess
                                    die();
                                }
                        
                        //remove the current image if available
                        if($current_image != "")
                        {
                                $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //Check if the image is removed or not
                            //if failed to remove, display the message and stop process
                            if($remove==false)
                            {
                                //Failed to remove the image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                                //Redirect to the Add Category Page
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die(); //Stop the process
                            }

                        }
                        
                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                }
                else
                {
                    //Create image name
                    $image_name = $current_image;
                }

                //update the database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";
                //Execute the query 
                $res2 = mysqli_query($conn, $sql2);

                //Redirect to manage category with the session message
                //Check if true or false
                if($res2 ==true)
                {
                    //Category update
                    $_SESSION['update'] = "<div class='success'>Category updated Successfully</div>";
                    //Redirect to the manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to update Category</div>";
                    //Redirect to the manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                    
                }

            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>