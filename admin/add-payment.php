<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
           <h1>Payment</h1> 

            <br>  <br>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //Displaying the session message
                    unset($_SESSION['add']); //this is removing session message
                }
            ?>


            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Full name:</td>
                            <td><input type="text" name="full_name" placeholder="Enter customer's name"></td>
                    </tr>

                    <tr>
                        <td>Total Amount:</td>
                        <td><input type="num" name="total" placeholder="Enter total amount"></td>
                    </tr>

                    <tr>
                       <td>Payment Method</td>
                       <td>
                        <select name="payment-method">
                           <option value="Paid Cash">Cash</option>
                           <option value="Paid EFT">EFT</option>
                           <option value="Returned">Returned</option>
                        <!-- <option <?php if($payment_mehtod=="Paid Cash"){echo "selected";} ?> value="Paid Cash">Paid Cash</option>
                        <option <?php if($payment_method=="Paid EFT"){echo "selected";} ?> value="Paid EFT">Paid EFT</option>
                        <option <?php if($payment_method=="Returned"){echo "selected";} ?> value="Returned">Returned</option> -->
                        </select>
                       </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Payment" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>


<?php include("partials/footer.php"); ?>

<?php
    // process the value from the form and save it to Database
    if(isset($_POST['submit']))
    {
        // Button clicked
        // echo "Button clicked"
        // Get data from form
        $full_name = $_POST['full_name'];
        $total = $_POST['total'];
        $payment_method = $_POST['payment_method'];
       

    //2. SQL Query to save data into database
        $sql = "INSERT INTO tbl_sales SET
            full_name='$full_name', 
            total='$total',
            payment_method='$payment_method'
        ";
     
    // 3.executing query and saving the data to the database 
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    // 4. Check whether the (Query is executed) data is inserted and displayed appropriate message.
    if($res==TRUE)
    { 
        // Data inserted
        // echo "Data inserted";
        // create a ssession variable to display message
        $_SESSION['add'] = "Payments Added Successfully";
        // redirect page to MANAGER SALES
        header('location:'.SITEURL.'admin/manage-sales.php');
    }
    else
    {
        // Failed to insert Data
        // echo "Data not inserted"; 
        $_SESSION['add'] = "Failed to add Payment";
        // redirect page to MANAGER SALES
        header('location:'.SITEURL.'admin/add-payment.php'); 
    }

    }
?>