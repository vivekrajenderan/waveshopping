
//Add Invoice Functions Start

$(function () {
    // Append Invoice Line

    $('.dp-ex-1').datepicker();
    $(document).on('click', '.AddRow', function () {
        var currentTable = $(this).closest('table').attr('id');
        var purchaseShop = $(".purchaseShop").html();
        var deliverPickup = $(".deliverPickup").html();
        var paymentMode = $(".paymentMode").html();
        $('#' + currentTable + ' tbody').append(' <tr> <td> <a href="javascript:void(0);"  class="removeItem"><span style="margin: auto 10px;padding: 2px;font-size:12px;" class="glyphicon glyphicon-minus"></span></a> </td> <td> <input class="dp-ex-1" type="text" name="order_date[]" value="" maxlength="15" required> </td> <td> <input class="h5-number" type="text" name="order_no[]" value="" maxlength="15" required> </td> <td> <input type="text" name="customer_name[]" value="" maxlength="100" required> </td> <td> <input class="h5-number" type="text" name="item_description[]" value="" maxlength="100" required> </td> <td> <select name="purchased_shop[]" required>' + purchaseShop + '</select> </td> <td> <input class="soldcollected" type="text" name="sold_price[]" value="" maxlength="10" required> </td> <td> <input class="purchasecollected" type="text" name="purchase_price[]" value="" maxlength="10" required> </td> <td> <input class="deliverycostcollected" type="text" name="deliver_cost[]" value="" maxlength="10" required> </td> <td> <select name="deliver_pickup[]" required>' + deliverPickup + '</select> </td> <td> <input type="text" class="netcollected" name="net[]" value="" maxlength="10" readonly> </td> <td> <select name="payment_mode[]" required>' + paymentMode + '</select> </td> <td> <input class="cashreceivedcollected" type="text" name="cash_received[]" value="" maxlength="10" required> </td> <td> <select name="status[]" required> <option value="">Select Status</option> <option value="1">Verified</option> <option value="2">Unverified</option> </select> </td> </tr>');
        $(".dp-ex-1").datepicker("refresh");
    });

    //Remove Invoice Line
    $(document).on('click', 'a.removeItem', function () {
        var currentTable = $(this).closest('table').attr('id');
        $(this).closest('tr').remove();
        calculateTableSum(currentTable);

    });

    $("#InvoiceForm").submit(function (e)
    {
        var formObj = $(this);
        var formURL = formObj.attr("action");
        var formData = new FormData(this);
        $.ajax({
            url: formURL,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                window.location.href = "dashboard";
            }
        });
        e.preventDefault();
    });


});

// Add a New
$(function () {
    var x = 1;
    $('#AddAccount').click(function () {
        var purchaseShop = $(".purchaseShop").html();
        var deliverPickup = $(".deliverPickup").html();
        var paymentMode = $(".paymentMode").html();
        $('.addtable').append('<table id="addaccount' + x + '" class="subgrid" style="margin-bottom: 10px;"><thead><tr> <th class="essential"></th> <th>Date</th> <th>Order No</th> <th>Customer Name</th> <th>Item Description</th> <th>Purchased Shop</th> <th>Sold Price</th> <th>Purchased Price</th> <th>Deliver Cost</th> <th>Delivered / Pickup By</th> <th>Net</th> <th>Payment Mode</th> <th>Cash Received</th> <th>Status</th> </tr></thead><tbody><tr> <td> <a href="javascript:void(0);"  class="removeItem"><span style="margin: auto 10px;padding: 2px;font-size:12px;" class="glyphicon glyphicon-minus"></span></a> </td> <td> <input class="dp-ex-1" type="text" name="order_date[]" value="" maxlength="10" required> </td> <td> <input class="h5-number" type="text" name="order_no[]" value="" maxlength="15" required> </td> <td> <input type="text" name="customer_name[]" value="" maxlength="100" required> </td> <td> <input class="h5-number" type="text" name="item_description[]" value="" maxlength="100" required> </td> <td> <select name="purchased_shop[]" required>' + purchaseShop + '</select> </td> <td> <input class="soldcollected" type="text" name="sold_price[]" value="" maxlength="10" required> </td> <td> <input class="purchasecollected" type="text" name="purchase_price[]" value="" maxlength="10" required> </td> <td> <input class="deliverycostcollected" type="text" name="deliver_cost[]" value="" maxlength="10" required> </td> <td> <select name="deliver_pickup[]" required>' + deliverPickup + '</select> </td> <td> <input class="netcollected" type="text" name="net[]" value="" maxlength="10" readonly> </td> <td> <select name="payment_mode[]" required> ' + paymentMode + ' </select> </td> <td> <input class="cashreceivedcollected" type="text" name="cash_received[]" value="" maxlength="10" required> </td> <td> <select name="status[]" required> <option value="">Select Status</option> <option value="1">Verified</option> <option value="2">Unverified</option> </select> </td> </tr></tbody><tfoot><tr> <td colspan="6"><a title="Add More" class="AddRow" style="font-size:18px;" href="javascript:void(0);"><span style="margin: auto 10px;padding: 2px;font-size:12px;" class="glyphicon glyphicon-plus"></span></a></td> <td style="text-align: left"><input class="soldamt_total bg" name="sold_total[]" type="text" value="" readonly></td> <td style="text-align: left"><input class="purchasedamt_total bg" name="purchased_total[]" type="text" value="" readonly></td> <td style="text-align: left"><input class="delivercostamt_total bg" name="delivercost_total[]" type="text" value="" readonly></td> <td>&nbsp;</td> <td style="text-align: left"><input class="netamt_total bg" name="net_total[]" type="text" value="" readonly></td> <td>&nbsp;</td> <td style="text-align: left"><input class="cash_receivedamt_total bg" name="cash_received_total[]" type="text" value="" readonly></td> <td>&nbsp;</td> </tr><tr style="background-color: #fff;"> <td colspan="13" style="padding-left: 40px;">Total Sale</td> <td><input type="text" class="total_sale text-box-none" name="total_sale[]" placeholder="Total Sale" readonly></td> </tr><tr style="background-color: #fff;"> <td colspan="13" style="padding-left: 40px;">Daily Net Income</td> <td><input type="text" class="daily_net text-box-none" name="daily_net[]" placeholder="Daily Net Income" readonly></td> </tr><tr style="background-color: #fff;"> <td colspan="13" style="padding-left: 40px;">Opening Balance</td> <td><input type="text" class="opening_balance text-box-none" name="opening_balance[]" placeholder="Opening Balance"></td> </tr> <tr style="background-color: #fff;"> <td colspan="13" style="padding-left: 40px;">Cash on Hand</td> <td><input type="text" class="cash_on_hand text-box-none" name="cash_on_hand[]" placeholder="Cash on Hand" readonly></td> </tr><tr style="background-color: #fff;"> <td colspan="13" style="padding-left: 40px;">Money Deposited</td> <td><input type="text" class="money_deposited text-box-none" name="money_deposited[]" placeholder="Money Deposited"></td> </tr> <tr style="background-color: #fff;"> <td colspan="13" style="padding-left: 40px;">Closing Balance</td> <td><input type="text" class="closing_balance text-box-none" name="closing_balance[]" placeholder="Closing Balance" readonly></td> </tr></tfoot></table>');
        x++;
        $(".dp-ex-1").datepicker("refresh");
    });
});

// Sum Amt Collected	
function calculateSum() {

    var currentTable = $(this).closest('table').attr('id');
    calculateTableSum(currentTable);
}



function calculateTableSum(currentTable) {
    var soldamt = 0;
    $('#' + currentTable + ' input.soldcollected').each(function (i) {

        if (!isNaN(this.value) && this.value.length != 0) {
            soldamt += parseFloat(this.value);

            $('#' + currentTable + ' input.cashreceivedcollected:eq(' + i + ')').val(this.value);

            //Purchase Amount
            var purchasecollect = $('#' + currentTable + ' input.purchasecollected:eq(' + i + ')').val();
            purchasecollect = parseInt(purchasecollect) || 0;
            //Delivery Amount 
            var deliverycostcollect = $('#' + currentTable + ' input.deliverycostcollected:eq(' + i + ')').val();
            deliverycostcollect = parseInt(deliverycostcollect) || 0;
            //Total Net Amount
            var total_net = parseInt(this.value) - (parseInt(purchasecollect) + parseInt(deliverycostcollect));
            total_net = parseInt(total_net) || 0;
            $('#' + currentTable + ' input.netcollected:eq(' + i + ')').val(total_net.toFixed(2));

        }
    });

    var purchaseamt = 0;
    $('#' + currentTable + ' input.purchasecollected').each(function (i) {
        if (!isNaN(this.value) && this.value.length != 0) {
            purchaseamt += parseFloat(this.value);
            //Sold Amount
            var soldcollect = $('#' + currentTable + ' input.soldcollected:eq(' + i + ')').val();
            soldcollect = parseInt(soldcollect) || 0;
            //Delivery Amount 
            var deliverycostcollect = $('#' + currentTable + ' input.deliverycostcollected:eq(' + i + ')').val();
            deliverycostcollect = parseInt(deliverycostcollect) || 0;

            var total_net = parseInt(soldcollect) - (parseInt(this.value) + parseInt(deliverycostcollect));

            //Total Net Amount
            total_net = parseInt(total_net) || 0;
            $('#' + currentTable + ' input.netcollected:eq(' + i + ')').val(total_net.toFixed(2));
        }
    });

    var deliverycostamt = 0;
    $('#' + currentTable + ' input.deliverycostcollected').each(function (i) {
        if (!isNaN(this.value) && this.value.length != 0) {
            deliverycostamt += parseFloat(this.value);
            //Sold Amount
            var soldcollect = $('#' + currentTable + ' input.soldcollected:eq(' + i + ')').val();
            soldcollect = parseInt(soldcollect) || 0;
            //Purchase Amount
            var purchasecollect = $('#' + currentTable + ' input.purchasecollected:eq(' + i + ')').val();
            purchasecollect = parseInt(purchasecollect) || 0;
            //Total Net Amount
            var total_net = parseInt(soldcollect) - (parseInt(purchasecollect) + parseInt(this.value));
            total_net = parseInt(total_net) || 0;
            $('#' + currentTable + ' input.netcollected:eq(' + i + ')').val(total_net.toFixed(2));

        }
    });

    var netamt = 0;
    $('#' + currentTable + ' input.netcollected').each(function () {

        if (!isNaN(this.value) && this.value.length != 0) {
            netamt += parseFloat(this.value);
        }
    });

    var cashreceivedamt = 0;
    $('#' + currentTable + ' input.cashreceivedcollected').each(function () {
        if (!isNaN(this.value) && this.value.length != 0) {
            cashreceivedamt += parseFloat(this.value);
        }
    });

    $('#' + currentTable + ' input.soldamt_total').val(soldamt.toFixed(2));
    $('#' + currentTable + ' input.purchasedamt_total').val(purchaseamt.toFixed(2));
    $('#' + currentTable + ' input.delivercostamt_total').val(deliverycostamt.toFixed(2));
    $('#' + currentTable + ' input.netamt_total').val(netamt.toFixed(2));
    $('#' + currentTable + ' input.cash_receivedamt_total').val(cashreceivedamt.toFixed(2));

    $('#' + currentTable + ' input.total_sale').val(soldamt.toFixed(2));
    $('#' + currentTable + ' input.daily_net').val(netamt.toFixed(2));


    var purchased_total_amt = parseInt(purchaseamt.toFixed(2));
    var delivered_total_amt = parseInt(deliverycostamt.toFixed(2));
    var cashreceived_total_amt = parseInt(cashreceivedamt.toFixed(2));

    var cash_on_hand = 0;
    cash_on_hand = parseInt(cashreceived_total_amt - (purchased_total_amt + delivered_total_amt));
    $('#' + currentTable + ' input.cash_on_hand').val(cash_on_hand.toFixed(2));

    var opening_balance = 0;
    opening_balance = $('#' + currentTable + ' input.opening_balance').val();
    opening_balance = parseInt(opening_balance) || 0;

    var money_deposit = 0;
    money_deposit = $('#' + currentTable + ' input.money_deposited').val();
    money_deposit = parseInt(money_deposit) || 0;
    var closing_amt = 0;
    closing_amt = (parseInt(opening_balance) + parseInt(cash_on_hand)) - parseInt(money_deposit);
    closing_amt = parseInt(closing_amt) || 0;
    $('#' + currentTable + ' input.closing_balance').val(closing_amt.toFixed(2));


}


$(document).on('change keyup', 'input.soldcollected,input.purchasecollected,input.deliverycostcollected,input.netcollected,input.cashreceivedcollected,input.cashreceivedcollected,input.cash_on_hand,input.opening_balance,input.money_deposited', calculateSum);

//Add Invoice Functions End

$(function () {
    // Append Invoice Line

    $('.dp-ex-1').datepicker();
    $(document).on('click', '.AddExpenseRow', function () {
        var currentTable = $(this).closest('table').attr('id');
        var ExpenseType = $(".ExpenseType").html();
        $('#' + currentTable + ' tbody').append('<tr> <td> <a href="javascript:void(0);" class="removeExpenseItem"><span style="margin: auto 10px;padding: 2px;font-size:12px;" class="glyphicon glyphicon-minus"></span></a> </td> <td> <input class="dp-ex-1" type="text" name="expense_date[]" value="" maxlength="15" required> </td> <td><select name="expense_type[]" class="ExpenseType" required>' + ExpenseType + ' </select> </td> <td> <input type="text" name="expense_description[]" value="" maxlength="150" required> </td> <td> <input type="text" class="expensecollected" name="expense_amount[]" value="" maxlength="10" required> </td> <td> <select name="status[]"> <option value="">Select Status</option> <option value="1">Verified</option> <option value="2">Unverified</option> </select> </td> </tr>');
        $(".dp-ex-1").datepicker("refresh");
    });

    //Remove Invoice Line
    $(document).on('click', 'a.removeExpenseItem', function () {
        var currentTable = $(this).closest('table').attr('id');
        $(this).closest('tr').remove();
        calculateExpenseSum(currentTable);

    });


    $("#ExpenseForm").submit(function (e)
    {

        var formObj = $(this);
        var formURL = formObj.attr("action");
        var formData = new FormData(this);
        $.ajax({
            url: formURL,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                window.location.href = "dashboard";
            }
        });
        e.preventDefault();
    });

    $("#monthly_report").submit(function (e)
    {

        var formObj = $(this);
        var formURL = formObj.attr("action");
        var formData = new FormData(this);
        $.ajax({
            url: formURL,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                $("#ajaxReport").html(data);
            }
        });
        e.preventDefault();
    });

    $("#monthly_report_view").submit(function (e)
    {

        var formObj = $(this);
        var formURL = formObj.attr("action");
        var formData = new FormData(this);
        $.ajax({
            url: formURL,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                $("#ajaxReport").html(data);
                var currentTable = $("#reportinvoice").attr('id');
                calculateTableSum(currentTable);
            }
        });
        e.preventDefault();
    });

});

function calculateExpenseSum() {

    var currentTable = $(this).closest('table').attr('id');
    calculateExpenseAmount(currentTable);
}

function calculateExpenseAmount(currentTable) {
    var expenseamt = 0;
    $('#' + currentTable + ' input.expensecollected').each(function () {

        if (!isNaN(this.value) && this.value.length != 0) {
            expenseamt += parseFloat(this.value);
        }
    });

    $('#' + currentTable + ' input.expenseamount_total').val(expenseamt.toFixed(2));


}
$(document).on('change keyup', 'input.expensecollected', calculateExpenseSum);
