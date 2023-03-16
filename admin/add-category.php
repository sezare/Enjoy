<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>

            <br> <br>

            <?php

                if(isset($_SESSION['add']))
                    {
                        echo  $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                if(isset($_SESSION['upload']))
                    {
                        echo  $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }


            ?>

            <br> <br>

            <!-- Add Category forms Starts -->
            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
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
                           <input type="submit" name="submit" value="Add Category" class="btn-secondary"> 
                        </td>
                    </tr>
                </table>

            </form>
            <!--Add category ends here -->
            <?php

                //Is the submit button clicked 
                if(isset($_POST['submit']))
                {
                    //echo "Button Clicked";

                    //1. Get value from Category from form
                    $title = $_POST['title'];

                    //For radio imput to check if selected or not
                    if(isset($_POST['featured']))
                    {
                        //Get the value from form
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        //Set the Default value
                        $featured = "No";
                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No";
                    }

                        //Check wherther the image is selected or not
                        // print_r($_FILES['image']);

                       // die(); Break the code here. no data shall be printed

                       if(isset($_FILES['image']['name']))
                       {
                        //Upload the image
                        //To upload we need an image name, souce path and destination name.
                        $image_name = $_FILES['image']['name'];
                       
                        //Upload the image only if image is selected
                        if($image_name="")
                            { 
                        
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
                                    header('location:'.SITEURL.'admin/add-category.php');
                                    //Stop the proccess
                                    die();
                                }
                             }
                        }
                       else
                       {
                        //Dont Upload the image and set it as image value blank
                            $image_name="";
                       }

                    //2. Create SQL Query to insert category in database
                        $sql = "INSERT INTO tbl_category SET
                            title='$title',
                            image_name='$image_name',
                            featured='$featured',
                            active='$active'
                        ";

                //3. Execute the query and save to database
                $res = mysqli_query($conn, $sql);

                //4. Check if query executed or not and data added or not
                if($res==true)
                {
                    //Query executed and Category added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully!</div>";

                    //Redirect to manage category
                    header('location:'.SITEURL.'admin/manage-category.php');

                }
                else
                {
                    //Failed to Add Category
                    //Query executed and Category added
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";

                    //Redirect to manage category
                    header('location:'.SITEURL.'admin/manage-category.php');


                }
            }

            ?>

        </div>
    </div>


<?php include('partials/footer.php'); ?>