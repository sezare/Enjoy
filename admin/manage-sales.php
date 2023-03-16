<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">

                        <a href="<?php echo SITEURL; ?>admin/add-payment.php" class="btn-primary">Add A Payment</a>
                        <br> <br>
                <table class="tbl-full">
                        <tr>
                            <th>S.N.</th>
                            <th>Full Name</th>
                            <th>Total</th>
                            <th>Payment Type</th>
                        </tr>
                        <?php
                    //Query to get all the data from the Category Database
                    $sql = "SELECT SUM(total) AS Total FROM tbl_sales WHERE payment_method=''";

                    //Execute Query
                    $res = mysqli_query($conn, $sql);

                    //Count rows
                    $count = mysqli_num_rows($res);

                    //Create serial number variable and assign value as 1

                    $sn=1; 

                    // Check whether data is in the database or not
                    if($count>0)
                    
                        //we have data in the database
                         //Get the data and display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $full_name = $_POST['full_name'];
                            $total = $_POST['total'];
                            $payment_method = $_POST['payment_method'];
                        }
                            ?>
 
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $total; ?></td>

                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $payment_method; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-sales.php?" class="btn-secondary">Update Payment</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-payment.php?" class="btn-danger"> Delete Payment</a>
                                    </td> 
                                </tr>

                </table>

            </div>
        </div>

        <?php   
         //Update the values 
         $sql2 = "UPDATE tbl_sales SET
         full_name= $full_name,
         total = $total, 
         payment_method = $payment_method
         ";

        ?>


<?php include('partials/footer.php'); ?>