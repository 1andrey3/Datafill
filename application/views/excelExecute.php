<form class="form-group" action=" " method="post"  id="cancel" name="cancel">
    <?php
    for ($r = 0; $r < count($ejecutar['idActividad']); $r++) {
        echo "<input type='hidden' name='actividades_" . $r . "' id='actividades_" . $r . "' value='" . $ejecutar['idActividad'][$r] . "'>";
        echo "<input type='hidden' name='fechaEjecucion_" . $r . "' id='fechaEjecucion_" . $r . "' value='" . $ejecutar['fEjecucion'][$r] . "'>";
        echo "<input type='hidden' name='estado_" . $r . "' id='estado_" . $r . "' value='" . $ejecutar['estado'][$r] . "'>";
    }
    echo "<input type='hidden' name='cant' value='" . count($ejecutar['idActividad']) . "'>";
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-sm-offset-6">
                <input type="submit" name="bt_form" id="bt_form" value="Enviar Ejecución" class="btn col-xs-5 s_b " onclick = "this.form.action = '<?= URL::to('SpecificService/saveExecuteExcel'); ?>'">
            </div>
        </div>
    </div>
</form>
<section class="content">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="box">

                <section class="content">
                    <div class="row">
                        <div class="col-xs-10 col-xs-offset-1">
                            <div class="box">
<?php
echo "<div class='box-header infoExcelActivity'>";
echo "<h5><b>OT : </b> " . $ejecutar['ot'] . "</h5><h5><b>Solicitante : </b> " . $ejecutar['solicitante'] . "</h5><h5><b>Fecha de Creacion : </b> " . $ejecutar['fCreacion'] . "</h5>";
echo "<h5><b>Descripción : </b> " . $ejecutar['descripcion'] . "</h5>";
echo "</div>";
echo "<!-- /.box-header -->";
echo "<div class='box-body'>";
echo "<table id='example' class='table-hover table_cr table table-bordered table-striped'>";
echo "<thead>";
echo "<tr>";
echo "<th>ID Actividad</th>";
echo "<th>Tipo actividad</th>";
echo "<th>Cantidad</th>";
echo "<th>Descripción</th>";
echo "<th>Estado</th>";
echo "<th>Fecha Ejecución</th>";
echo "<th>Ejecutada en inst. proveedor</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
for ($i = 0; $i < count($ejecutar['idActividad']); $i++) {

    echo "<tr>";
    echo "<td>" . $ejecutar['idActividad'][$i] . "</td>";
    echo "<td>" . $ejecutar['tipo'][$i] . "</td>";
    echo "<td>" . $ejecutar['cantidad'][$i] . "</td>";
    echo "<td>" . $ejecutar['descripcionActividad'][$i] . "</td>";
    echo "<td>" . $ejecutar['estado'][$i] . "</td>";
    echo "<td>" . $ejecutar['fEjecucion'][$i] . "</td>";
    echo "<td>" . $ejecutar['ejecProveedor'][$i] . "</td>";
    echo "</tr>";
}

echo "<tfoot>";
echo "<tr>";
echo "<th>ID Actividad</th>";
echo "<th>Tipo actividad</th>";
echo "<th>Cantidad</th>";
echo "<th>Descripción</th>";
echo "<th>Estado</th>";
echo "<th>Fecha Ejecución</th>";
echo "<th>Ejecutada en inst. proveedor</th>";
echo "</tr>";
echo "</tfoot>";
echo "</table>";
echo "</div>";
?>   
            <!-- /.box-body -->
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
