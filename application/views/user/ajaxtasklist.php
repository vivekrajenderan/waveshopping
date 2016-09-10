
              <table 
                class="table table-striped table-bordered table-hover table-highlight table-checkable media-table"  
                data-provide="datatable" 
                data-display-rows="10"
                data-info="true"
                data-search="true"
                data-length-change="true"
                data-paginate="true"
               id="datatables" >
                  <thead>
                    <tr>
                      <th class="checkbox-column">
                        <input type="checkbox" class="icheck-input">
                      </th>
                      
                      <th data-filterable="true" data-sortable="true" data-direction="asc">Title</th>
                       <th data-filterable="true" data-sortable="false">Description</th>
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
                      <td><?php echo $list['description'];?></td>
                      <td><?php echo $list['priority'];?></td>
                      <td><?php echo $list['status_name'];?></td>
                      <td><?php echo $list['assign_name'];?></td>
                      <td><?php echo $list['created_name'];?></td>                                                       
                      <td class="text-center">
                      <a href="<?php echo base_url();?>user/addtask/edit?id=<?php echo $list['id'];?>">
	                  <button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
	                  &nbsp;
	                  <a href="<?php echo base_url();?>user/addtask/edit?id=<?php echo $list['id'];?>"><button class="btn btn-xs btn-secondary"><i class="fa fa-times"></i></button></a>
	                  </td>
                     
                    </tr>
                    <?php 
                  	}
                  }                  	
                  ?>
                    
                   
                  </tbody>
                </table>
              <!-- Datatable Plugin -->
   
 