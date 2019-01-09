<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Modernizaciones</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--   ICONO PAGINA    -->
        <link rel="icon" href="http://cellaron.com/media/wysiwyg/zte-mwc-2015-8-l-124x124.png">
        <!--   BOOTSTRAP    -->
        <link href="<?= URL::to('assets/css/bootstrap.css'); ?>" rel="stylesheet" />
        <script type="text/javascript" src="<?= URL::to('assets/plugins/jQuery/jquery-3.1.1.js'); ?>"></script>
        <script type="text/javascript" src="<?= URL::to('assets/plugins/bootstrap.js'); ?>"></script>
        <!-- bottstrap select -->
        <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" /> -->
        <!-- modal stilo -->
        <link rel="stylesheet" href="<?= URL::to('assets/css/emergente.min.css'); ?>">
        <!-- datatables-->
        <link href="<?= URL::to('assets/plugins/datatables/dataTables.bootstrap.css'); ?>" rel="stylesheet">
        <link href="<?= URL::to('assets/plugins/datatables/dataTables.bootstrap2.css'); ?>" rel="stylesheet">
        <link href="<?= URL::to('assets/css/bootstrap.min.css" rel="stylesheet'); ?>">
        <!--   HEADER CSS    -->
        <link href="<?= URL::to('assets/css/styleHeader.css?v=1.0'); ?>" rel="stylesheet" />
        <!-- boton -->
        <link href="<?= URL::to('assets/css/styleBoton.css'); ?>" rel="stylesheet" />
        <!-- menu sticky -->
        <link href="<?= URL::to('assets/css/styleMenuSticky.css'); ?>" rel="stylesheet" />
        <link href="<?= URL::to('assets/css/styleModalCami.css'); ?>" rel="stylesheet" />
        <!-- checkbox -->
        <link href="<?= URL::to('assets/css/checkboxStyle.css'); ?>" rel="stylesheet" />
        <!--   SWEET ALERT    -->
        <link rel="stylesheet" href="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/css/table_christian.css'); ?>">
        <script type="text/javascript" src="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.min.js'); ?>"></script>
        <!-- <script type="text/javascript" src="<?= URL::to('assets/js/showMessage.js'); ?>"></script> -->
    </head>
    <body data-url="<?= URL::base(); ?>">
        <input type="hidden" id="session_id" value="<?= $_SESSION["id"] ?>"/>
        <input type="hidden" id="session_role" value="<?= $_SESSION["role"] ?>"/>
        <!-- Navigation -->
        <header>
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="logo"><img id="logo" src="<?= URL::to('assets/img/logo2.png'); ?>" /></a>
                    </div>
                    <!-- Collect the nav links for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="cam"><a >Bienvenid@ <b><?php echo($_SESSION['userName']) ?>  <span class="glyphicon glyphicon glyphicon-user"></span>  </b></a>
                            </li>
                            <li class="cam fz-18"><a href="<?= URL::base(); ?>/Service/fechasInconsistentes"><i class="glyphicon glyphicon-warning-sign"></i><span class="badge badge-mn"><?php print_r($this->Dao_service_model->cantFechasInconsistentes()->cant); ?></span></a></li>
                            <li class="cam"><a href="<?= URL::to('user/principalView'); ?>">Home</a>
                            </li>
                            <li class="cam"><a href="#services">Servicios</a>
                                <ul>
                                    <li><a href="<?= URL::to('Service/assignService'); ?>">Agendar Actividad</a></li>
                                    <li><a href="<?= URL::to('Service/listService'); ?>s">Ver Actividades</a></li>
                                    <li><a href="https://accounts.google.com/ServiceLogin/signinchooser?passive=1209600&continue=https%3A%2F%2Faccounts.google.com%2FManageAccount&followup=https%3A%2F%2Faccounts.google.com%2FManageAccount&flowName=GlifWebSignIn&flowEntry=ServiceLogin" title="drive" target='_blank'>Drive</a></li>
                                </ul>
                            </li>
                            <li class="cam"><a href="#services">RF</a>
                                <ul>
                                    <li class="cam"><a href="<?= URL::to('Service/RF'); ?>">Actualizar RF</a></li>
                                    <li class="cam"><a href="<?= URL::to('SpecificService/viewRF'); ?>">Ver RF</a></li>
                                </ul>
                            </li>
                            <li class="cam"><a href="<?= URL::to('Grafics/getGrafics'); ?>">Gráficas</a>
                            </li>
                            <li class="cam"><a href="<?= URL::to('Modernizaciones/getModernizaciones'); ?>">Modernizaciones</a>
                            </li>
                            </li>
                            <li class="cam"><a href="<?= URL::to('welcome/index'); ?>">Salir  <span class="glyphicon glyphicon glyphicon-off"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!--      fin header         -->
        <br><br><br><br>
        <div class="container">
            <center>
                <legend>Modernizaciones</legend>
            </center>
            <div class="col col-md-12">
                <table id="tabla_modernizaciones" class="table_cr table-hover table table-bordered table-striped dataTable no-footer"></table>
            </div>
        </div>
        <!--  container  -->
        <!--footer-->
        <div class="for-full-back " id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>

        <script type="text/javascript">var baseurl = "<?php echo URL::base(); ?>";</script>
        <!-- DataTables -->
        <script src="<?= URL::to('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?= URL::to('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
        <!-- llenar tablas -->
        <script type="text/javascript" src="<?= URL::to('assets/js/services/listServices.js?v= time() '); ?>"></script>
        <!-- alertas de proximidad de tiempo -->
        <script type="text/javascript" src="<?= URL::to('assets/js/services/ModalTiempos.js'); ?>"></script>
        <script type="text/javascript" src="<?= URL::to('assets/js/modernizacion.js'); ?>"></script>
    </body>
</html>