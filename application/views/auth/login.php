<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE 2 | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/square/blue.css') ?>" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a style="font-size: 12pt"><b>Admin</b>Panel</a>
                <p >Laundryan</p>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php echo form_open("auth/login");?>
                    <div class="form-group has-feedback">
                        <?php echo lang('login_identity_label', 'identity');?>
                        <?php echo form_input(array_merge($identity, ['class' => 'form-control', 'placeholder' => 'Email']));?>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <?php echo lang('login_password_label', 'password');?>
                        <?php echo form_input(array_merge($password, ['class' => 'form-control', 'placeholder' => 'Password']));?>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">    
                            <div class="checkbox icheck">
                                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                                <label>
                                        Remember me
                                </label>
                            </div>                        
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary btn-block btn-flat"');?>
                        </div><!-- /.col -->
                    </div>
                    <p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
                <?php echo form_close();?>

                
            </div><!-- /.login-box-body -->

            <?php if ($message != '') :?>
            <div class="alert alert-danger" role="alert" style="margin-top: 10px">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <br>
              <span class="sr-only">Error:</span>
              <?= $message ?>
            </div>
            <?php endif;?>
        </div><!-- /.login-box -->

        

        <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>