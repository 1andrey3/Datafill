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
        <script src="<?= URL::to("assets/plugins/sweetalert2/sweetalert2.all.js") ?>"></script>
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
                <table id="tabla_ordenAsoc" class="table_cr table table-hover table-bordered table-striped dataTable no-footer"></table>
            </div>
        </div>
        <!--  container  -->
        

        <!-- modal -->
<!-- document.getElementById('modal_form').style.display='none'; -->
          <div class="modal_a" id="modal_form">
            <a id="close_modal" class='pull-right' onclick="$('#modal_form').hide();" title='Cerrar'><span class='glyphicon glyphicon-remove ex'></span></a>
             <div class="col-xs-offset-2 col-md-8 formContainer">
                <form action="???" method="post" onsubmit="???" class="formOrderModer">
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
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"> <span class="editable">glyphicon glyphicon-calendar> - <span class="editable">ID</span> - <span class="editable">TIPO</span> - <spanc class="noEditable">F. ASIGNACIÓN</span></a>
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
                                        <div class="form-group glyphicon glyphicon-calendar-xs-3">
                                            <label class="modalLabel">F. ASIGNACIÓN</labelglyphicon glyphicon-calendar type="text" class="form-control sinCambio" disabled placeholder="F. ASIGNACIÓN">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-titleglyphicon glyphicon-calendar data-toggle="collapse" data-parentglyphicon glyphicon-calendar" href="#collapse3"> <span class="editable"> F. CIERRE ING</span> - <span class="noEditable">F. EJECUCIÓN CLARO</span> - <span class="noEditable">ESTADO</span> - <span class="noEditable">PROYECTO</span></a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row mar">
                                        <div class="form-group glyphicon glyphicon-calendar-xs-3">
                                            <label class="modalLabel">F. CIERRE ING.</labelglyphicon glyphicon-calendar type="date" class="form-control" placeholder="F. CIERRE ING.">
                                        </div>
                                        <div class="form-group glyphicon glyphicon-calendar-xs-3">
                                            <label class="modalLabel">F. EJECUCIÓN CLARO</labelglyphicon glyphicon-calendar type="text" class="form-control sinCambio" disabled placeholder="F. EJECUCIÓN CLARO">
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
                                <h4 class="panel-titleglyphicon glyphicon-calendar data-toggle="collapse" data-parent="#glyphicon glyphicon-calendar="#collapse4"> <span class="noEditable"> F. FORECAST</span> - <span class="noEditable">F. CREACIÓN</span> - <span class="noEditable">SOLICITANTE</span> - <span class="noEditable">REGIÓN</span></a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row mar">
                                        <div class="form-group glyphicon glyphicon-calendar-xs-3">
                                            <label class="modalLabel">F. FORECAST</labelglyphicon glyphicon-calendar type="text" class="form-control sinCambio" disabled placeholder="F. FORECAST">
                                        </div>
                                        <div class="form-group glyphicon glyphicon-calendar-xs-3">
                                            <label class="modalLabel">F. CREACIÓN</labelglyphicon glyphicon-calendar type="text" class="form-control sinCambio"disabled placeholder="F. CREACIÓN">
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
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5"> <span class="noEditable">DESCRIPCIÓN</span> - <span glyphicon glyphicon-calendareditable">INGENIERO</span> - <span class="editable"> IN SERVICE SITIO</span> - <span class="editable">F. INGRESO DE SERVICIO CLARO</span></a>
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
                                            <!-- <input type="text" class="form-control" placeholder="IN SERVICE SITIO"> -->
                                            <select class="form-control" name="inServiceSitio" id="inServiceSitio">
                                                <option value="">Seleccione</option>
                                                <option value="OK">OK</option>
                                                <option value="PENDIENTE">PENDIENTE</option>
                                            </select>
                                        </div>
                                        <div class="form-group glyphicon glyphicon-calendar-xs-3">
                                            <label class="modalLabel">F. INGRESO DE SERVICIO glyphicon glyphicon-calendar>
                                            <input type="date" class="form-control " placeholder="F. INGRESO DE SERVICIO CLARO">
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
                                            <!-- <input type="text" class="form-control" placeholder="ESTADO TX"> -->
                                            <select class="form-control" name="estadoTX" id="estadoTX">
                                                <option value="">Seleccione</option>
                                                <option value="OK">OK</option>
                                                <option value="PENDIENTE">PENDIENTE</option>
                                            </select>
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">FECHA TX LISTA</label>
                                            <input type="date" class="form-control" placeholder="FECHA TX LISTA">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ESTADO CW</label>
                                            <!-- <input type="text" class="form-control"  placeholder="ESTADO CW"> -->
                                            <select class="form-control" name="estadoCW" id="estadoCW">
                                                <option value="">Seleccione</option>
                                                <option value="OK">OK</option>
                                                <option value="PENDIENTE">PENDIENTE</option>
                                                <option value="NOKIA">NOKIA</option>
                                            </select>
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">FECHA CW LISTA</label>
                                            <input type="date" class="form-control"  placeholder="FECHA CW LISTA">
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
                                            <input type="date" class="form-control" placeholder="RFE(orden de tx orden cw)">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ESTADO DF</label>
                                            <!-- <input type="text" class="form-control" placeholder="ESTADO DF"> -->
                                            <select class="form-control" name="estadoDF" id="estadoDF">
                                                <option value="">Seleccione</option>
                                                <option value="PENDIENTE">PENDIENTE</option>
                                                <option value="DF SOLICITADO">DF SOLICITADO</option>
                                                <option value="DF PENDIENTE OTRAS AREAS">DF PENDIENTE OTRAS AREAS</option>
                                                <option value="OK">OK</option>
                                            </select>
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">FECHA DF</label>
                                            <input type="date" class="form-control" placeholder="FECHA DF">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">RFIC(TX OK  Y CW OK)</label>
                                            <input type="date" class="form-control" placeholder="RFIC(TX OK  Y CW OK)">
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
                                            <input type="date" class="form-control" placeholder="RFI(RFIC OK Y HW OK DF OK)">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ESTADO INSTALACIÓN</label>
                                            <!-- <input type="text" class="form-control" placeholder="ESTADO INSTALACIÓN"> -->
                                            <select class="form-control" name="estadoInstalacion" id="estadoInstalacion">
                                                <option value="">Seleccione</option>
                                                <option value="PENDIENTE">PENDIENTE</option>
                                                <option value="DF SOLICITADO">DF SOLICITADO</option>
                                                <option value="DF PENDIENTE OTRAS AREAS">DF PENDIENTE OTRAS AREAS</option>
                                                <option value="OK">OK</option>
                                            </select>
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">FECHA INSTALACIÓN</label>
                                            <input type="date" class="form-control"  placeholder="FECHA INSTALACIÓN">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ESTADO INTEGRACIÓN</label>
                                            <!-- <input type="text" class="form-control"  placeholder="ESTADO INTEGRACIÓN"> -->
                                            <select class="form-control" name="estadoIntegracion" id="estadoIntegracion">
                                                <option value="">Seleccione</option>
                                                <option value="OK">OK</option>
                                                <option value="PENDIENTE">PENDIENTE</option>
                                            </select>
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
                                            <input type="date" class="form-control" placeholder="FECHA INTEGRACIÓN">
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">ESTADO ONAIR</label>
                                            <!-- <input type="text" class="form-control" placeholder="ESTADO ONAIR"> -->
                                            <select class="form-control" name="estadoOnAir" id="estadoOnAir">
                                                <option value="">Seleccione</option>
                                                <option value="PENDIENTE NOKIA">PENDIENTE NOKIA</option>
                                                <option value="PENDIENTE CLARO">PENDIENTE CLARO</option>
                                                <option value="SEGUIMIENTO PARA PRODUCCION">SEGUIMIENTO PARA PRODUCCION</option>
                                                <option value="OK">OK</option>
                                                <option value="PENDIENTE">PENDIENTE</option>
                                            </select>
                                        </div>
                                        <div class="form-group camposModal col-xs-3">
                                            <label class="modalLabel">FECHA INSERVICE</label>
                                            <input type="date" class="form-control" placeholder="FECHA INSERVICE">
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
                                            <input type="number" class="form-control" placeholder="MES INSERVICE">
                                        </div>
                                        <div class="form-group camposModal col-xs-6">
                                            <label class="modalLabel">AÑO INSERVICE</label>
                                            <input type="number" class="form-control" placeholder="AÑO INSERVICE">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row centrado">
                            <button type="submit" class="btn_moder_modal">Enviar Información</button>
                        </div>
                    </div>
                 </form>
             </div>
          </div>
        <!-- fin modal -->
    <!--*********************  INPUT TEXT  *********************-->
    <!-- <div class="form-group">
        <label for="nombre" class="col-md-3 control-label">etiqueta: &nbsp;</label>
        <div class="col-md-8 selectContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" name="nombre" id="nombre" required class="form-control">
            </div>
        </div>
    </div> -->
     <div id="mdl-form" class="modal fade" role="dialog">
         <div class="modal-dialog modal-lg" style="width: 90%;">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                     <h3 class="modal-title">Editar Modernizaciones</h3>
                 </div>
                <div class="modal-body">
                    <div class="row gray">
                        <form action="" method="post">
                            <div class="col-sm-12 d-if"> <!-- AQUÍ VAN LOS QUE NO SON EDITABLES -->
                                <div class="col-sm-2 input-group form-group p15"><span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span><input name="ot" id="ot" class="nose form-control" disabled type="text" placeholder="ot"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span><input name="actividad" id="actividad" class="nose form-control" disabled type="text" placeholder="actividad"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span><input name="sitio" id="sitio" class="nose form-control" disabled type="text" placeholder="sitio"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="f_asignacion" id="f_asignacion" class="nose form-control" disabled type="text" placeholder="F. ASIGNACIÓN"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="f_ejecucion_claro" id="f_ejecucion_claro" class="nose form-control" disabled type="text" placeholder="F. EJECUCIÓN CLARO"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span><input name="estado" id="estado" class="nose form-control" disabled type="text" placeholder="ESTADO"></div>

                            </div>
                            <div class="col-sm-12 d-if" style="padding-left: 12em;"> <!-- AQUÍ VAN LOS QUE NO SON EDITABLES -->
                                <div class="col-sm-2 input-group form-group p15"><span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span><input name="proyecto" id="proyecto" class="nose form-control" disabled type="text" placeholder="proyecto"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="f_forecast" id="f_forecast" class="nose form-control" disabled type="text" placeholder="F. FORECAST"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="f_creacion" id="f_creacion" class="nose form-control" disabled type="text" placeholder="F. CREACIÓN"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input name="solicitante" id="solicitante" class="nose form-control" disabled type="text" placeholder="SOLICITANTE"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span><input name="region" id="region" class="nose form-control" disabled type="text" placeholder="REGIÓN"></div>

                            <!-- SI SE REQUEIRE EL CAMPO DE DESCRIPCIÓN, ACÁ ESTÁ -->
                            <!-- <div class="col-sm-12 d-if"> 
                                <div class="col-sm-12 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span><textarea class="form-control" disabled name="DESCRIPCION" id="" cols="30" placeholder="DESCRIPCIÓN"></textarea></div>-->
                            </div> 

                            <div class="col-sm-12 d-if">
                                <div class="col-sm-2 input-group form-group p15"><span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span><input name="tipo_orden" id="tipo_orden" class="nose form-control" type="text" placeholder="tipo_orden"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span><input name="trabajo" id="trabajo" class="nose form-control" type="text" placeholder="trabajo"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span><input name="id" id="id" class="nose form-control" type="text" placeholder="id"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-task"></i></span><input name="tipo_tecnologia" id="tipo_tecnologia" class="nose form-control" type="text" placeholder="tipo_tecnologia"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input name="f_cierre_ing" id="f_cierre_ing" class="nose form-control" type="text" placeholder="f_cierre_ing"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input name="ingeniero" id="ingeniero" class="nose form-control" type="text" placeholder="ingeniero"></div>

                            </div>
                            <div class="col-sm-12 d-if">
                                <div class="col-sm-2 input-group form-group p15"><span class="input-group-addon"><i class="glyphicon glyphicon-menu-down"></i></span><input name="in_service_sitio" id="in_service_sitio" class="nose form-control" type="text" placeholder="in_service_sitio"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="f_ingreso_servicio_claro" id="f_ingreso_servicio_claro" class="nose form-control" type="text" placeholder="f_ingreso_servicio_claro"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-menu-down"></i></span><input name="estado_tx" id="estado_tx" class="nose form-control" type="text" placeholder="estado_tx"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="fecha_tx_lista" id="fecha_tx_lista" class="nose form-control" type="text" placeholder="fecha_tx_lista"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-menu-down"></i></span><input name="estado_cw" id="estado_cw" class="nose form-control" type="text" placeholder="estado_cw"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="fecha_cw_lista" id="fecha_cw_lista" class="nose form-control" type="text" placeholder="fecha_cw_lista"></div>

                            </div>
                            <div class="col-sm-12 d-if">
                                <div class="col-sm-2 input-group form-group p15"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="rfe" id="rfe" class="nose form-control" type="text" placeholder="RFE(ORDEN_DE_TX_ORDEN_CW)"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-menu-down"></i></span><input name="estado_df" id="estado_df" class="nose form-control" type="text" placeholder="estado_df"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="fecha_df" id="fecha_df" class="nose form-control" type="text" placeholder="fecha_df"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="rfic" id="rfic" class="nose form-control" type="text" placeholder="RFIC(TX_OK_Y_CW_OK)"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="rfi" id="rfi" class="nose form-control" type="text" placeholder="RFI(RFIC_OK_Y_HW_OK_DF_OK)"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-menu-down"></i></span><input name="estado_instalacion" id="estado_instalacion" class="nose form-control" type="text" placeholder="estado_instalacion"></div>

                            </div>
                            <div class="col-sm-12 d-if">
                                <div class="col-sm-2 input-group form-group p15"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="fecha_instalacion" id="fecha_instalacion" class="nose form-control" type="text" placeholder="fecha_instalacion"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-menu-down"></i></span><input name="estado_integracion" id="estado_integracion" class="nose form-control" type="text" placeholder="estado_integracion"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="fecha_integracion" id="fecha_integracion" class="nose form-control" type="text" placeholder="fecha_integracion"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-menu-down"></i></span><input name="estado_onair" id="estado_onair" class="nose form-control" type="text" placeholder="estado_onair"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="fecha_inservice" id="fecha_inservice" class="nose form-control" type="text" placeholder="fecha_inservice"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span><input name="contratista_cw" id="contratista_cw" class="nose form-control" type="text" placeholder="contratista_cw"></div>

                            </div>
                            <div class="col-sm-12 d-if">
                                <div class="col-sm-2 input-group form-group p15"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="mes_inservice" id="mes_inservice" class="nose form-control" type="text" placeholder="mes_inservice"></div>

                                <div class="col-sm-2 input-group form-group p15 "><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input name="anio_inservice" id="anio_inservice" class="nose form-control" type="text" placeholder="anio_inservice"></div>

                            </div>
                        </form>
                    </div>
                </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
                     <button type="button" class="btn btn-success" id="mdl-moder-send"><i class='glyphicon glyphicon-send'></i>&nbsp;enviar</button>
                 </div>
             </div>
         </div>
     </div>


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
            var ss = <?php echo json_encode($ss); ?>

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