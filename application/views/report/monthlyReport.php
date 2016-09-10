<style>
    .tableizer-table {
        border-collapse: collapse;
        margin: auto;
        width: 90%;
        background-color: #fff;
    }
    .tableizer-table thead{
        background-color: #000;
        color: #fff;
    }
    table
    {
        width:100%;
    }
    .tableizer-table td, th {
        border: 1px solid #ccc;
    }
</style>
<div class="container" style="background-color:#fff;">
    <div class="content-container">
        <div class="content-header">
        
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url()."dashboard";?>">Home</a></li>          
          <li class="active">Monthly Report Page</li>
        </ol>
      </div>
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4">

                <div class="portlet">

                    <div class="portlet-header">

                        <h3>
                            <i class="fa fa-tasks"></i>
                            Monthly Report
                        </h3>

                    </div> <!-- /.portlet-header -->

                    <div class="portlet-content">

                        <form class="form parsley-form" action="<?php echo base_url() . 'dashboard/ajaxMonthlyReport'; ?>" id="monthly_report" method="post">

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

        <div id="ajaxReport" style="margin-bottom: 30px;">

        </div>
    </div>

</div>