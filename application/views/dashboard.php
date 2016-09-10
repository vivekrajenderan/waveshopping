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
    form
    {
        margin: auto;
        width: 100%;
    }
    select{
        width:90px;
    }
    

</style>


<div class="container" style="background-color:#fff;">
    <div class="content-container">
        <div>
            <h4 class="heading-inline">Daily Transaction
                &nbsp;&nbsp;<small>Invoice Bill Entry</small>
                &nbsp;&nbsp;</h4>

        </div>
        <div class="content-header">
        
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url()."dashboard";?>">Home</a></li>          
          <li class="active">Invoice Page</li>
        </ol>
      </div>
        <form method="post" action="<?php echo base_url() . 'dashboard/addAjaxInvoice'; ?>" id="InvoiceForm">

            <table id="addaccount" class="subgrid" style="margin-bottom: 10px;">
                <thead>
                    <tr>
                        <th class="essential"></th>
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
                    <tr>
                        <td>
                            <a href='javascript:void(0);'  class='removeItem'><span style="margin: auto 10px;padding: 2px;font-size:12px;" class='glyphicon glyphicon-minus'></span></a>                    
                        </td>
                        <td>
                            <input class="dp-ex-1" type="text" name="order_date[]" value="" maxlength="15" required>
                        </td>
                        <td>
                            <input class="h5-number" type="text" name="order_no[]" value="" maxlength="15" required>
                        </td>
                        <td>
                            <input type="text" name="customer_name[]" value="" maxlength="100" required>
                        </td>
                        <td>
                            <input class="h5-number" type="text" name="item_description[]" value="" maxlength="100" required>
                        </td>
                        <td>
                            <select class="purchaseShop" name="purchased_shop[]" required>
                                <option value="">Select Purchased Shop</option>
                                <?php
                                foreach ($purchase_shop_details as $details) {
                                    echo "<option value='" . $details['id'] . "'>" . $details['name'] . "</option>";
                                }
                                ?>
                            </select> 
                        </td>
                        <td>
                            <input class="soldcollected" type="text" name="sold_price[]" value="" maxlength="10" required>
                        </td>
                        <td>
                            <input class="purchasecollected" type="text" name="purchase_price[]" value="" maxlength="10" required>
                        </td>
                        <td>
                            <input class="deliverycostcollected" type="text" name="deliver_cost[]" value="" maxlength="10" required>
                        </td>
                        <td>
                            <select name="deliver_pickup[]" class="deliverPickup" required>
                                <option value="">Select Deliver / Pickup</option>
                                <?php
                                foreach ($deliver_pickup_list as $details) {
                                    echo "<option value='" . $details['id'] . "'>" . $details['name'] . "</option>";
                                }
                                ?>
                            </select> 
                        </td>
                        <td>
                            <input class="netcollected" type="text" name="net[]" value="" maxlength="10" readonly>
                        </td>
                        <td>
                            <select name="payment_mode[]" class="paymentMode" required>
                                <option value="">Select Payment</option>
                                <?php
                                foreach ($payment_mode_list as $details) {
                                    echo "<option value='" . $details['id'] . "'>" . $details['name'] . "</option>";
                                }
                                ?>
                            </select> 
                        </td>
                        <td>
                            <input class="cashreceivedcollected" type="text" name="cash_received[]" value="" maxlength="10" required>
                        </td>
                        <td>
                            <select name="status[]" required>
                                <option value="">Select Status</option>
                                <option value="1">Verified</option>
                                <option value="2">Unverified</option>   
                            </select>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6"><a title="Add More" class="AddRow" style="font-size:12px;" href="javascript:void(0);"><span style="margin: auto 10px;padding: 2px;" class="glyphicon glyphicon-plus"></span></a></td>

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
                        <td colspan="13" style="padding-left: 40px;">Total Sale</td>
                        <td><input type="text" class="total_sale text-box-none" name="total_sale[]" placeholder="Total Sale" readonly></td>
                    </tr>
                    <tr style="background-color: #fff;">
                        <td colspan="13" style="padding-left: 40px;">Daily Net Income</td>
                        <td><input type="text" class="daily_net text-box-none" name="daily_net[]" placeholder="Daily Net Income" readonly></td>
                    </tr>
                    <tr style="background-color: #fff;">
                        <td colspan="13" style="padding-left: 40px;">Opening Balance</td>
                        <td><input type="text" class="opening_balance text-box-none" name="opening_balance[]" placeholder="Opening Balance"></td>
                    </tr>
                    <tr style="background-color: #fff;">
                        <td colspan="13" style="padding-left: 40px;">Cash on Hand</td>
                        <td><input type="text" class="cash_on_hand text-box-none" name="cash_on_hand[]" placeholder="Cash on Hand" readonly></td>
                    </tr>
                    <tr style="background-color: #fff;">
                        <td colspan="13" style="padding-left: 40px;">Money Deposited</td>
                        <td><input type="text" class="money_deposited text-box-none" name="money_deposited[]" placeholder="Money Deposited"></td>
                    </tr>
                    <tr style="background-color: #fff;">
                        <td colspan="13" style="padding-left: 40px;">Closing Balance</td>
                        <td><input type="text" class="closing_balance text-box-none" name="closing_balance[]" placeholder="Closing Balance" readonly></td>
                    </tr>


                </tfoot>
            </table>
            <div class="addtable"></div>
            <div>
                <input name="addaccount" id="AddAccount" type="button" value="Add a New" class="btn btn-tertiary"  /> &nbsp;&nbsp;<a href="<?php echo base_url() . 'dashboard/addExpense'; ?>" class="btn btn-tertiary" target="_blank">Add an Extra Expense</a>  
            </div>

            <br /> 
            <div style="margin: 50px auto;text-align: center;">
                <input name="submit" type="submit" value="Submit" class="btn btn-primary"/>
                <input name="cancel" type="submit" value="Cancel" class="btn btn-default"/>
            </div>

        </form>
    </div>
</div>