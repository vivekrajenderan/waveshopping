<div class="container">

  <div class="content">

    <div class="content-container">

      

      <div class="content-header">
        <h2 class="content-header-title">Tables Advanced</h2>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
          <li><a href="javascript:;">Users Elements</a></li>
          <li class="active">Users List</li>
        </ol>
      </div> <!-- /.content-header -->

      

      <div class="row">

        <div class="col-md-12">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-table"></i>
                User List
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">           

              <div class="table-responsive">

              <table 
                class="table table-striped table-bordered table-hover table-highlight table-checkable" 
                data-provide="datatable" 
                data-display-rows="10"
                data-info="true"
                data-search="true"
                data-length-change="true"
                data-paginate="true"
              >
                  <thead>
                    <tr>
                      <th class="checkbox-column">
                        <input type="checkbox" class="icheck-input">
                      </th>
                      <th data-filterable="true" data-sortable="true" data-direction="asc">Name</th>
                      <th data-filterable="true" data-sortable="true">Username</th>                     
                      <th data-filterable="true" data-sortable="true">Email</th>
                      <th data-filterable="true" class="hidden-xs hidden-sm">Phone</th>
                      <th data-filterable="true" class="hidden-xs hidden-sm">Gender</th>
                      <th data-filterable="false" class="hidden-xs hidden-sm">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  <?php 
                  if(count($totalUserlist)>0)
                  {
                  	foreach ($totalUserlist as $key=>$users)
                  	{
                  
                  ?>
                    <tr>
                      <td class="checkbox-column">
                        <input type="checkbox" class="icheck-input">
                      </td>
                      <td><?php echo $users['name'];?></td>
                      <td><?php echo $users['username'];?></td>
                      <td><?php echo $users['email'];?></td>
                      <td class="hidden-xs hidden-sm"><?php echo $users['phoneno'];?></td>
                      <td class="hidden-xs hidden-sm"><?php echo $users['gender'];?></td>
                      <td class="text-center">
	                  <button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button>
	                  &nbsp;
	                  <button class="btn btn-xs btn-secondary"><i class="fa fa-times"></i></button>
	                  </td>
                     
                    </tr>
                    <?php 
                  	}
                  }                  	
                  ?>
                    
                   
                  </tbody>
                </table>
              </div> <!-- /.table-responsive -->
              

            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->

        

        </div> <!-- /.col -->

      </div> <!-- /.row -->


        

    </div> <!-- /.content-container -->
      
  </div> <!-- /.content -->

</div> <!-- /.container -->