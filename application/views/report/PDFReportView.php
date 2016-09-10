
<html>
    <body>

        <style type="text/css">
    .text-box-none
    {
        background: transparent none repeat scroll 0 0;
        border: medium none;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table, td, th {
        border: 1px solid #ccc;
        background-color:#fff;
    }
    
    

</style>

        <table id="reportinvoice" class="subgrid" style="margin-bottom: 10px;">
            <thead>
                <tr>

                    <th>Date</th>
                    <th>Order No</th> 
                    <th>Customer Name</th>
                    <th>Item Description</th>
                    <th>Purchased Shop</th>
                    <th>Sold Price</th>
                    <th>Purchased Price</th>
                    <th>Deliver Cost</th>
                    <th>Delivered / Pickup By</th>
                    <th>Net</th>
                    <th>Payment Mode</th>
                    <th>Cash Received</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($month_viewReport_list)) {
                    
                    $sold_price=0;
                    $purchase_price=0;$deliver_cost=0;$net_cost=0;$cash_received=0;
                    foreach ($month_viewReport_list as $reports) {
                        ?>
                        <tr>

                            <td>
                                <?php echo $reports['order_date']; ?>
                            </td>
                            <td>
                                <?php echo $reports['order_no']; ?>
                            </td>
                            <td>
                                <?php echo $reports['customer_name']; ?>
                            </td>
                            <td>
                                <?php echo $reports['item_description']; ?>
                            </td>
                            <td>

                                <?php
                                foreach ($purchase_shop_details as $details) {
                                    if ($details['id'] == $reports['purchase_id']) {
                                        echo $details['name'];
                                    }
                                }
                                ?>


                            </td>
                            <td>
                                <?php echo $reports['sold_price']; $sold_price+=$reports['sold_price'];?>
                            </td>
                            <td>
                                <?php echo $reports['purchase_price']; $purchase_price+=$reports['purchase_price'];?>
                            </td>
                            <td>
                                <?php echo $reports['deliver_cost']; $deliver_cost+=$reports['deliver_cost'];?>
                            </td>
                            <td>

                                <?php
                                foreach ($deliver_pickup_list as $details) {
                                    if ($details['id'] == $reports['deliver_pickup_id']) {
                                        echo $details['name'];
                                    }
                                }
                                ?>
                                </select> 
                            </td>
                            <td>
                                <?php echo $reports['net']; $net_cost+=$reports['net'];?>
                            </td>
                            <td>

                                <?php
                                foreach ($payment_mode_list as $details) {
                                    if ($details['id'] == $reports['payment_id']) {
                                        echo $details['name'];
                                    }
                                }
                                ?>
                                </select> 
                            </td>
                            <td>
                                <?php echo $reports['cash_received']; $cash_received+=$reports['cash_received']; ?>
                            </td>
                            <td>
                                <?php
                                    if ($reports['status'] == "1") {
                                        echo "Verified";
                                    }
                                    else if ($reports['status'] == "2") 
                                    {
                                        echo "Unverified";
                                    }
                                    ?>
                            </td>
                        </tr>
    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">&nbsp;</td>
                        <td style="text-align: left"><?php echo "AED ".$sold_price;?></td>
                        <td style="text-align: left"><?php echo "AED ".$purchase_price;?></td>
                        <td style="text-align: left"><?php echo "AED ".$deliver_cost;?></td>
                        <td>&nbsp;</td>
                        <td style="text-align: left"><?php echo "AED ".$net_cost;?></td>
                        <td>&nbsp;</td>
                        <td style="text-align: left"><?php echo "AED ".$cash_received;?></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr style="background-color: #fff;">
                        <td colspan="12" style="padding-left: 40px;">Total Sale</td>
                        <td><?php echo "AED ".$sold_price;?></td>
                    </tr>
                    <tr style="background-color: #fff;">
                        <td colspan="12" style="padding-left: 40px;">Daily Net Income</td>
                        <td><?php echo "AED ".$net_cost;?></td>
                    </tr>
                    <tr style="background-color: #fff;">
                        <td colspan="12" style="padding-left: 40px;">Opening Balance</td>
                        <td>AED 0.00</td>
                    </tr>
                    <tr style="background-color: #fff;">
                        <td colspan="12" style="padding-left: 40px;">Cash on Hand</td>
                        <td><?php echo "AED ".$sold_price;?></td>
                    </tr>
                    <tr style="background-color: #fff;">
                        <td colspan="12" style="padding-left: 40px;">Money Deposited</td>
                        <td>AED 0.00</td>
                    </tr>
                    <tr style="background-color: #fff;">
                        <td colspan="12" style="padding-left: 40px;">Closing Balance</td>
                        <td>AED 0.00</td>
                    </tr>

                    <?php
                } else {
                    echo "<tr style='background-color:#fff;text-align:center;height:50px;'><td colspan='13'>No Record</td></tr>";
                }
                ?>
            </tfoot>
        </table>

    </body>
</html>