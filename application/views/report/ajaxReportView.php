<div style="margin: 20px;text-align: right;">

    <a  href="javascript:void(0)" onclick="window.open('<?php echo base_url() . 'dashboard/generateviewReportExcel?start_date=' . $start_date . '&end_date=' . $end_date; ?>')"  class="btn btn-default">Excel</a>
    <a href="javascript:void(0)" onclick="window.open('<?php echo base_url() . 'dashboard/generateviewReportCSV?start_date=' . $start_date . '&end_date=' . $end_date; ?>')" class="btn btn-default">CSV</a>
    <a href="javascript:void(0)" onclick="window.open('<?php echo base_url() . 'dashboard/generateviewReportPDF?start_date=' . $start_date . '&end_date=' . $end_date; ?>')" class="btn btn-default">PDF</a>
</div>


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
            foreach ($month_viewReport_list as $reports) {
                ?>
                <tr>

                    <td>
                        <input type="text" name="order_date[]" maxlength="15" value="<?php echo $reports['order_date']; ?>" required>
                    </td>
                    <td>
                        <input class="h5-number" type="text" name="order_no[]" maxlength="15" value="<?php echo $reports['order_no']; ?>">
                    </td>
                    <td>
                        <input type="text" name="customer_name[]" value="<?php echo $reports['customer_name']; ?>" maxlength="100" required>
                    </td>
                    <td>
                        <input class="h5-number" type="text" name="item_description[]" value="<?php echo $reports['item_description']; ?>" maxlength="100" required>
                    </td>
                    <td>
                        <select class="purchaseShop" name="purchased_shop[]" required>
                            <option value="">Select Purchased Shop</option>
                            <?php foreach ($purchase_shop_details as $details) { ?>

                                <option value='<?php echo $details['id']; ?>' <?php
                                if ($details['id'] == $reports['purchase_id']) {
                                    echo 'selected';
                                }
                                ?>><?php echo $details['name']; ?></option>
                                    <?php }
                                    ?>
                        </select> 
                    </td>
                    <td>
                        <input class="soldcollected" type="text" name="sold_price[]" value="<?php echo $reports['sold_price']; ?>" maxlength="10" required>
                    </td>
                    <td>
                        <input class="purchasecollected" type="text" name="purchase_price[]" value="<?php echo $reports['purchase_price']; ?>" maxlength="10" required>
                    </td>
                    <td>
                        <input class="deliverycostcollected" type="text" name="deliver_cost[]" value="<?php echo $reports['deliver_cost']; ?>" maxlength="10" required>
                    </td>
                    <td>
                        <select name="deliver_pickup[]" class="deliverPickup" required>
                            <option value="">Select Deliver / Pickup</option>
                            <?php foreach ($deliver_pickup_list as $details) { ?>                            
                                <option value='<?php echo $details['id']; ?>' <?php
                                if ($details['id'] == $reports['deliver_pickup_id']) {
                                    echo 'selected';
                                }
                                ?>><?php echo $details['name']; ?></option>
                                    <?php }
                                    ?>
                        </select> 
                    </td>
                    <td>
                        <input class="netcollected" type="text" name="net[]" value="<?php echo $reports['net']; ?>" maxlength="10" readonly>
                    </td>
                    <td>
                        <select name="payment_mode[]" class="paymentMode" required>
                            <option value="">Select Payment</option>
                            <?php foreach ($payment_mode_list as $details) { ?>                           
                                <option value='<?php echo $details['id']; ?>' <?php
                                if ($details['id'] == $reports['payment_id']) {
                                    echo 'selected';
                                }
                                ?>><?php echo $details['name']; ?></option>
                                    <?php }
                                    ?>
                        </select> 
                    </td>
                    <td>
                        <input class="cashreceivedcollected" type="text" name="cash_received[]" value="<?php echo $reports['cash_received']; ?>" maxlength="10" required>
                    </td>
                    <td>
                        <select name="status[]" required>
                            <option value="">Select Status</option>
                            <option value="1" <?php
                            if ($reports['status'] == "1") {
                                echo "selected";
                            }
                            ?>>Verified</option>
                            <option value="2" <?php
                            if ($reports['status'] == "2") {
                                echo "selected";
                            }
                            ?>>Unverified</option>   
                        </select>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">&nbsp;</td>
                <td style="text-align: left"><input class="soldamt_total bg" name="sold_total[]" type="text" value="" readonly></td>
                <td style="text-align: left"><input class="purchasedamt_total bg" name="purchased_total[]" type="text" value="" readonly></td>
                <td style="text-align: left"><input class="delivercostamt_total bg" name="delivercost_total[]" type="text" value="" readonly></td>
                <td>&nbsp;</td>
                <td style="text-align: left"><input class="netamt_total bg" name="net_total[]" type="text" value="" readonly></td>
                <td>&nbsp;</td>
                <td style="text-align: left"><input class="cash_receivedamt_total bg" name="cash_received_total[]" type="text" value="" readonly></td>
                <td>&nbsp;</td>
            </tr>
            <tr style="background-color: #fff;">
                <td colspan="12" style="padding-left: 40px;">Total Sale</td>
                <td><input type="text" class="total_sale text-box-none" name="total_sale[]" placeholder="Total Sale" readonly></td>
            </tr>
            <tr style="background-color: #fff;">
                <td colspan="12" style="padding-left: 40px;">Daily Net Income</td>
                <td><input type="text" class="daily_net text-box-none" name="daily_net[]" placeholder="Daily Net Income" readonly></td>
            </tr>
            <tr style="background-color: #fff;">
                <td colspan="12" style="padding-left: 40px;">Opening Balance</td>
                <td><input type="text" class="opening_balance text-box-none" name="opening_balance[]" placeholder="Opening Balance"></td>
            </tr>
            <tr style="background-color: #fff;">
                <td colspan="12" style="padding-left: 40px;">Cash on Hand</td>
                <td><input type="text" class="cash_on_hand text-box-none" name="cash_on_hand[]" placeholder="Cash on Hand" readonly></td>
            </tr>
            <tr style="background-color: #fff;">
                <td colspan="12" style="padding-left: 40px;">Money Deposited</td>
                <td><input type="text" class="money_deposited text-box-none" name="money_deposited[]" placeholder="Money Deposited"></td>
            </tr>
            <tr style="background-color: #fff;">
                <td colspan="12" style="padding-left: 40px;">Closing Balance</td>
                <td><input type="text" class="closing_balance text-box-none" name="closing_balance[]" placeholder="Closing Balance" readonly></td>
            </tr>

            <?php
        } else {
            echo "<tr style='background-color:#fff;text-align:center;height:50px;'><td colspan='13'>No Record</td></tr>";
        }
        ?>
    </tfoot>
</table>