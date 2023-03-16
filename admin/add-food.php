<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">

        <h1>Add Food</h1>
        <br> <br>

        <?php

            if(isset( $_SESSION['upload']))
            {
                echo  $_SESSION['upload'];
                unset( $_SESSION['upload']);
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title for Food" value="">
                    </td> 
                </tr>
                
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="4"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                        <td>
                            <select name="category" id="">

                                <?php 
                                //Create php code todisplay category from database
                                //Create sql to get all active category from tadabase
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res = mysqli_query($conn, $sql);

                                //Count rows to check if we have category or not
                                $count = mysqli_num_rows($res);

                                //If count is greater than zero, then we have categories
                                if($count>0)
                                {
                                  //We  have categories 
                                  while($row=mysqli_fetch_assoc($res))
                                  {
                                    //Get the details of the categories
                                    $id = $row['id'];
                                    $title =  $row['title'];

                                    ?>
                                     <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    
                                    <?php
                                  }
                                }
                                else
                                {
                                    //we do not have Category
                                    ?>
                                     <option value="0">No Categories Found</option>

                                    <?php

                                }

                                //display on Dropdown
                                ?>
                            </select>
                        </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
            
        <?php 
        //check if button is clicked or not 
        if(isset($_POST['submit']))
        {
            //Add food in the Database
            //echo "Clicked button";

            //1. Get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            // Check if Radio button is clicked or not
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                $featured = "No";//Seting the default value

            }

            if(isset($_POST['active']))
            {
               $active = $_POST['active']; 
            }
            else
            {
                $active ="No"; //Seting it todefault value
            }

            //Upload the image if selected
            //chek if the selected image is clicked or not and upload the image only if the image selected
            if(isset($_FILES['image']['name']))
            {
                //Get the details of the selected image else dset default value as no or blank
                $image_name = $_FILES['image']['name'];

                //Check if the image is selected or nto and upload image only if selected
                if($image_name!="")
                {
                    //image is selected
                    //a.Rename the image
                    //get the extension of the selected image like, jpeg, gif, png("sezare-miguel.jpg) = sezare-miguel jpg
                    $ext = end(explode('.',$image_name));
                    
                    //Create new name for image
                    $image_name = "Food-Name-".rand(0000,9999).".".$ext; //new image name eg."Food name 657.pgn"

                    //b.upload the image
                    //Get the source path and destination

                    //Source path is the current location of the image
                    $src=$_FILES['image']['tmp_name'];

                    //Destination path
                    $dst = "../images/food/".$image_name;

                    //Upload the food image 
                    $upload = move_uploaded_file($src, $dst);

                    //Checkif the image uploaded or not
                    if($upload==false)
                    {
                        //Failed to upload image
                        //redirect to add food error message
                        $_SESSION['upload'] ="<div class='error'>Failed to upload Image</div>";
                        header('loocation:'.SITEURL.'admin/add-food.php');
                        //Stop the process
                        die();

                    }

                }
            }
            else
            {
                $image_name ="";//Seting the default value as blank
           
            }
            
            //insert into database

            // Create the sql Query to save the database
            //For numerical value we do not nee dto pass value inside the quote(But for a string value we need to use quotations'')
            $sql2 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
            ";

            //Execute the query 
            $res2 = mysqli_query($conn, $sql2);

            //Check if data inserted to database or not
              //Redirect with the message with the Manage food page
            if($res2 == true)
            {
               //Data isnerted correctly
               $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else
            {
                //Failed to insert data
                 //Data isnerted correctly
               $_SESSION['add'] = "<div class='error'>Failed to Add Food</div>";
               header('location:'.SITEURL.'admin/manage-food.php');
            }
            
        }


        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>