
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
    
    #ExpenseForm input
    {
        border:none;
        box-shadow: none;
        outline-color: #fff;
        outline: none;
    }

    select {
    border: medium none;
    box-shadow: none;
    outline: medium none;
    width: 200px;
}
</style>
<div class="container" style="background-color:#fff;">
    <div class="content-container">
        <div>
            <h4 class="heading-inline">Daily Transaction
                &nbsp;&nbsp;<small>Add an Expenses</small>
                &nbsp;&nbsp;</h4>

        </div>
<div class="content-header">
        
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url()."dashboard";?>">Home</a></li>          
          <li class="active">Expense Page</li>
        </ol>
      </div>
<form method="post" action="<?php echo base_url() . 'dashboard/ajaxAddExpense'; ?>" id="ExpenseForm">
    <table id="addExpense" class="" style="margin-bottom: 10px;">
        <thead>
            <tr>
                <th class="essential"></th>
                <th>Date</th>
                <th>Expense Type</th> 
                <th>Expense Description</th>                
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <a href='javascript:void(0);'  class='removeExpenseItem'><span style="margin: auto 10px;padding: 2px;font-size: 12px;" class='glyphicon glyphicon-minus'></span></a>                    
                </td>
                <td>
                    <input class="dp-ex-1" type="text" name="expense_date[]" value="" maxlength="15" required>
                </td>
                <td>
                    <select name="expense_type[]" class="ExpenseType" required>
                        <option value="">Select Expense Type</option>
                        <?php
                        foreach ($expense_type_list as $details) {
                            echo "<option value='" . $details['id'] . "'>" . $details['name'] . "</option>";
                        }
                        ?>
                    </select> 
                    
                </td>
                <td>
                    <input type="text" name="expense_description[]" value="" maxlength="150" required>
                </td> 
                <td>
                    <input type="text" class="expensecollected" name="expense_amount[]" value="" maxlength="10" required>
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
                <td colspan="4"><a title="Add More" class="AddExpenseRow" style="font-size:12px;" href="javascript:void(0);"><span style="margin: auto 10px;padding: 2px;" class="glyphicon glyphicon-plus"></span></a></td>

                <td style="text-align: left"><input class="expenseamount_total bg" name="expense_amount_total[]" type="text" value="" readonly></td>
                <td style="text-align: left"><input  name="" type="text" value=""></td>
                
               
            </tr>

        </tfoot>
    </table>
    
    <br /> 
    <div style="margin: 50px auto;text-align: center;">
        <input name="submit" type="submit" value="Submit" class="btn btn-primary"/>
        <input name="cancel" type="submit" value="Cancel" class="btn btn-default"/>
    </div>

</form>
    </div>
</div>