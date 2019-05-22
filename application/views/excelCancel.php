<form class="form-group" action=" " method="post"  id="cancel" name="cancel">
    <?php
    for ($r = 0; $r < count($cancelar['idActividad']); $r++) {
        echo "<input type='hidden' name='actividades_" . $r . "' id='actividades_" . $r . "' value='" . $cancelar['idActividad'][$r] . "'>";
    }
    echo "<input type='hidden' name='cant' value='" . count($cancelar['idActividad']) . "'>";
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-sm-offset-7">
                <input type="submit" name="bt_form" id="bt_form" value="Enviar Cancelación" class="btn col-xs-6 style_button" onclick= "this.form.action = '<?= URL::to('SpecificService/saveCancelExcel'); ?>'">
            </div>
        </div>
    </div>

</form>
<section class="content">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="box">
                <?php
                echo "<div class='box-header infoExcelActivity'>";
                echo "<h5><b>OT : </b> " . $cancelar['ot'] . "</h5><h5><b>Solicitante : </b> " . $cancelar['solicitante'] . "</h5><h5><b>Fecha de Creacion : </b> " . $cancelar['fCreacion'] . "</h5>";
                echo "<h5><b>Descripción : </b> " . $cancelar['descripcion'] . "</h5>";
                echo "</div><hr>";
                echo "<!-- /.box-header -->";
                echo "<div class='box-body'>";
                echo "<table id='example' class='table-hover table_cr table table-bordered table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID Actividad</th>";
                echo "<th>Tipo Actividad</th>";
                echo "<th>Cantidad</th>";
                echo "<th>Descripcion</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                for ($i = 0; $i < count($cancelar['idActividad']); $i++) {

                    echo "<tr>";
                    echo "<td>" . $cancelar['idActividad'][$i] . "</td>";
                    echo "<td>" . $cancelar['tipo'][$i] . "</td>";
                    echo "<td>" . $cancelar['cantidad'][$i] . "</td>";
                    echo "<td>" . $cancelar['descripcionActividad'][$i] . "</td>";
                    echo "</tr>";
                }

                echo "<tfoot>";
                echo "<tr>";
                echo "<th>ID Actividad</th>";
                echo "<th>Tipo Actividad</th>";
                echo "<th>Cantidad</th>";
                echo "<th>Descripcion</th>";
                echo "</tr>";
                echo "</tfoot>";
                echo "</table>";
                echo "</div>";
                ?>   <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script>
        $(function() {
            $("#example").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
</script>
