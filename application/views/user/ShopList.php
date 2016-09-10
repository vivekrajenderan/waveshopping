<div class="container">

    <div class="content">

        <div class="content-container">

            <div class="row">

                <div class="col-md-12">

                    <div class="portlet">

                        <div class="portlet-header">

                            <h3>
                                <i class="fa fa-table"></i>
                                Purchase Shop List
                            </h3>
                            <a href="<?php echo base_url() . 'users/add_purchase_shop'; ?>" class="btn btn-info" style="float:right;">Add Purchase Shop</a>
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

                                            <th data-filterable="true" data-sortable="true" >Name</th>

                                            <th data-filterable="true" data-sortable="true">Email</th>
                                            <th data-filterable="true" data-sortable="true">Status</th>
                                            <th data-filterable="false" class="hidden-xs hidden-sm">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if (count($PurchaseShopList) > 0) {
                                            foreach ($PurchaseShopList as $key => $list) {
                                                ?>
                                                <tr>
                                                    <td class="checkbox-column">
                                                        <input type="checkbox" class="icheck-input">
                                                    </td>                     
                                                    <td><?php echo $list['name']; ?></td>

                                                    <td><?php echo $list['email']; ?></td>
                                                    <td><?php if ($list['status'] == "1") {
                                            echo "Active";
                                        } else {
                                            echo "Inactive";
                                        } ?></td>                                                       
                                                    <td class="text-center">
                                                        <a href="<?php echo base_url(); ?>users/edit_purchase_shop/<?php echo md5($list['id']); ?>">
                                                            <button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                                        &nbsp;
                                                        <a href="<?php echo base_url(); ?>users/delete_PurchaseShop/<?php echo md5($list['id']); ?>"><button class="btn btn-xs btn-secondary"><i class="fa fa-times"></i></button></a>
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

