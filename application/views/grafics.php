 
        <!-- Modal Cami -->
        <link href="<?= URL::to('assets/css/styleModalCami.css'); ?>" rel="stylesheet" />


    </head>
    <body data-url="<?= URL::base(); ?>">
    <center><h1 class="h1">GRÁFICAS POR MESES</h1></center>
    <div class="container">
        <!-- GRÁFICAS -->
        <canvas id="graficsTotal" width="400" height="155"></canvas>
    </div>
    <!-- Modal Gráficas Mes-->
    <div class="modal fade" id="graficsModal" tabindex="-1"  data-toggle="modal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?= URL::to('assets/img/close.ico'); ?>" alt="cerrar" class="modalImage" ></button>
                    <h4 class="modal-title" id="titleMonth">Modal title</h4>
                </div>
                <div class="modal-body" id="contentModalGrafics">
                    <canvas id="modalGrafics" width="400" height="150"></canvas>
                </div>
                <div class="modal-footer">
                    <h4 class="foot">Zolid By ZTE Colombia | All Right Reserved</h4>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar  <i class="glyphicon glyphicon-chevron-up"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tabla detalles-->
    <div class="modal fade" id="tablaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?= URL::to('assets/img/close.ico'); ?>" alt="cerrar" class="modalImage" ></button>
                    <h4 class="modal-title" id="titleType">Modal tabla</h4>
                </div>
                <div class="modal-body">

                    <table id="tableDetail" class='table table-bordered table-striped' width='100%'>

                    </table>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar  <i class="glyphicon glyphicon-chevron-up"></i></button>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Latest compiled and minified JavaScript -->
    <script type="text/javascript">var baseurl = "<?php echo URL::base(); ?>";</script>
    <script type="text/javascript" src="<?= URL::to('assets/js/grafics.js'); ?>"></script>
</body>
</html>
