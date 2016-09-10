
<footer class="footer">

  <div class="container">

    <div class="row">

      <div class="col-sm-12">

        
        <hr>    

        <p>&copy; 2016 Waves Shopping.</p>

      </div> <!-- /.col -->

      

      

      

    </div> <!-- /.row -->

  </div> <!-- /.container -->
  
</footer>

<script src="<?php echo base_url(); ?>assets/admin/js/libs/jquery-1.10.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/libs/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/libs/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- App JS -->
<script src="<?php echo base_url(); ?>assets/admin/js/target-admin.js"></script>


<!-- Datatable Plugin -->

<script src="<?php echo base_url(); ?>assets/admin/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/datatables/DT_bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/tableCheckable/jquery.tableCheckable.js"></script>


<script src="<?php echo base_url(); ?>assets/lib/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/custom.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/demos/calculatetable.js"></script>

<script>
    $(function () {
        $("#monthdate").datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months"
        });
    });
    /*
     $(function () {
     $('#addMore').on('click', function () {
     var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
     data.find("input").val('');
     var table = document.getElementById('tb');
     var rowCount = table.rows.length;
     var row = table.insertRow(rowCount);
     row.id = 'row_'+rowCount;
     //var appendTxt = '<tr><td><input class="dp-ex-1" name="something" type="text" /></td></tr>';
     //$("tr:last").after(appendTxt);            
     //$(".dp-ex-1").datepicker("refresh");
     });
     $(document).on('click', '.remove', function () {
     var trIndex = $(this).closest("tr").index();
     if (trIndex > 1) {
     $(this).closest("tr").remove();
     } else {
     alert("Sorry!! Can't remove first row!");
     }
     });
     });
     
     function calculate(elementID) {
     var mainRow = document.getElementById(elementID);
     var myBox1 = mainRow.querySelectorAll('[name=sold_price]')[0].value;
     var myBox2 = mainRow.querySelectorAll('[name=purchased_price]')[0].value;
     var total = mainRow.querySelectorAll('[name=deliver_cost]')[0];
     var myResult1 = myBox1 * myBox2;
     total.value = myResult1;
     
     }*/
</script>

</body>
</html>
