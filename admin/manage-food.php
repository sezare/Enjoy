<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
  
        <!-- button to add admin -->

        <br>

        <?php
            if(isset($_SESSION['add']))
                {
                    echo  $_SESSION['add'];
                    unset( $_SESSION['add']);
                }

            if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            
            if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            
            if(isset( $_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>

        <br> <br>

            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                <br> <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //Create SQL to get all the food
                    $sql = "SELECT * FROM tbl_food";

                    //Execute Query
                    $res = mysqli_query($conn, $sql);

                    //Count rows, to check if we have food or not
                    $count = mysqli_num_rows($res);

                    //Cretae serial number variable and st default value as 1

                    $sn=1;

                    if($count>0)
                        {
                            //We have food in the database
                            //Get food from the databse and display them
                            while($row=mysqli_fetch_assoc($res))
                            {
                              //get the values from individual colums
                              $id = $row['id']; 
                              $title = $row['title'];
                              $price = $row['price'];
                              $image_name = $row['image_name'];
                              $featured = $row['featured'];
                              $active = $row['active'];
                             ?>

                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $title; ?></td>
                                <td>N$<?php echo $price; ?></td>
                                <td>
                                    <?php 
                                    //Check ehether if there is image or not
                                        if($image_name=="")
                                        {
                                            //We donot have the image , display the error message
                                            echo "<div class='error'>No Image Added</div>";
                                        }
                                        else
                                        {
                                            //We have Image;Display imgage
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ;?>" width="100px">
                                            <?php
                                        }
                                    
                                     ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>"class="btn-secondary">Update Food</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> Delete Food</a>
                                </td>
                            </tr>

                             
                             
                             <?Php 
                            }
                        }
                        else
                        {
                          //Food not added in the database
                          echo "<tr> <td colspan='7' class='error'>No Food Added</tr></td>";

                        }
                ?>

            </table>     
    </div>
</div>

<?php include('partials/footer.php'); ?>