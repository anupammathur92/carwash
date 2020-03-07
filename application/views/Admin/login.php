<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Car Wash</title>
        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <!-- bootstrap & fontawesome -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/font-awesome/4.5.0/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/fonts.googleapis.com.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/ace.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/ace-skins.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assests/css/ace-rtl.min.css" type="text/css" />
    </head>
    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center">
                                <h1>
                                    <i class="ace-icon fa fa-leaf green"></i>
                                    <span class="red"></span>
                                    <span class="white" id="id-text2">Car Wash</span>
                                </h1>
                                <h4 class="blue" id="id-company-text"></h4>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="ace-icon fa fa-coffee green"></i>
                                                Please Enter Your Information
                                            </h4>
                                            <div class="space-6"></div>
                                            <?php echo validation_errors(); ?>
                                            <?php
                                            if($this->session->flashdata("invalid_credential"))
                                            {
                                            		echo $this->session->flashdata("invalid_credential");
                                            }
                                            ?>
                                            <form action="<?php echo base_url(); ?>Admin/login" method="post" enctype="multipart/form-data">

                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" name="loginusername" class="form-control" value="<?php echo set_value('loginusername');?>" placeholder="Mobile No." autocomplete="off" />
                                                            <i class="ace-icon fa fa-user"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="loginpassword" class="form-control" placeholder="Password"  autocomplete="off"/>
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </label>

                                                    <div class="space"></div>

                                                    <div class="clearfix">
                                                        <!--<label class="inline">
                                                            <input type="checkbox" class="ace" />
                                                            <span class="lbl"> Remember Me</span>
                                                        </label>-->

                                                        <?php echo form_submit(array('id' => 'submit', 'value' => 'Login', 'class' => 'width-35 pull-right btn btn-sm btn-primary')); ?>


                                                        <!--<button type="button" class="width-35 pull-right btn btn-sm btn-primary">
                                                                <i class="ace-icon fa fa-key"></i>
                                                                <span class="bigger-110">Login</span>
                                                        </button>-->
                                                    </div>

                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>
                                        </div><!-- /.widget-main -->

                                        <!--<div class="toolbar clearfix">
                                            <div>
                                                <a href="#" data-target="#forgot-box" class="forgot-password-link">
                                                    <i class="ace-icon fa fa-arrow-left"></i>
                                                    I forgot my password
                                                </a>
                                            </div>

                                            <div>
                                                <a href="#" data-target="#signup-box" class="user-signup-link">
                                                    I want to register
                                                    <i class="ace-icon fa fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>-->
                                    </div><!-- /.widget-body -->
                                </div><!-- /.login-box -->

                                <div id="forgot-box" class="forgot-box widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header red lighter bigger">
                                                <i class="ace-icon fa fa-key"></i>
                                                Retrieve Password
                                            </h4>

                                            <div class="space-6"></div>
                                            <p>
                                                Enter your email and to receive instructions
                                            </p>

                                            <form>
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="email" class="form-control" placeholder="Email" />
                                                            <i class="ace-icon fa fa-envelope"></i>
                                                        </span>
                                                    </label>

                                                    <div class="clearfix">
                                                        <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                                            <i class="ace-icon fa fa-lightbulb-o"></i>
                                                            <span class="bigger-110">Send Me!</span>
                                                        </button>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div><!-- /.widget-main -->

                                        <div class="toolbar center">
                                            <a href="#" data-target="#login-box" class="back-to-login-link">
                                                Back to login
                                                <i class="ace-icon fa fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div><!-- /.widget-body -->
                                </div><!-- /.forgot-box -->

                                <div id="signup-box" class="signup-box widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header green lighter bigger">
                                                <i class="ace-icon fa fa-users blue"></i>
                                                New User Registration
                                            </h4>
                                            <div class="space-6"></div>
                                            <p> Enter your details to begin: </p>
                                            <form action="<?php echo base_url(); ?>Admin/registration" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <div class="radio">
                                                    <label>
                                                        <input name="admin" type="radio" class="ace" value="1" required=""/>
                                                         <span class="lbl"> Admin</span>
                                                    </label>
                                                         <label>
                                                             <input name="admin" type="radio" class="ace" value="2" required=""/>
                                                           <span class="lbl"> Site Master</span>
                                                         </label>
                                                     </div>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" name ="uname" class="form-control" placeholder="User Name" />
                                                            <i class="ace-icon fa fa-envelope"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="password" class="form-control" placeholder="Password" id="password" />
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="cpassword"class="form-control" placeholder="Confirm password" onChange="myFunction();" id ="cpassword"/>
                                                            <i class="ace-icon fa fa-retweet"></i>
                                                        </span>
                                                        <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
                                                    </label>

                                                    <div class="space-24"></div>
                                                    <div class="clearfix">
                                                        <?php echo form_submit(array('id' => 'submit', 'value' => 'Reset', 'class' => 'width-30 pull-left btn btn-sm')); ?>
                                                        <?php echo form_submit(array('id' => 'cancle', 'value' => 'Register', 'class' => 'width-65 pull-right btn btn-sm btn-success')); ?>   
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>

                                        <div class="toolbar center">
                                            <a href="#" data-target="#login-box" class="back-to-login-link">
                                                <i class="ace-icon fa fa-arrow-left"></i>
                                                Back to login
                                            </a>
                                        </div>
                                    </div><!-- /.widget-body -->
                                </div><!-- /.signup-box -->
                            </div><!-- /.position-relative -->


                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assests/js/jquery-2.1.4.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
        <script type="text/javascript">
            if ('ontouchstart' in document.documentElement)
                document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function ($) {
                $(document).on('click', '.toolbar a[data-target]', function (e) {
                    e.preventDefault();
                    var target = $(this).data('target');
                    $('.widget-box.visible').removeClass('visible');//hide others
                    $(target).addClass('visible');//show target
                });
            });

            //you don't need this, just used for changing background
            jQuery(function ($) {
                $('#btn-login-dark').on('click', function (e) {
                    $('body').attr('class', 'login-layout');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-light').on('click', function (e) {
                    $('body').attr('class', 'login-layout light-login');
                    $('#id-text2').attr('class', 'grey');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-blur').on('click', function (e) {
                    $('body').attr('class', 'login-layout blur-login');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'light-blue');
                    e.preventDefault();
                });

            });
        </script>
 <script>
   function myFunction() {
    var pass1 = document.getElementById("password").value;
    var pass2 = document.getElementById("cpassword").value;
    var ok = true;
    if (pass1 != pass2) {
        document.getElementById("password").style.borderColor = "#E34234";
        document.getElementById("pcassword").style.borderColor = "#E34234";
        ok = false;
    }
    else {
        alert("Passwords Match!!!");
    }
    return ok;
}

 </script>
    </body>
</html>
