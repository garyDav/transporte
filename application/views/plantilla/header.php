<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transporte</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/select2.min.css')?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/cssjs/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/cssjs/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/skin-blue.min.css">

    <!-- fullCalendar 2.2.5-->
    <link  href="<?php echo base_url() ?>assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" >
    <link  href="<?php echo base_url() ?>assets/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" media="print">



    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/cssjs/css/table_design.css">

    <!--[if lt IE 9]>
    <script src="<?php echo base_url() ?>assets/cssjs/js/html5shiv.min.js"></script>
    <script src="<?php echo base_url() ?>assets/cssjs/js/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="<?php echo base_url() ?>assets/plugins/jQueryUI/moment.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jQueryUI/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>
    <!-- fullCalendar cambio de idioma -->
    <script src="<?php echo base_url() ?>assets/plugins/fullcalendar/lang/es.js"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/plugins/select2/select2.full.min.js')?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>assets/dist/js/app.min.js"></script>

    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>

    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap-multiselect.css')?>" rel="stylesheet"/>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap-multiselect.js')?>"></script>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/cssjs/css/letras.css">

    <link href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker-bs3.css')?>" rel="stylesheet"/>
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
    <!-- iCheck 1.0.1 -->
    
    <script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>



    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>


    <style>
        #response{display: none}
    </style>
        <style>
        #response{display: none}
        .skin-blue .main-header .navbar {
            background-color: #f99627;
        }

        .skin-blue .main-header .logo:hover {
        background-color: #f99627;
        }

        .skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
        color: #fff;
        background: #1e282c;
        border-left-color: #f99627;}

        .skin-blue .main-header .logo {
        background-color: #f99627;
        color: #fff;
        border-bottom: 0 solid transparent;
        }

        .skin-blue .main-header .navbar .sidebar-toggle:hover {
        background-color: #f99627;
        }  

        .skin-blue .main-header li.user-header {
        background-color: #f99627;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>T</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>TRANSPORTE</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <?php if( isset($_SESSION['id_persona'])  ) { ?>
                                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url().'assets/uploads/img/'.$_SESSION['foto']?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $_SESSION['nombre_completo'] ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="<?php echo base_url().'assets/uploads/img/'.$_SESSION['foto']?>" class="img-circle" alt="User Image">
                                    <p>
                                        <?php echo $_SESSION['nombre_completo'] ?>
                                        <small><?php echo date('Y-m-d') ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->

                                <!-- Menu Footer-->
                                <li class="user-footer">

                                    <div class="pull-right">
                                        <a href="<?php echo base_url() ?>Autenticacion/logout" class="btn btn-danger btn-flat">Salir</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->

    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel .'/assets/uploads/img/'.$datos[$i]->foto-->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo base_url().'assets/uploads/img/'.$_SESSION['foto']?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $_SESSION['nick'] ?></p>
                    <a href=""><i class="fa fa-circle text-success"></i> En linea</a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
<?php if( $_SESSION['id_cargo'] ==1 ) { ?>
                <li class="treeview">
                    <a href="#"><i class="fa fa-search text-yellow"></i> <span>Busqueda</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>Busqueda/buscar"><i class='fa fa-circle-o'></i>Buscar Reserva</a></li>

                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-users text-yellow"></i> <span>Registro</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>Registro/persona"><i class='fa fa-circle-o'></i>Persona</a></li>
                        <li><a href="<?php echo base_url() ?>Registro/cargo"><i class='fa fa-circle-o'></i>Cargo</a></li>

                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-fighter-jet text-yellow"></i> <span>Traslado</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>Traslado/trasladar"><i class='fa fa-circle-o'></i>Trasladar</a></li>
                        <li><a href="<?php echo base_url() ?>Traslado/lista_traslado"><i class='fa fa-circle-o'></i>Pago traslado</a></li>

                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-desktop text-yellow"></i> <span>Reserva</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>Reserva/index"><i class='fa fa-circle-o'></i>Reservas</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-hand-o-right text-yellow"></i> <span>Asignación usuario</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>Registro/asignacion"><i class='fa fa-circle-o'></i>Asignar</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-institution text-yellow"></i> <span>Empresas</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>Registro/empresa"><i class='fa fa-circle-o'></i>Empresa</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-truck text-yellow"></i> <span>Maquinarias</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>Maquinaria/maquina"><i class='fa fa-circle-o'></i>Maquinaria</a></li>
                        <li><a href="<?php echo base_url() ?>Maquinaria/movilizacion"><i class='fa fa-circle-o'></i>Tipo movilizacion</a></li>
                    </ul>
                </li>
<?php } ?>

<?php if( $_SESSION['id_cargo'] ==2 ) { ?>
                <li class="treeview">
                    <a href="#"><i class="fa fa-search text-yellow"></i> <span>Busqueda</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>Busqueda/buscar"><i class='fa fa-circle-o'></i>Buscar Reserva</a></li>

                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-desktop text-yellow"></i> <span>Reserva</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>Reserva/index"><i class='fa fa-circle-o'></i>Reservas</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-fighter-jet text-yellow"></i> <span>Traslado</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>Traslado/lista_traslado"><i class='fa fa-circle-o'></i>Pago traslado</a></li>
                    </ul>
                </li>

<?php } ?>
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>


