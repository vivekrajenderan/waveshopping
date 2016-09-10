
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
    #monthly_report_view input
    {
        border:none;
        box-shadow: none;
        outline-color: #fff;
        outline: none;
    }

</style>
<div class="container" style="background-color:#fff;">
    <div class="content-container">
        <div class="content-header">
        
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url()."dashboard";?>">Home</a></li>          
          <li class="active">Monthly Reports View Page</li>
        </ol>
      </div>
<div class="row">

    <div class="col-sm-4 col-sm-offset-4">

        <div class="portlet">

            <div class="portlet-header">

                <h3>
                    <i class="fa fa-tasks"></i>
                    Monthly Report View
                </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">

                <form class="form parsley-form" action="<?php echo base_url() . 'dashboard/ajaxMonthlyReportView'; ?>" id="monthly_report_view" method="post">

                    <div class="form-group">
                        <label for="name">Choose Date</label>
                        <input type="text" data-date-autoclose="true" data-date-format="mm-yyyy" name="monthdate" id="monthdate" placeholder="Start date" class="form-control" style="border: 1px solid #ccc;">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>

                </form>

            </div> <!-- /.portlet-content -->

        </div> <!-- /.portlet -->

    </div> <!-- /.col -->


</div>

<div id="ajaxReport">

</div>
        
    </div>
</div>