<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ordenes Asociadas</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--   ICONO PAGINA    -->
        <link rel="icon" href="http://cellaron.com/media/wysiwyg/zte-mwc-2015-8-l-124x124.png">
        <!--   BOOTSTRAP    -->
        <script type="text/javascript" src="<?= URL::to('assets/plugins/jQuery/jquery-3.1.1.js'); ?>"></script>
        <script type="text/javascript" src="<?= URL::to('assets/plugins/bootstrap.js'); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
        <!-- bottstrap select -->
        <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" /> -->
        <!-- modal stilo -->
        <link rel="stylesheet" href="<?= URL::to('assets/css/emergente.min.css'); ?>">
        <!-- datatables-->
        <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/css/datatables_camilo.css'); ?>">
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
        <script type="text/javascript" src="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.min.js'); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/css/table_christian.css'); ?>">
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
                            <li class="cam"><a >Bienvenid@ <?php print_r($_SESSION['userName']) ?></a>
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
                            <li class="cam"><a href="<?= URL::to('Grafics/getGrafics'); ?>">Graficas</a>
                            </li>
                            <li class="cam"><a href="<?= URL::to('Modernizaciones/getModernizaciones'); ?>">Modernizaciones</a>
                            </li>
                            </li>
                            <li class="cam"><a href="<?= URL::to('welcome/index'); ?>">Salir</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!--      fin header         -->
        <br><br><br><br>
        <div class="container">
            <div class="col-sm-8">
                <legend>Modernizaciones asociadas a la orden <b><?= $idOrden; ?></b></legend>
            </div>
            <div class="col-sm-4">
                <button id="edModer" class="edModer">Editar Modernizaciones</button>
            </div>
            <div class="col col-md-12">
                <table id="tabla_ordenAsoc" class="table_cr table table-bordered table-striped dataTable no-footer"></table>
            </div>
        </div>
        <!--  container  -->
        

        <!-- modal -->
<!-- document.getElementById('modal_form').style.display='none'; -->
          <div class="modal_a" id="modal_form">
            <a id="close_modal" class='pull-right' onclick="$('#modal_form').hide();" title='Cerrar'><span class='glyphicon glyphicon-remove ex'></span></a>
             <div class="col-xs-offset-2 col-md-8 formContainer">
                <form action="" method="post" onsubmit="Validate()" class="formOrderModer">
                    <div class="panel-group" id="accordion">
                        <center> <h2 style="margin-bottom: 4%;">Asociadas</h2></center><hr>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"> <span class="noEditable">OT</span> - <span class="noEditable">ACTIVIDAD</span> - <span class="editable">TIPO</span> - <span class="noEditable">SITIO<span></a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row mar">
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">OT</label>
                                            <input type="text" class="form-control sinCambio" disabled placeholder="OT">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ACTIVIDAD</label>
                                            <input type="text" class="form-control sinCambio" disabled placeholder="ACTIVIDAD">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">TIPO</label>
                                            <input type="text" class="form-control" placeholder="TIPO">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">SITIO</label>
                                            <input type="text" class="form-control sinCambio" disabled placeholder="SITIO">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"> <span class="editable">TRABAJO</span> - <span class="editable">ID</span> - <span class="editable">TIPO</span> - <spanc class="noEditable">F. ASIGNACIÓN</span></a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row mar">
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">TRABAJO</label>
                                            <input type="text" class="form-control" placeholder="TRABAJO">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ID</label>
                                            <input type="text" class="form-control" placeholder="ID">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">TIPO</label>
                                            <input type="text" class="form-control" placeholder="TIPO">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">F. ASIGNACIÓN</label>
                                            <input type="text" class="form-control sinCambio" disabled placeholder="F. ASIGNACIÓN">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"> <span class="editable"> F. CIERRE ING</span> - <span class="noEditable">F. EJECUCIÓN CLARO</span> - <span class="noEditable">ESTADO</span> - <span class="noEditable">PROYECTO</span></a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row mar">
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">F. CIERRE ING.</label>
                                            <input type="text" class="form-control" placeholder="F. CIERRE ING.">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">F. EJECUCIÓN CLARO</label>
                                            <input type="text" class="form-control sinCambio" disabled placeholder="F. EJECUCIÓN CLARO">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ESTADO</label>
                                            <input type="text" class="form-control sinCambio" disabled placeholder="ESTADO">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">PROYECTO</label>
                                            <input type="text" class="form-control sinCambio" disabled placeholder="PROYECTO">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"> <span class="noEditable"> F. FORECAST</span> - <span class="noEditable">F. CREACIÓN</span> - <span class="noEditable">SOLICITANTE</span> - <span class="noEditable">REGIÓN</span></a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row mar">
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">F. FORECAST</label>
                                            <input type="text" class="form-control sinCambio" disabled placeholder="F. FORECAST">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">F. CREACIÓN</label>
                                            <input type="text" class="form-control sinCambio"disabled placeholder="F. CREACIÓN">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">SOLICITANTE</label>
                                            <input type="text" class="form-control sinCambio" disabled placeholder="SOLICITANTE">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">REGIÓN</label>
                                            <input type="text" class="form-control sinCambio" disabled placeholder="REGIÓN">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5"> <span class="noEditable">DESCRIPCIÓN</span> - <span class="editable">INGENIERO</span> - <span class="editable"> IN SERVICE SITIO</span> - <span class="editable">F. INGRESO DE SERVICIO CLARO</span></a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                  <div class="row mar">
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">DESCRIPCIÓN.</label>
                                            <input type="text" class="form-control sinCambio" disabled placeholder="DESCRIPCIÓN.">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">INGENIERO</label>
                                            <input type="text" class="form-control" placeholder="INGENIERO">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">IN SERVICE SITIO</label>
                                            <input type="text" class="form-control" placeholder="IN SERVICE SITIO">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">F. INGRESO DE SERVICIO CLARO</label>
                                            <input type="text" class="form-control " placeholder="F. INGRESO DE SERVICIO CLARO">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse7"> <span class="editable">ESTADO TX</span> - <span class="editable">FECHA TX LISTA</span> - <span class="editable">ESTADO CW</span> - <span class="editable">FECHA CW LISTA</span></a>
                                </h4>
                            </div>
                            <div id="collapse7" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row mar">
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ESTADO TX</label>
                                            <input type="text" class="form-control" placeholder="ESTADO TX">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">FECHA TX LISTA</label>
                                            <input type="text" class="form-control" placeholder="FECHA TX LISTA">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ESTADO CW</label>
                                            <input type="text" class="form-control"  placeholder="ESTADO CW">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">FECHA CW LISTA</label>
                                            <input type="text" class="form-control"  placeholder="FECHA CW LISTA">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse8"> <span class="editable">RFE(orden de tx orden cw)</span> - <span class="editable">ESTADO DF</span> - <span class="editable">FECHA DF</span> - <span class="editable">RFIC(TX OK  Y CW OK)</span></a>
                                </h4>
                            </div>
                            <div id="collapse8" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row mar">
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">RFE(orden de tx orden cw)</label>
                                            <input type="text" class="form-control" placeholder="RFE(orden de tx orden cw)">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ESTADO DF</label>
                                            <input type="text" class="form-control" placeholder="ESTADO DF">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">FECHA DF</label>
                                            <input type="text" class="form-control" placeholder="FECHA DF">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">RFIC(TX OK  Y CW OK)</label>
                                            <input type="text" class="form-control" placeholder="RFIC(TX OK  Y CW OK)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse9"> <span class="editable">RFI(RFIC OK Y HW OK DF OK)</span> - <span class="editable">ESTADO INSTALACIÓN</span> - <span class="editable">FECHA INSTALACIÓN</span> - <span class="editable">ESTADO INTEGRACIÓN</span></a>
                                </h4>
                            </div>
                            <div id="collapse9" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row mar">
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">RFI(RFIC OK Y HW OK DF OK)</label>
                                            <input type="text" class="form-control" placeholder="RFI(RFIC OK Y HW OK DF OK)">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ESTADO INSTALACIÓN</label>
                                            <input type="text" class="form-control" placeholder="ESTADO INSTALACIÓN">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">FECHA INSTALACIÓN</label>
                                            <input type="text" class="form-control"  placeholder="FECHA INSTALACIÓN">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ESTADO INTEGRACIÓN</label>
                                            <input type="text" class="form-control"  placeholder="ESTADO INTEGRACIÓN">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse10"> <span class="editable">FECHA INTEGRACIÓN</span> - <span class="editable">ESTADO ONAIR</span> - <span class="editable">FECHA INSERVICE</span> - <span class="editable">CONTRATISTA CW</span></a>
                                </h4>
                            </div>
                            <div id="collapse10" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row mar">
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">FECHA INTEGRACIÓN</label>
                                            <input type="text" class="form-control" placeholder="FECHA INTEGRACIÓN">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ESTADO ONAIR</label>
                                            <input type="text" class="form-control" placeholder="ESTADO ONAIR">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">FECHA INSERVICE</label>
                                            <input type="text" class="form-control" placeholder="FECHA INSERVICE">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">CONTRATISTA CW</label>
                                            <input type="text" class="form-control" placeholder="CONTRATISTA CW">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse11"> <span class="editable">MES INSERVICE</span> - <span class="editable">AÑO INSERVICE</span></a>
                                </h4>
                            </div>
                            <div id="collapse11" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row mar">
                                        <div class="form-group camposModal col-xs-6">
                                            <label class="modalLabel">MES INSERVICE</label>
                                            <input type="text" class="form-control" placeholder="MES INSERVICE">
                                        </div>
                                        <div class="form-group camposModal col-xs-6">
                                            <label class="modalLabel">AÑO INSERVICE</label>
                                            <input type="text" class="form-control" placeholder="AÑO INSERVICE">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-success col-sm-6 col-sm-offset-3">Enviar Información</button>
                        </div>
                    </div>
                 </form>
             </div>
          </div>
        <!-- fin modal -->
        <!--footer-->
        <div class="for-full-back " id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>

        <script type="text/javascript">var baseurl = "<?php echo URL::base(); ?>";</script>
        <script type="text/javascript">var idOrden = <?php echo $idOrden; ?>;</script>
        <script type="text/javascript">
            var formato_fecha = new Date();
            const meses_anual = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            var fecha_actual = formato_fecha.getDate() + " de " + meses_anual[formato_fecha.getMonth()] + " de " + formato_fecha.getFullYear();
        </script>
        <!-- DataTables -->
        <script src="<?= URL::to('assets/plugins/datatables2/DataTables-1.10.16/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?= URL::to('assets/plugins/datatables2/js/dataTables.bootstrap.js?v=1.0'); ?>"></script>
        <script type="text/javascript" src="<?= URL::to("assets/plugins/datatables2/js/dataTables.buttons.min.js") ?>"></script>
        <script type="text/javascript" src="<?= URL::to("assets/plugins/datatables2/js/jszip.min.js") ?>"></script>
        <script type="text/javascript" src="<?= URL::to("assets/plugins/datatables2/js/pdfmake.min.js") ?>"></script>
        <script type="text/javascript" src="<?= URL::to("assets/plugins/datatables2/js/vfs_fonts.js") ?>"></script>
        <script type="text/javascript" src="<?= URL::to("assets/plugins/datatables2/js/buttons.html5.min.js") ?>"></script>
        <script type="text/javascript" src="<?= URL::to("assets/plugins/datatables2/js/buttons.print.min.js") ?>"></script>
        <script type="text/javascript" src="<?= URL::to("assets/plugins/datatables2/js/dataTables.select.min.js") ?>"></script>
        

        <!-- llenar tablas -->
        <!-- alertas de proximidad de tiempo -->
        <script type="text/javascript" src="<?= URL::to('assets/js/ordenModerDetail.js'); ?>"></script>
    </body>
</html>