
<!-- boton -->
<link href="<?= URL::to('assets/css/styleBoton.css" rel="stylesheet'); ?>" />
<!--LIST CSS-->
<link rel="stylesheet" type="text/css" href="<?= URL::to('assets/css/styleList.css'); ?>">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<body>
    <br><br><br>
    <div id="container">
        <form action=" " method="post"  id="assignService" name="assignServie">
            <?php
            //------------------ORDEN---------------------
            echo "<div class='whole' style='margin: 8px'>";
            echo "<div class='type'>";
            echo "<p>Orden</p>";
            echo "</div>";
            echo "<div class='plan'>";

            echo "<div class='header'>";
            echo "<span></span><img src='" . URL::to('assets/img/orden.png') . "'><sup></sup>";
            echo "</div>";

            echo "<div class='content'>";
            echo "<ul>";
            echo "<div class='header'><b>Ing solicitante: </b>" . $service->getIngSol() . "</div>";
            echo "<div class='header'><b>Proyecto: </b>" . $service->getProyecto() . "</div>";
            echo "<div class='header'><b>Ing Asignado: </b>" . $service->getUser()->getName() . " " . $service->getUser()->getLastname() . "</div>";
            echo "<li><b>Orden:    </b>" . $service->getOrder()->getId() . "</li>";
            echo "<li><b>ID Actividad:    </b>" . $service->getIdClaro() . "</li>";
            echo "<li><b>Estación Base:    </b>" . $service->getSite()->getName() . "</li>";
            echo "<li><b>Duración:    </b>" . $service->getDuration() . "</li>";
            echo "</ul>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            //---------------------------------TIPO ACTIVIDAD---------------------------------------------
            echo "<div class='whole' style='margin: 8px'>";
            echo "<div class='type'>";
            echo "<p>Tipo Actividad</p>";
            echo "</div>";
            echo "<div class='plan'>";
            echo "<div class='header'>";
            echo "<span></span><img src='" . URL::to('assets/img/actividades.png') . "'><sup></sup>";
            echo "<p class='month'></p>";
            echo "</div>";
            echo "<div class='content'>";
            echo "<ul>";
            echo "<li><b>Tipo:    </b>" . $service->getService()->getType() . "</li>";
            echo "<div class='header'><b>Gerencia Tarea:    </b>" . $service->getService()->getGerency() . "</div>";
            echo "<div class='header'><b>Descripción Tarea:    </b>" . $service->getService()->getDescription() . "</div>";
            echo "<div class='header'><b>Alcance:    </b>" . $service->getService()->getScope() . "</div>";
            echo "</ul>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            //<!--___________________FECHAS_________________________-->

            echo "<div class='whole' style='margin: 8px'>";
            echo "<div class='type'>";
            echo "<p>Fechas</p>";
            echo "</div>";
            echo "<div class='plan'>";
            echo "<div class='header'>";
            echo "<span></span><img src='" . URL::to('assets/img/fecha.png') . "'><sup></sup>";
            echo "<p class='month'></p>";
            echo "</div>";
            echo "<div class='content'>";
            echo "<ul>";
            echo "<li><b>Fecha Forecast:</b>     " . $service->getDateForecast() . "</li>";
            echo "<li><b>Fecha Creación:</b>    " . $service->getDateCreation() . "</li>";
            echo "<li><b>Fecha Asignación:</b>    " . $service->getDateStartP() . "</li>";
            echo "<li><b>Fecha Inicio Real:</b>     " . $service->getDateStartR() . "</li>";
            echo "<li><b>Fecha Fin Real:</b>     " . $service->getDateFinishR() . "</li>";
            echo "</ul>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
//---------------------OBSERVACIONES--------------------------------------------------------

            echo "<div class='whole' style='margin: 8px'>";
            echo "<div class='type'>";
            echo "<p>Observaciones</p>";
            echo "</div>";
            echo "<div class='plan'>";
            echo "<div class='header'>";
            echo "<span></span><img src='" . URL::to('assets/img/comentarios.png') . "'><sup></sup>";
            echo "<p class='month'></p>";
            echo "</div>";
            echo "<div class='content'>";
            echo "<ul>";
            echo "<div class='header'><b>Descripción Orden: </b>" . $service->getClaroDescription() . "</div>";
            echo "<div class='header'><b>Descripción Actividad: </b>" . $service->getDescription() . "</div>";
            echo "<div class='header'><b>Observaciones de Cierre: </b>" . $service->getCierreDescription() . "</div>";
            echo "</ul>";
            echo "</div>";
            echo "<div class='content'>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

            //------------------CIERRE---------------------------

            if ($service->getCRQ() == "") {
                echo "<div class='whole' style='margin: 8px'>";
                echo "<div class='type'>";
                echo "<p>Datos cierre</p>";
                echo "</div>";
                echo "<div class='plan'>";
                echo "<div class='header'>";
                echo "<span></span><img src='" . URL::to('assets/img/editar.png') . "'><sup></sup>";
                echo "<p class='month'></p>";
                echo "</div>";

                echo "<div id='ultimate'>";
                echo "<p>Link Drive Env</p>";
                echo "</div>";
                echo "<input type='text' name='link' id='link' class='form-control' value='' placeholder='link'style='display: center; color: white; background-color: #333;'>";

                echo "<div id='ultimate'>";
                echo "<p>Link Drive Eje</p>";
                echo "</div>";
                echo "<input type='text' name='link2' id='link2' class='form-control' value='' placeholder='Link Drive evidencia ejecución'style='display: center; color: white; background-color: #333;'>";

                echo "<div id='ultimate'>";
                echo "<p>Fecha inicio real</p>";
                echo "</div>";
                echo "<input type='date' name='fInicior' id='fInicior' class='form-control' value='' placeholder='Fecha Inicio Real' required style='display: center; color: white; background-color: #333;'>";
                echo "<div id='ultimate'>";
                echo "<p>Fecha fin real</p>";
                echo "</div>";
                echo "<input type='date' name='fFinr' id='fFinr' class='form-control' value='' placeholder='Fecha Fin Real' required style='display: center; color: white; background-color: #333;'>";

                echo "<div class='content'>";
                echo "<div id='ultimate'>";
                echo "<p>CRQ</p>";
                echo "</div>";
                echo "<ul>";
                echo "<input type='text' name='crq' id='crq' class='form-control' value='' placeholder='Digite el CRQ' style='display: center; color: white; background-color: #333;'>";
                echo "</ul>";
                echo "</div>";

                echo "<div class='content'>";
                echo "<div id='ultimate'>";
                echo "<p>Estado</p>";
                echo "</div>";
                echo "<ul>";
                echo "<select name='state' id='state' class='form-control' required style='display: center; color: white; background-color: #333;'>";
                echo "<option value=''>Seleccione Estado</option>";
                echo "<option value='Enviado'>Enviado</option>";
                echo "<option value='Cancelado'>Cancelado</option>";
                echo "</select>";
                echo "</ul>";
                echo "</div>";
                echo "<div class='content'>";
                echo "<div id='ultimate'>";
                echo "<p>Observaciones de cierre</p>";
                echo "</div>";
                echo "<ul>";
                echo "<textarea class='form-control' name='observacionesCierre' placeholder='observacionesCierre' style='display: center; color: white; background-color: #333;'>";
                echo "</textarea>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";
                echo "<input name='orden' value='" . $service->getOrder()->getId() . "' hidden>";
                echo "<input name='idService' value='" . $service->getIdClaro() . "' hidden>";
                echo "<input class='boton_personalizado' value='cerrar &raquo' type='submit' onclick = \"this.form.action = '" . URL::to('SpecificService/updateSpectService') . "'\">";
                echo "</div>";
            }
            /* header('content-type: text/plain');
                print_r($service); */
            if ($service->order->getLink() != "") {
                echo "<div class='whole link' style='margin: 8px'><a href='" . $service->order->getLink() . "' target='_blank' /*class='boton formaBoton color'*/ >";
                echo "<div class='type ' id='percho'>";
                echo "<p>LINK DRIVE OT</p>";
                echo "</div>";
                echo "<div class='drive' >";
                echo "<p><i><u>Orden Drive</u></i></p>";
                echo "</div>";
                echo "<div class='plan'>";
                echo "</div>";
                echo "</a></div>";
            }

            echo "<div class='whole' style='margin: 8px'>";
            echo "<div class='type' id='percho'>";
            echo "<p>estado</p>";
            echo "</div>";
            echo "<div id='" . $service->getEstado() . "'>";
            echo "<p>" . $service->getEstado() . "</p>";
            echo "</div>";
            echo "<div class='plan'>";
            echo "</div>";
            echo "</div>";

            if ($service->getCRQ() != "") {
                echo "<div class='whole' style='margin: 8px'>";
                echo "<div class='type' style='margin-top: 15px' id='percho'>";
                echo "<p>CRQ</p>";
                echo "</div>";
                echo "<div id='" . $service->getEstado() . "'>";
                echo "<p>" . $service->getCRQ() . "</p>";
                echo "</div>";
            }
            ?>
        </form>
    </div><br><br>
</body>

