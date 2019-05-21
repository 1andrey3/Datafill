<!--   INPUTFILE CSS    -->
<link href="<?= URL::to('assets/css/inputFile.css'); ?>" rel="stylesheet" />
<body data-base="<?= URL::base() ?>">
    <form method="post" enctype="multipart/form-data" id="formFileUpload">
        <input type="file" name="idarchivo">
        <p>Arrastra tu archivo aquí o haz clic en esta área.</p>
        <button id="btnUploadFile" type="submit" class="btn btn-primary" >UpLoad  <span class="glyphicon glyphicon-ok"></span></button>
    </form>
    <script type="text/javascript">var baseurl = "<?php echo URL::base(); ?>";</script>

    <script src="<?= URL::to("assets/js/utils/app.global.js") ?>" type="text/javascript"></script>
    <script src="<?= URL::to("assets/js/utils/app.dom.js") ?>" type="text/javascript"></script>
    <!-- sweet alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.min.js"></script>
    <!-- para cargar los archivos excel xlsx -->
    <script src="<?= URL::to("assets/js/services/loadInformation.js") ?>" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $('form input').change(function() {
                $('form p').text(this.files.length + " file(s) selected");
            });
        });
    </script>
</body>
