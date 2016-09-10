

<table class="tableizer-table">
    <thead>
        <tr class="tableizer-firstrow">
            <th colspan="5" style="text-align: center;"><?php echo $month_formats; ?></th>

        </tr>
    </thead>
    <tbody>

        <tr>
            <!--            Column1-->
            <td>
                <table>
                    <tr>
                        <td>Number of days worked</td><td>22</td>
                    </tr>
                    <tr>
                        <td>Total orders</td><td><?php echo $month_common_list['total_orders']; ?></td>
                    </tr>
                    <tr>
                        <td>Total of Cancelled Orders</td><td><?php echo $month_common_list['total_cancel_order']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Total Sale</strong></td><td><strong>AED <?php $total_sale = 0;
foreach ($month_paymentmodeList as $PList) {
    $total_sale+=$PList['total_cash'];
} echo number_format($total_sale, 2, ".", ""); ?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="2">Extra Expense</td>
                    </tr>
                    <?php
                    $total_expense_amount = 0;
                    foreach ($month_extra_expense_list as $expenses) {
                        $total_expense_amount+=$expenses['expense_amount'];
                        ?>
                        <tr>
                            <td><?php echo $expenses['name']; ?></td><td>AED <?php echo number_format($expenses['expense_amount'], 2, ".", ""); ?></td>
                        </tr>    
<?php } ?>
                    <tr>
                        <td>Total Extra Expense</td><td><strong>AED <?php echo number_format($total_expense_amount, 2, ".", ""); ?></strong></td>
                    </tr>
                    <tr>
                        <td>Total Purchasing costs</td><td><strong>AED <?php echo number_format($month_common_list['total_purchase'], 2, ".", ""); ?></strong></td>
                    </tr>
                    <tr>
                        <td>Totall Delivery Cost</td><td><strong>AED <?php echo number_format($month_common_list['total_deliver'], 2, ".", ""); ?></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Net Income</strong></td><td><strong>AED <?php echo $total_sale - ($total_expense_amount + $month_common_list['total_purchase'] + $month_common_list['total_deliver']); ?></strong></td>
                    </tr>
                </table>
            </td>

            <!--            Column2-->
            <td>
                <table>
                    <?php
                    $cash_on_hand = 0;
                    foreach ($month_paymentmodeList as $PList) {
                        if ($PList['id'] == "1") {
                            $cash_on_hand+=$PList['total_cash'];
                        }
                        ?>
                        <tr>
                            <td colspan="2">Payments for <?php echo $PList['name']; ?></td><td>AED <?php echo number_format($PList['total_cash'], 2, ".", ""); ?></td>
                        </tr>
                    <?php } ?>                      
                    <tr>
                        <td colspan="2">&nbsp;</td><td><strong>AED  <?php echo number_format($total_sale, 2, ".", ""); ?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <table>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Deliveries</td>
                                    <td>Standard</td>
                                    <td>Actual</td>
                                </tr>
                                <?php
                                $deliveries = 0;
                                $standard = 0;
                                foreach ($month_deliveredList as $DList) {
                                    $deliveries+= $DList['total_deliver'];
                                    $standard+=$DList['total_deliver'] * 25;
                                    ?>
                                    <tr>
                                        <td>Delivered by <?php echo $DList['name']; ?></td>
                                        <td><?php echo $DList['total_deliver']; ?></td>
                                        <td>AED <?php echo number_format($DList['total_deliver'] * 25, 2, ".", ""); ?></td>
                                        <td>AED 412.00</td>
                                    </tr>    
                                <?php } ?>


                                <tr>
                                    <td>Total Deliveries</td>
                                    <td><strong><?php echo $deliveries; ?></strong></td>
                                    <td><strong>AED <?php echo number_format($standard, 2, ".", ""); ?></strong></td>
                                    <td><strong>AED 412.00</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">Opening Balance</td><td><?php echo "AED 0.00"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Cash on Hand</td><td><?php echo "AED " . $cash_on_hand; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Money Deposited</td><td><?php echo "AED " . $total_expense_amount; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Closing Balance</strong></td><td><strong><?php echo "AED " . $total_expense_amount; ?></strong></td>
                    </tr>
                </table>
            </td>

        </tr>
    </tbody>
</table>