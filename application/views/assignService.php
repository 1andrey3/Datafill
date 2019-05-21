
<!--   botones tabla    -->
<link rel="stylesheet" href="<?= URL::to('assets/css/botonesStyle2.css'); ?>" type="text/css" media="all">
<!--   FORMULARIO CSS    -->
<link href="<?= URL::to('assets/css/formStyle.css'); ?>" rel="stylesheet" />
<!--    JS    -->
<script type="text/javascript" src="<?= URL::to('assets/js/tabs.js'); ?>"></script>

<script>
    baseurl = "<?php echo URL::base(); ?>";
    function showMessage(mensaje) {
        if (mensaje == "error") {
            swal({
                title: "error!",
                text: "Verifique la información",
                type: "error",
                confirmButtonText: "Ok"
            });
        }
    }
</script>
    
        <br>

        <?php

        echo "<center>";
        echo "<ul class='nav'>";
        for ($p = 1; $p <= count($meses); $p++) {
            if ($p == 1) {
                echo "<li class='selected'><a href='#tab" . $p . "'><center>" . $meses[$p] . "</center></a></li>";
            } else {
                echo "<li><a href='#tab" . $p . "'><center>" . $meses[$p] . "</center></a></li>";
            }
        }
        echo "</ul>";
        echo "</center>";
        //--------asignacion
        echo "<div class='tab-content' id='tab1'>";

        echo "<div class='container'>";
        echo "<form class= 'well form-horizontal' action='' method='post'  id='assignService' name='assignServie' enctype= 'multipart/form-data'>";
        echo "<legend >Agendamiento de actividades</legend>";
            echo "<div class='row'>
                    <div class='col-sm-4 cen'><button name='button1' id='button1' value='button1' type= 'submit' class= 'btn btn-primary tamanoAssign' onclick = \"this.form.action = '" . URL::to('SpecificService/assignByMail') . "'\"><span class= 'glyphicon glyphicon-plus'></span>  Asignación</button></div>";
            echo "<div class='col-sm-4 cen'><button name='button2' id='button2' value='button2' type= 'submit' class= 'btn btn-danger tamanoAssign' onclick = \"this.form.action = '" . URL::to('SpecificService/cancelByMail') . "'\"><span class= 'glyphicon glyphicon-remove-circle'></span>  Cancelación</button></div>";
            echo "<div class='col-sm-4 cen'><button name='button3' id='button3' value='button3' type= 'submit' class= 'btn btn-success tamanoAssign' onclick = \"this.form.action = '" . URL::to('SpecificService/executeByExcel') . "'\"><span class= 'glyphicon glyphicon-ok-circle'></span>  Ejecución</button></div></div><br>";
        //-------- Text area------
        echo "<div class='form-group'>";
        echo "<div class='col-md-12 inputGroupContainer'>";
        echo "<div class='input-group'>";
        echo "<span class='input-group-addon spanColor1'><i class='glyphicon glyphicon-file'></i></span>";
        echo "<textarea class='form-control' rows='14' name='actividades' placeholder='Copiar asignación'></textarea>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        ?>
        <!-- <script type="text/javascript"> Cufon.now(); </script> -->

        <script>
            $(document).ready(function() {
                tabs.init();
            })
        </script>

        <?php
        if (isset($error)) {
            if ($error == "error") {
                echo '<script type="text/javascript">showMessage("error");</script>';
            }
        }
        if (isset($message)) {

            echo '<script type="text/javascript">';
            echo 'pushMessage("' . $message . '");';
        } else {
            echo '<script type="text/javascript">';
        }

        echo "function pushMessage(mensaje){";

        echo "if (mensaje == 'ok') {";
        echo "Push.create( 'Bien hecho!', {";
        echo "body: 'Actividad asignada satisfactoriamente',";
        echo "icon: baseurl + '/assets/img/logoblue.png',";
        echo "timeout: 6000,";
        echo "onClick: function () {";
        echo "window.focus();";
        echo "this.close();";
        echo "}";
        echo "});";
        echo "}else if(mensaje == 'error'){";
        echo "Push.create( 'error!', {";
        echo "body: 'Actividades ya existentes ',";
        echo "icon: baseurl + '/assets/img/error.png',";
        echo "timeout: 6000,";
        echo "onClick: function () {";
        echo "window.focus();";
        echo "this.close();";
        echo "}";
        echo "});";
        echo "}";
        echo "}";
        echo "</script>";
        ?>