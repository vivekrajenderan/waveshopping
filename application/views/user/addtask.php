
<div class="container">

  <div class="content">

    <div class="content-container">

      

      <div class="content-header">
        <h2 class="content-header-title">Add Task</h2>
        <ol class="breadcrumb">   
          <li class="active"><a href="<?php echo base_url();?>user/tasklist">Task List</a></li>
          <li>Add Task</li>
        </ol>
      </div> <!-- /.content-header -->

      

      <div class="row">

        <div class="col-sm-6">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-tasks"></i>
                Addtask Fields
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">
            	<div class="alert alert-success" id="successtask">
		        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
		        You successfully Addtask.
		      	</div>
		      	<div class="alert alert-danger" id="errortask" style="diplay:none;">
		        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
		        You aren't successfully Addtask.
		      	</div>

              <form id="addtaskform" name="addtaskform" action="" class="form" method="post" autocomplete="off">
				
                 <div class="form-group elVal">
                  <label for="name">Title</label>
                  <input type="text" id="title" name="title" class="form-control" data-required="true"  >
                 </div>
                 <div class="form-group  elVal">
                  <label for="name">Description</label>
                  <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                  </div>
                 <div class="form-group elVal">
                   <label for="select-input">Prority</label>
                  <select name="priority" id="priority" class="form-control">
                  <option value="">Select Status</option>
                  <option value="low">Low</option>
                  <option value="medium">Medium</option>
                  <option value="high">High</option>
                  </select>
                  
                 </div>
                 <div class="form-group elVal">
                   <label for="select-input">Status</label>
                  <select name="status" id="status" class="form-control">
                  <option value="">Select Status</option>
                  <?php 
                  
                  foreach ($statusList as $key=>$List)
                  {
                     echo "<option value='".$List['id']."'>".$List['status_name']."</option>";
                  }
                  
                  ?>
                  </select>
                  
                 </div>
                 
                 
                 <div class="form-group elVal">
                   <label for="select-input">Assign to</label>
                  <select name="user_id" id="user_id" class="form-control">
                  <option value="">Select User</option>
                  <?php 
                  foreach ($totalUserlist as $key=>$List)
                  {
                  	 echo "<option value='".$List['id']."'>".$List['name']."</option>";
               	  }
                  
                  ?>
                  </select>
                  
                 </div>
                                  
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>

              </form>

            </div> <!-- /.portlet-content -->

          </div> <!-- /.portlet -->

        </div> <!-- /.col -->


      </div> <!-- /.row -->


        

    </div> <!-- /.content-container -->
      
  </div> <!-- /.content -->

</div> <!-- /.container -->


        
  