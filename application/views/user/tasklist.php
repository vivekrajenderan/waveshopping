<div class="container">

  <div class="content">

    <div class="content-container">

      

      <div class="content-header">
        <h2 class="content-header-title">Tables Advanced</h2>
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>         
          <li class="active">Task List</li>
        </ol>
      </div> <!-- /.content-header -->

              <?php if($ErrorMessage!='' ){ ?>
               <div class="alert alert-danger">
              <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
              <strong><?php echo $ErrorMessage;?></strong>
            </div> <!-- /.alert -->
              <? }?>
              <form name="tasklist" id="tasklist" method="post">
              <div style="margin:0px auto;width:20%;">
                <div class="form-group">
                   <label for="select-input">Status</label>
                  <select name="status" id="status" class="form-control">
                  <option value="">Select Status</option>
                 <?php 
                  
                  foreach ($statusList as $key=>$List)
                  { ?>
                     <option value="<?php echo $List['id'];?>" <?php if($List['id']==$post_set['status']){ echo "selected";}?> ><?php echo $List['status_name'];?></option>
                  <?php 
                  }
                  ?>                 
                  </select>
                  
                 </div>
                 <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                 </div>

                 </form>
      <div class="row">

        <div class="col-md-12">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-table"></i>
                Task List
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">           
                
              <div class="table-responsive">

              <table 
                class="table table-striped table-bordered table-hover table-highlight table-checkable media-table"  
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
                      
                      <th data-filterable="true" data-sortable="true" data-direction="asc">Title</th>
                       
                       <th data-filterable="true" data-sortable="false">Priority</th>
                      <th data-filterable="true" data-sortable="true">Status</th>
                      <th data-filterable="true" class="hidden-xs hidden-sm">Assign to</th>
                      <th data-filterable="true" class="hidden-xs hidden-sm">Created By</th>
                      <th data-filterable="false" class="hidden-xs hidden-sm">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  <?php 
                  if(count($taskList)>0)
                  {
                  	foreach ($taskList as $key=>$list)
                  	{
                  
                  ?>
                    <tr>
                      <td class="checkbox-column">
                        <input type="checkbox" class="icheck-input">
                      </td>                     
                      <td><?php echo $list['title'];?></td>
                      
                      <td><?php echo $list['priority'];?></td>
                      <td><?php echo $list['status_name'];?></td>
                      <td><?php echo $list['assign_name'];?></td>
                      <td><?php echo $list['created_name'];?></td>                                                       
                      <td class="text-center">
                      <a href="<?php echo base_url();?>user/addtask/edit?id=<?php echo $list['id'];?>">
	                  <button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
	                  &nbsp;
	                  <a href="<?php echo base_url();?>user/addtask/delete?id=<?php echo $list['id'];?>"><button class="btn btn-xs btn-secondary"><i class="fa fa-times"></i></button></a>
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