<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Sales</h1>
            <br> <br>
            <h3 class="sales">Sales Report</h3>
            
            <form action="" method="POST">
                <table class="tbl-30">

                    <tr>
                        <td>Payment Method</td>
                        <td>
                            <input type="text" name="payment" value="">
                        </td>
                    </tr>

                    <tr>
                        <td>Total</td>
                        <td>
                            <input type="number" name="number" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>Payment Date</td>
                        <td>
                            <input type="date" name="date" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>Returns</td>
                        <td>
                            <input type="number" name="number" value="">
                        </td>
                    </tr>

                    <tr>
                    <a href="<?php echo SITEURL; ?>admin/manage-sales.php?" class="btn-secondary">Save</a>
                    </tr>
                </table>
            </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>