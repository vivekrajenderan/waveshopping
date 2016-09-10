
<div class="container" style="margin: 50px auto;">

    <div class="content">

        <div class="content-container">

            <div class="row">

                <div class="col-md-6">

                    <div class="portlet">
                        <div class="portlet-header">

                            <h3>
                                <i class="fa fa-tasks"></i>
                                <?php echo $Title; ?> Delivered / Pickup By
                            </h3>

                        </div>

                        <div class="portlet-content">           


                            <?php
                            if ($msg != "") {
                                echo "<span style='color:#A53903'>" . $msg . "</span>";
                            }
                            ?>
                            <form class="form parsley-form" action="" method="post" autocomplete="off" id="gallery-form">

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" data-required="true" value="<?php echo $post_set['name']; ?>" >
                                </div>                                   
                                <div class="form-group elVal">
                                    <label for="name">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" data-required="true" value="<?php echo $post_set['email']; ?>">
                                </div>
                                <div class="form-group elVal">
                                    <label for="name">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="">Select Status</option>
                                        <option value="1" <?php if ($post_set['status'] == "1") {
                                echo "selected";
                            } ?>>Active</option>
                                        <option value="2" <?php if ($post_set['status'] == "2") {
                                echo "selected";
                            } ?>>Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg" tabindex="4">
                                        Submit 
                                    </button>
                                </div> <!-- /.form-group -->

                            </form>



                        </div> <!-- /.portlet-content -->

                    </div> <!-- /.portlet -->



                </div> <!-- /.col -->

            </div> <!-- /.row -->

        </div> <!-- /.col -->

    </div> <!-- /.row -->


</div> <!-- /.content-container -->

