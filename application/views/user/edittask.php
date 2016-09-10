
<div class="container">

  <div class="content">

    <div class="content-container">

      

      <div class="content-header">
        <h2 class="content-header-title">Edit Task</h2>
        <ol class="breadcrumb">   
        <li class="active"><a href="<?php echo base_url();?>user/tasklist">Task List</a></li>
          <li>Edit Task</li>
        </ol>
      </div> <!-- /.content-header -->

      

      <div class="row">

        <div class="col-sm-6">

          <div class="portlet">

            <div class="portlet-header">

              <h3>
                <i class="fa fa-tasks"></i>
                Edittask Fields
              </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">
            	<div class="alert alert-success" id="successtaskedit">
		        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
		        You successfully Updated.
		      	</div>
		      	<div class="alert alert-danger" id="errortaskedit" style="diplay:none;">
		        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
		        You aren't successfully Updated.
		      	</div>

              <form id="edittaskform" name="edittaskform" action="" class="form" method="post" autocomplete="off">
				         <input type="hidden" name="task_id" id="task_id" value="<?php echo $taskList[0]['id'];?>">
                 <div class="form-group elVal">
                  <label for="name">Title</label>
                  <input type="text" id="title" name="title" class="form-control" data-required="true" value="<?php echo $taskList[0]['title'];?>">
                 </div>
                 <div class="form-group  elVal">
                  <label for="name">Description</label>
                  <textarea id="description" name="description" class="form-control" rows="3"><?php echo $taskList[0]['description'];?></textarea>
                  </div>

                  <div class="form-group elVal">
                   <label for="select-input">Prority</label>
                  <select name="priority" id="priority" class="form-control">
                  <option value="">Select Status</option>
                  <option value="low" <?php if($taskList[0]['priority']=="low"){ echo "selected";}?>>Low</option>
                  <option value="medium" <?php if($taskList[0]['priority']=="medium"){ echo "selected";}?>>Medium</option>
                  <option value="high" <?php if($taskList[0]['priority']=="high"){ echo "selected";}?>>High</option>
                  </select>
                  
                 </div>
                 
                 <div class="form-group elVal">
                   <label for="select-input">Status</label>
                  <select name="status" id="status" class="form-control">
                  <option value="">Select Status</option>
                  <?php 
                  
                  foreach ($statusList as $key=>$List)
                  { ?>
                     <option value="<?php echo $List['id'];?>" <?php if($List['id']==$taskList[0]['status_id']){ echo "selected";}?> ><?php echo $List['status_name'];?></option>
                  <?php }
                  
                  ?>
                  </select>
                  
                 </div>
                 
                 
                 <div class="form-group elVal">
                   <label for="select-input">Assign to</label>
                  <select name="user_id" id="user_id" class="form-control">
                  <option value="">Select User</option>
                  <?php 
                  foreach ($totalUserlist as $key=>$List)
                  { ?>
                     <option value="<?php echo $List['id'];?>" <?php if($List['id']==$taskList[0]['assign_to']){ echo "selected";}?> ><?php echo $List['name'];?></option>
                  <?php }
                  
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


        
  