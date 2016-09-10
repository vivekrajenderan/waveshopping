<!DOCTYPE html>
<html class="no-js"> 
    <head>
        <title>Waves Shopping</title>

        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css">

        <!-- App CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/target-admin.css">

    </head>

    <body class="account-bg">

        <hr class="account-header-divider">

        <div class="account-wrapper">


            <div class="account-body">

                <h5 class="account-body-subtitle">Please sign in to get access.</h5>



                <form class="form account-form" action="" method="post" autocomplete="off" id="login-form">
                    <?php
                    if ($msg != "") {
                        echo "<span class='error'>$msg</span>";
                    }
                    if ($this->session->flashdata('successmsg') != "") {
                        echo "<span style='color:#04770E;' class='success'>" . $this->session->flashdata('successmsg') . "</span>";
                    }
                    ?>
                    <div class="form-group elVal">

                        <input type="email" class="form-control" id="email" name="email" type="text" placeholder="Email" value="<?php echo set_value('email') ?>" >
                        <span class="text-error"><?php echo form_error('email'); ?></span>

                    </div>
                    <div class="form-group elVal">


                        <input type="password" class="form-control" id="password" name="password" type="password" placeholder="Password" value="<?php echo set_value('password') ?>">
                        <span class="text-error"><?php echo form_error('password'); ?></span>

                    </div>
                    <div class="form-group clearfix">
                        <div class="pull-left">         
                            <label class="checkbox-inline">
                                <input type="checkbox" class="" value="" tabindex="3">Remember me
                            </label>
                        </div>

                        <div class="pull-right">
                            <a href="<?php echo base_url() . 'login/register'; ?>">Sign Up</a>
                        </div>
                    </div> <!-- /.form-group -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg" tabindex="4">
                            Signin &nbsp; <i class="fa fa-play-circle"></i>
                        </button>
                    </div> <!-- /.form-group -->

                </form>


            </div> <!-- /.account-body -->

            <!-- <div class="account-footer">
              <p>
              Don't have an account? &nbsp;
              <a href="account-signup.html" class="">Create an Account!</a>
              </p>
            </div>--> <!-- /.account-footer -->

        </div> <!-- /.account-wrapper -->



        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/lib/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/lib/jquery.validate.js"></script>
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('.error').fadeOut();
                }, 4000);
                setTimeout(function () {
                    $('.success').fadeOut();
                }, 4000);
                $("#login-form").validate({
                    highlight: function (element) {
                        $(element).closest('.elVal').addClass("form-field text-error");
                    },
                    unhighlight: function (element) {
                        $(element).closest('.elVal').removeClass("form-field text-error");
                    }, errorElement: 'span',
                    rules: {
                        email: {
                            required: true,
                            email: true,
                            minlength: 4,
                            maxlength: 40,
                        },
                        password: {
                            required: true,
                            minlength: 4,
                            maxlength: 24,
                        }
                    },
                    messages: {
                        email: {
                            required: "Please enter your email"

                        },
                        password: {
                            required: "Please enter your password"

                        }
                    },
                    errorPlacement: function (error, element) {
                        error.appendTo(element.closest(".elVal"));
                    }
                });


                $.validator.addMethod("Alphaspace", function (value, element) {
                    return this.optional(element) || /^[a-z ]+$/i.test(value);
                }, "Username must contain only letters, numbers, or dashes.");

                $.validator.addMethod("Alphanumeric", function (value, element) {
                    return this.optional(element) || /^[a-z0-9]+$/i.test(value);
                }, "Username must contain only letters, numbers, or dashes.");

                $.validator.addMethod("nowhitespace", function (value, element) {
                    return this.optional(element) || /^\S+$/i.test(value);
                }, "Space are not allowed");

            });
        </script>


    </body>
</html>
