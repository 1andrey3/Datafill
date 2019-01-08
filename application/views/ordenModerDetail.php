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

    <!-- ******************************MODAL*************************** -->
    <div id="mdl-form" class="modal fade" role="dialog" style="overflow: auto;">
         <div class="modal-dialog modal-lg" style="width: 90%;overflow:auto;">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                     <h3 class="modal-title">Editar Modernizaciones</h3>
                 </div>
                <div class="modal-body">
                    <h2>Editar Asociadas</h2>
                    <div class="row gray">
                        <div class="row"> <!-- AQUÍ VAN LOS QUE NO SON EDITABLES -->
                            <div class="col-sm-12 d-if"> 
                                <div class="col-sm-2 input-group form-group p15"><div class="titdate"><p>ot</p></div><span class="input-group-addon colorSpan noEditable"><i class="glyphicon glyphicon-book"></i></span><input name="ot" id="ot" class="styleInput form-control" disabled type="text" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>actividad</p></div><span class="input-group-addon colorSpan noEditable"><i class="glyphicon glyphicon-barcode"></i></span><input name="actividad" id="actividad" class="styleInput form-control" disabled type="text" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>sitio</p></div><span class="input-group-addon colorSpan noEditable"><i class="glyphicon glyphicon-globe"></i></span><input name="sitio" id="sitio" class="styleInput form-control" disabled type="text" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>f_asignacion</p></div><span class="input-group-addon colorSpan noEditable"><i class="glyphicon glyphicon-calendar"></i></span><input name="f_asignacion" id="f_asignacion" class="styleInput form-control" disabled type="text"  ASIGNACIÓN"></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>f_ejecucion_claro</p></div><span class="input-group-addon colorSpan noEditable"><i class="glyphicon glyphicon-calendar"></i></span><input name="f_ejecucion_claro" id="f_ejecucion_claro" class="styleInput form-control" disabled type="text"  EJECUCIÓN CLARO"></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>estado</p></div><span class="input-group-addon colorSpan noEditable"><i class="glyphicon glyphicon-tag"></i></span><input name="estado" id="estado" class="styleInput form-control" disabled type="text" ></div>
                                
                            </div>
                            <div class="col-sm-12 d-if"> <!-- AQUÍ VAN LOS QUE NO SON EDITABLES -->
                                <div class="col-sm-3 input-group form-group p15"><div class="titdate"><p>proyecto</p></div><span class="input-group-addon colorSpan noEditable"><i class="glyphicon glyphicon-folder-open"></i></span><input name="proyecto" id="proyecto" class="styleInput form-control" disabled type="text" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>f_forecast</p></div><span class="input-group-addon colorSpan noEditable"><i class="glyphicon glyphicon-calendar"></i></span><input name="f_forecast" id="f_forecast" class="styleInput form-control" disabled type="text"  FORECAST"></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>f_creacion</p></div><span class="input-group-addon colorSpan noEditable"><i class="glyphicon glyphicon-calendar"></i></span><input name="f_creacion" id="f_creacion" class="styleInput form-control" disabled type="text"  CREACIÓN"></div>
                                <div class="col-sm-3 input-group form-group p15 "><div class="titdate"><p>solicitante</p></div><span class="input-group-addon colorSpan noEditable"><i class="glyphicon glyphicon-user"></i></span><input name="solicitante" id="solicitante" class="styleInput form-control" disabled type="text" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>region</p></div><span class="input-group-addon colorSpan noEditable"><i class="glyphicon glyphicon-globe"></i></span><input name="region" id="region" class="styleInput form-control" disabled type="text" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="tit"><label class="pdown" for="id">id</label></div><span class="input-group-addon colorSpan noEditable"><i class="glyphicon glyphicon-barcode"></i></span><input disabled id="id" class="clickx styleInput form-control" placeholder="id" type="text" ></div>
                            <!-- SI SE REQUEIRE EL CAMPO DE DESCRIPCIÓN, ACÁ ESTÁ -->
                            <!-- <div class="col-sm-12 d-if"> 
                                <div class="col-sm-12 input-group form-group p15 "><div class="titdate"><p>DESCRIPCION</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-list-alt"></i></span><textarea class="form-control" disabled name="DESCRIPCION" id="" cols="30" ></textarea></div>-->
                            </div> 
                        </div>
                        <div id="alertCI" class="alert alert-warning">
                        <center><strong>¡Cuidado!</strong> Los campos con borde rojo indica que en las filas seleccionadas, no todas tienen el mismo valor</center>
                        </div>
                        <hr>
                        <form method="post" id="updateModer">
                            <div class="col-sm-12 d-if">
                                <div class="col-sm-2 input-group form-group p15"><div class="tit"><label class="pdown" for="tipo_orden">tipo_orden</label></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-briefcase"></i></span><input name="tipo_orden" id="tipo_orden" class="clickx styleInput form-control" placeholder="tipo_orden" type="text" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="tit"><label class="pdown" for="trabajo">trabajo</label></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-list"></i></span><input name="trabajo" id="trabajo" class="clickx styleInput form-control" placeholder="trabajo" type="text" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="tit"><label class="pdown" for="tipo_tecnologia">tipo_tecnologia</label></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-tasks"></i></span><input name="tipo_tecnologia" id="tipo_tecnologia" class="clickx styleInput form-control" placeholder="tipo_tecnologia" type="text" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>f_cierre_ing</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="f_cierre_ing" id="f_cierre_ing" class="styleInput form-control" type="date" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="tit"><label class="pdown" for="ingeniero">ingeniero</label></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-user"></i></span><input name="ingeniero" id="ingeniero" class="clickx styleInput form-control" placeholder="ingeniero" type="text" ></div>
                                <div class="col-sm-2 input-group form-group p15"><div class="titdate"><p>in_service_sitio</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-menu-down"></i></span><select name="in_service_sitio" id="in_service_sitio" class="styleInput form-control">
                                    <option value="" >seleccione</option>
                                    <option value="OK">OK</option>
                                    <option value="PENDIENTE">PENDIENTE</option>
                                </select></div>
                            </div>
                            <div class="col-sm-12 d-if">
                                <div class="col-sm-3 input-group form-group p15 "><div class="titdate"><p>f_ingreso_servicio_claro</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="f_ingreso_servicio_claro" id="f_ingreso_servicio_claro" class="styleInput form-control" type="date" ></div>
                                <div class="col-sm-3 input-group form-group p15 "><div class="titdate"><p>estado_tx</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-menu-down"></i></span><select name="estado_tx" id="estado_tx" class="styleInput form-control">
                                    <option value="" >seleccione</option>
                                    <option value="OK">OK</option>
                                    <option value="PENDIENTE">PENDIENTE</option>
                                </select></div>
                                <div class="col-sm-3 input-group form-group p15 "><div class="titdate"><p>fecha_tx_lista</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="fecha_tx_lista" id="fecha_tx_lista" class="styleInput form-control" type="date" ></div>
                                <div class="col-sm-3 input-group form-group p15 "><div class="titdate"><p>estado_cw</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-menu-down"></i></span><select name="estado_cw" id="estado_cw" class="styleInput form-control">
                                    <option value="">seleccione</option>
                                    <option value="OK">OK</option>
                                    <option value="PENDIENTE">PENDIENTE</option>
                                    <option value="NOKIA">NOKIA</option>
                                </select></div>
                            </div>
                            <div class="col-sm-12 d-if">
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>fecha_cw_lista</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="fecha_cw_lista" id="fecha_cw_lista" class="styleInput form-control" type="date" ></div>
                                <div class="col-sm-2 input-group form-group p15"><div class="titdate"><p>rfe</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="rfe" id="rfe" class="styleInput form-control" type="date" ORDEN_DE_TX_ORDEN_CW)"></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>estado_df</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-menu-down"></i></span><select name="estado_df" id="estado_df" class="styleInput form-control">
                                    <option value="">seleccione</option>
                                    <option value="PENDIENTE">PENDIENTE</option>
                                    <option value="DF_SOLICITADO">DF_SOLICITADO</option>
                                    <option value="DF_PENDIENTE_OTRAS_AREAS">DF_PENDIENTE_OTRAS_AREAS</option>
                                    <option value="OK">OK</option>
                                </select></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>fecha_df</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="fecha_df" id="fecha_df" class="styleInput form-control" type="date" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>rfic</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="rfic" id="rfic" class="styleInput form-control" type="date" TX_OK_Y_CW_OK)"></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>rfi</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="rfi" id="rfi" class="styleInput form-control" type="date" RFIC_OK_Y_HW_OK_DF_OK)"></div>
                            </div>
                            <div class="col-sm-12 d-if">
                                <div class="col-sm-3 input-group form-group p15 "><div class="titdate"><p>estado_instalacion</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-menu-down"></i></span><select name="estado_instalacion" id="estado_instalacion" class="styleInput form-control">
                                    <option value="" >seleccione</option>
                                    <option value="PENDIENTE">PENDIENTE</option>
                                    <option value="DF_SOLICITADO">DF_SOLICITADO</option>
                                    <option value="DF_PENDIENTE_OTRAS_AREAS">DF_PENDIENTE_OTRAS_AREAS</option>
                                    <option value="OK">OK</option>
                                </select></div>
                                <div class="col-sm-3 input-group form-group p15"><div class="titdate"><p>fecha_instalacion</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="fecha_instalacion" id="fecha_instalacion" class="styleInput form-control" type="date" ></div>
                                <div class="col-sm-3 input-group form-group p15 "><div class="titdate"><p>estado_integracion</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-menu-down"></i></span><select name="estado_integracion" id="estado_integracion" class="styleInput form-control">
                                    <option value="" >seleccione</option>
                                    <option value="OK">OK</option>
                                    <option value="PENDIENTE">PENDIENTE</option>
                                </select></div>
                                <div class="col-sm-3 input-group form-group p15 "><div class="titdate"><p>fecha_integracion</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="fecha_integracion" id="fecha_integracion" class="styleInput form-control" type="date" ></div>
                            </div>
                            <div class="col-sm-offset-1 col-sm-12 d-if">
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>estado_onair</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-menu-down"></i></span><select name="estado_onair" id="estado_onair" class="styleInput form-control">
                                    <option value="" >seleccione</option>
                                    <option value="PENDIENTE_NOKIA">PENDIENTE_NOKIA</option>
                                    <option value="PENDIENTE_CLARO">PENDIENTE_CLARO</option>
                                    <option value="SEGUIMIENTO_PARA_PRODUCCION">SEGUIMIENTO_PARA_PRODUCCION</option>
                                    <option value="OK">OK</option>
                                    <option value="PENDIENTE">PENDIENTE</option>
                                </select></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="titdate"><p>fecha_inservice</p></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="fecha_inservice" id="fecha_inservice" class="styleInput form-control" type="date" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="tit"><label class="pdown" for="contratista_cw">contratista_cw</label></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-align-justify"></i></span><input name="contratista_cw" id="contratista_cw" class="clickx styleInput form-control" placeholder="contratista_cw" type="text" ></div>
                                <div class="col-sm-2 input-group form-group p15"><div class="tit"><label class="pdown" for="mes_inservice">mes_inservice</label></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="mes_inservice" id="mes_inservice" class="clickx styleInput form-control" placeholder="mes_inservice" type="text" ></div>
                                <div class="col-sm-2 input-group form-group p15 "><div class="tit"><label class="pdown" for="anio_inservice">año_inservice</label></div><span class="input-group-addon colorSpan"><i class="glyphicon glyphicon-calendar"></i></span><input name="anio_inservice" id="anio_inservice" class="clickx styleInput form-control" placeholder="anio_inservice" type="text" ></div>
                            </div>
                        </form>
                    </div>
                </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
                     <button type="button" class="btn btn-success" id="mdl-moder-send"><i class='glyphicon glyphicon-send'></i>&nbsp;enviar</button>
                 </div>
             </div>
         </div>
     </div>

    <!-- ******************************FIN MODAL*************************** -->
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