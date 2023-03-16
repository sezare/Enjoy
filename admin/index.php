<?php include('partials/menu.php'); ?>

     <!-- Main Content Section Start-->
     <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>

            <?php
                if(isset($_SESSION['login'])) 
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                
                ?>
                <br> <br>

        <a href="manage-category.php" class="btn">
            <div class="col-4 text-center">
                <?php
                //
                $sql = "SELECT * FROM tbl_category";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);
                    ?>

                <h1><?php echo $count; ?></h1>
                <br>
                Categories
            </div>
        </a>

        <a href="manage-food.php" class="btn">
            <div class="col-4 text-center">
            <?php
                //
                $sql2 = "SELECT * FROM tbl_food";
                //Execute Query
                $res2 = mysqli_query($conn, $sql2);
                //Count Rows
                $count2 = mysqli_num_rows($res2);
                    ?>

                <h1><?php echo $count2; ?></h1>
                <br>
                Foods
            </div>
        </a>

        <a href="manage-order.php">
            <div class="col-4 text-center">
            <?php
                //
                $sql3 = "SELECT * FROM tbl_order";
                //Execute Query
                $res3 = mysqli_query($conn, $sql3);
                //Count Rows
                $count3 = mysqli_num_rows($res3);
                    ?>

                <h1><?php echo $count3; ?></h1>
                <br>
                Total Orders
            </div>
        </a>

        <a href="manage-sales.php" class="btn">
            <div class="col-4 text-center">
                <?php 
                //SQL query to get total Revenue Generated
                $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                //Execute the query
                $res4 = mysqli_query($conn, $sql4);

                //Get the value
                $row4 = mysqli_fetch_assoc($res4);

                //Get total revenue
                $total_revenue = $row4['Total'];


                ?>
                <h1>N$
                <?php 

                    if($count>0)
                    {
                        //Display the revenue
                        echo $total_revenue; 
                    }
                    else
                    {
                        //Display zero revenue
                        if($count<0)
                        echo $total_revenue = '0.00'; 
                        
                    }
                
                
                ?>
                </h1>
                <br>
                Revenue Generated
            </div>
        </a>
            <div class="clearfix"></div>

        </div>
     </div>
    <!-- Main Content Section Ends -->
    
<?php include('partials/footer.php');