
<link rel="stylesheet" href="<?= URL::to('assets/css/emergente.min.css'); ?>">>
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
<body data-url="<?= URL::base(); ?>">
    <input type="hidden" id="session_id" value="<?= $_SESSION["id"] ?>"/>
    <input type="hidden" id="session_role" value="<?= $_SESSION["role"] ?>"/>
    <br><br>
    <div class="container">
        <h1>Modernizaciones</h1>
        <div class="col col-md-12">
            <table id="tabla_modernizaciones" class="table_cr table-hover table table-bordered table-striped dataTable no-footer"></table>
        </div>
    </div>
    <script type="text/javascript">var baseurl = "<?php echo URL::base(); ?>";</script>
    <!-- llenar tablas -->
    <script type="text/javascript" src="<?= URL::to('assets/js/services/listServices.js?v= time() '); ?>"></script>
    <!-- alertas de proximidad de tiempo -->
    <script type="text/javascript" src="<?= URL::to('assets/js/services/ModalTiempos.js'); ?>"></script>
    <script type="text/javascript" src="<?= URL::to('assets/js/modernizacion.js'); ?>"></script>
</body>