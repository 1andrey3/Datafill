
        <!-- estilo tablas camilo -->
        <!-- <link href="<?= URL::to('assets/css/styleTablesCami.css'); ?>" rel="stylesheet" /> -->       
        <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/plugins/datatables/css/buttons.dataTables.css'); ?>">
   
<body data-url="<?= URL::base(); ?>">
<br><br><br><br>  
    <h1 class="h1 fixh1rf">RF</h1><hr>

    <div class="container" align="center">
        <button type="button" class="btn btn-success" id="nuevos"><i class="fa fa-fw fa-plus"></i> Nuevos <span id="nuevosBadge" class="badge">...</span></button>
        <button type="button" class="btn btn-primary" id="cambios"><i class="fa fa-fw fa-refresh"></i> Cambios <span id="cambiosBadge" class="badge">...</span></button>
    </div>
    <div class="container">
        <!-- Modal tabla actividades rf nuevas-->
        <div class="modal fade" id="ModalEventosNuevos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg3" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?= URL::to('assets/img/close.ico'); ?>" alt="cerrar" class="modalImage" ></button>
                        <h4 class="modal-title" id="titleEvent">Modal tabla nuevas</h4>
                    </div>
                    <div class="modal-body" id="cuerpoModal">
                        <div class="container lg-cntr">
                            <h4>Tabla Nuevos</h4>
                            <table id="tableEventos" class='table_cr table  table-striped' width='100%'></table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <h4 class="foot">Zolid By ZTE Colombia | All Right Reserved</h4>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar  <i class="glyphicon glyphicon-chevron-up"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin modal actividades nuevas -->

        <!-- Modal tabla actividades rf cambios-->
        <div class="modal fade" id="ModalEventosCambios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg3" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?= URL::to('assets/img/close.ico'); ?>" alt="cerrar" class="modalImage" ></button>
                        <h4 class="modal-title" id="titleEventChanges">Modal tabla Cambios</h4>
                    </div>
                    <div class="modal-body" id="cuerpoModal">

                        <div class="container">
                            <ul class="nav nav-tabs navCami">
                                <li class="active"><a data-toggle="tab" href="#tab_cambios">Tabla Cambios</a></li>
                                <li><a data-toggle="tab" href="#tab_log">Tabla Log</a></li>
                            </ul>

                            <div class="tab-content">

                                <div id="tab_cambios" class="tab-pane fade in active  lg-cntr">
                                    <h4 align="center">TABLA CAMBIOS</h4>
                                    <table id="tableEventosChanges" class='table_cr table  table-striped' width='100%'>

                                    </table>
                                </div>
                                <div id="tab_log" class="tab-pane fade">
                                    <h4 align="center">TABLA LOG</h4>
                                    <table id="tableLog" class='table_cr table  table-striped tableCami' width='100%'></table>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <h4 class="foot">Zolid By ZTE Colombia | All Right Reserved</h4>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar  <i class="glyphicon glyphicon-chevron-up"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin modal actividades rf cambios -->

        <!-- Modal tabla log por id rf nuevas-->
        <div class="modal fade" id="ModalHistorialLog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg2" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?= URL::to('assets/img/close.ico'); ?>" alt="cerrar" class="modalImage" ></button>
                        <h4 class="modal-title" id="titleEventHistory">Modal Historial</h4>
                    </div>
                    <div class="modal-body" id="cuerpoModal">
                        <div class="container lg-cntr">
                            <h3>Tabla Log</h3>
                            <table id="tableHistorialLog" class='table_cr table  table-striped tableCami' width='100%'></table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <h4 class="foot">Zolid By ZTE Colombia | All Right Reserved</h4>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar  <i class="glyphicon glyphicon-chevron-up"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin modal log por id nuevas -->
    </div>

    <div class="container lg-cntr">
        <!-- tABLA RF -->
        <table id="tableRF" class='table_cr table  table-striped table-hover' ></table>
    </div>
    <br><br><br>
    <script type="text/javascript">var baseurl = "<?php echo URL::base(); ?>";</script>
    <script type="text/javascript" src="<?= URL::to('assets/js/services/rf.js'); ?>"></script>
</body>
