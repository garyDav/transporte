<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transporte</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/cssjs/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/cssjs/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url() ?>assets/cssjs/js/html5shiv.min.js"></script>
    <script src="<?php echo base_url() ?>assets/cssjs/js/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>

    <style>
        #response{display: none}
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box-msg">
        <h1 id="titulo"><b>SISTEMA DE MOVILIZACION Y DESMOVILIZACION DE EQUIPOS Y MAQUINARIAS</b></h1>

    </div><!-- /.login-logo -->
<div class="login-box">
<br>
<br>
<br>
<br>

    <div class="login-box-body">
        <p class="login-box-msg">Introduzca Usuario y Contraseña</p>
        <form id="frm_login" class="form-horizontal" action="<?php echo base_url() ?>Autenticacion/login" method="POST">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required="required">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required="required">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-warning btn-block btn-flat">Entrar</button>
                </div><!-- /.col -->
            </div>
        </form>
    </div><!-- /.login-box-body -->
    <div class="col-sm-8 col-sm-offset-3">
        <p class="alert alert-danger" id="response"><b>ERROR: USUARIO O CLAVE</b></p>
        
    </div>
</div><!-- /.login-box -->
<script>
    $(document).ready(function (){
        $("#frm_login").submit(function (e){

            e.preventDefault();
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            var data = $(this).serialize();
            $.ajax({
                url:url,
                type:method,
                data:data
            }).done(function(data){
                if(data !=='')
                {
                    var $alerta=$("#response").show('fast');
                    $('#frm_login')[0].reset();
                    $alerta.fadeOut(2000);

                    /*Otra opcion es la de concatenacion sin definir variable $alerta
                     una ves seleccionado el ID:
                     $("#response").show('fast').fadeOut(2000);
                     */
                }
                else
                {
                    window.location.href='<?php echo base_url() ?>Autenticacion/inicio';
                    throw new Error('go');
                }
            });
        });


    });
</script>
</body>
</html>

<style>

    #imagen{
        width:80%;
        
    }
    #titulo{
        color:#fff;
    }
    .login-page, .register-page {
    background-image: url("<?php echo base_url() ?>assets/images/loguin.png");
    }

</style>