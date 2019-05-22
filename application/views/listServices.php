  <!-- modal stilo -->
  <link rel="stylesheet" href="<?= URL::to('assets/css/emergente.min.css'); ?>">
  <!-- boton -->
  <link href="<?= URL::to('assets/css/styleBoton.css'); ?>" rel="stylesheet" />
  <!-- menu sticky -->
  <link href="<?= URL::to('assets/css/styleMenuSticky.css'); ?>" rel="stylesheet" />
  <!-- checkbox -->
  <link href="<?= URL::to('assets/css/checkboxStyle.css'); ?>" rel="stylesheet" />
  <script type="text/javascript" charset="utf-8" async defer>
    //Funcion para mostrar mensaje de error de validacion de datos
    function modalEditar(servicio, orden, idIng, role){

      $('#orden').html("Orden: "+orden);
      
      var body = "";
    //------------------Tabla Modal------------------
    for (var i = 0; i < servicio.services.length; i++) {
      if (servicio.services[i].user.id == idIng || role == 0 || role == 4 || role == 5) {
        
        body += "<tr>";
        body += "<input type='hidden' name='ot' id='ot' value='"+orden+"'>";
        body += "<th><input type='checkbox' class='checkbox' name='checkbox[]' id= "+i+" value="+servicio.services[i].idClaro+" onclick='validarForm()'></th>";
      // body += "<th><input type='checkbox' name='checkbox' id= "+i+" value="+servicio.services[i].idClaro+" '></th>";
      body += "<td>"+servicio.services[i].idClaro+"</td>";
      // body += "<td>"+servicio.services[i].proyecto+"</td>";
      body += "<td><input class='form-control actData' id='serviceType' value='"+servicio.services[i].service.type+"'> </td>";
      body += "<td>"+servicio.services[i].quantity+"</td>";
      body += "<td>"+servicio.services[i].site.name+"</td>";
      body += "<td>"+servicio.services[i].user.name+" "+servicio.services[i].user.lastname+"</td>";
      body += "<td>"+ ((servicio.services[i].idDocumentador == 0) ? '' : docs_names[servicio.services[i].idDocumentador]) +"</td>";

      //
      //
      //
      //
      //
      //
      //
      //
      // body += "<td>"+(123)+"</td>"; ACÁ DEBO TRAER EL NOMBRE DE LOS DOCUMENTADORES
      //
      //
      //
      //
      //
      //
      //
      body += "<td><input type='date' size='20' class='form-control DStartP actData' id='dateStartP' value='"+servicio.services[i].dateStartP+"'> </td>";

      if (servicio.services[i].estado == 'Cancelado') {
        body += "<td><input type='date' size='20' class='form-control DStartP actData' id='dateStartP' value='"+servicio.services[i].dateStartP+"'> </td>";
      }else{
        body += "<td><input  type='date' class='form-control actData' id='dateFinishR' value='"+servicio.services[i].dateFinishR+"'> </td>";
      }
      body += "<td><input type='date' class='form-control actData' id='dateForecast' value='"+servicio.services[i].dateForecast+"'> </td>";
      body += "<td><input type='date' class='form-control actData' id='dateFinishClaro' value='"+servicio.services[i].dateFinishClaro+"'> </td>";
      body += "<td id='"+servicio.services[i].estado+"'>"+servicio.services[i].estado+"</td>";
      if (servicio.services[i].link1 == null || servicio.services[i].link1 == "") {
        body += "<td><input type='text' class='form-control miniInput actData' id='" + servicio.services[i].idClaro + "_lk1' name='" + servicio.services[i].idClaro + "_lk1' placeholder='evidencia 1'/></td>";
      } else {
        body += "<td><img src='"+baseurl+"/assets/img/check.png' alt='evidencia Enviada' width='35' title='evidencia Enviada'></td>";
      }
      if (servicio.services[i].link2 == null || servicio.services[i].link2 == "") {
        if (servicio.services[i].link1 == null || servicio.services[i].link1 == "") {
          body += "<td><input type='text' class='form-control miniInput' id='"+servicio.services[i].idClaro+"_lk2' name='"+servicio.services[i].idClaro+"_lk2' placeholder='evidencia 2' readonly='readonly'/>";
        } else {
          body += "<td><input type='text' class='form-control miniInput' id='" + servicio.services[i].idClaro + "_lk2' name='" + servicio.services[i].idClaro + "_lk2' placeholder='evidencia 2'/></td>";
        }
      } else {
        body += "<td><img src='"+baseurl+"/assets/img/check.png' alt='evidencia Enviada' width='35' title='evidencia Enviada'></td>";
      }
      body += "</tr>";
    }else{
      body += "<tr>";
      body += "<th> </th>";
      body += "<td>"+servicio.services[i].idClaro+"</td>";
      // body += "<td>"+servicio.services[i].proyecto+"</td>";
      body += "<td>"+servicio.services[i].service.type+"</td>";
      body += "<td>"+servicio.services[i].quantity+"</td>";
      body += "<td>"+servicio.services[i].site.name+"</td>";
      body += "<td>"+servicio.services[i].user.name+" "+servicio.services[i].user.lastname+"</td>";
      body += "<td>"+servicio.services[i].dateStartP+"</td>";
      if (servicio.services[i].estado == 'Cancelado') {
        body += "<td>"+servicio.services[i].dateStartP+"</td>";
      }else{
        body += "<td>"+servicio.services[i].dateFinishR+"</td>";
      }
      body += "<td>"+servicio.services[i].dateForecast+"</td>";
      body += "<td>"+servicio.services[i].dateFinishClaro+"</td>";
      body += "<td id='"+servicio.services[i].estado+"'>"+servicio.services[i].estado+"</td>";
      // si link 1 viene vacio = inpup sino imagen check
      if (servicio.services[i].link1 == null || servicio.services[i].link1 == "") {
        body += "<td><input type='text' class='form-control miniInput' id='" + servicio.services[i].idClaro + "_lk1' name='" + servicio.services[i].idClaro + "_lk1' placeholder='evidencia 1'/></td>";
      } else {
        body += "<td><img src='"+baseurl+"/assets/img/check.png' alt='sin enviar' width='35' title='Sin Enviar'></td>";
      }
      if (servicio.services[i].link2 == null || servicio.services[i].link2 == "") {
        if (servicio.services[i].link1 == null || servicio.services[i].link1 == "") {
          body += "<td><input type='text' class='form-control miniInput' id='"+servicio.services[i].idClaro+"_lk2' name='"+servicio.services[i].idClaro+"_lk2' placeholder='evidencia 2' readonly='readonly'/>";
        } else {
          body += "<td><input type='text' class='form-control miniInput' id='" + servicio.services[i].idClaro + "_lk2' name='" + servicio.services[i].idClaro + "_lk2' placeholder='evidencia 2'/></td>";
        }
      } else {
        body += "<td><img src='"+baseurl+"/assets/img/check.png' alt='evidencia Enviada' width='35' title='evidencia Enviada'></td>";
      }
      body += "</tr>";
    }
  }
  $('#body').html(body);
  $('#modalEvento').modal('show');

  validarFechasCierre(servicio.services[0].dateStartP);
  validarLink(servicio.link);
  cambiarFechas();
}

  function cambiarFechas(){
    $(".actData").on('blur',function(){
      const valChanged = $(this).val();
      const id = $(this).parents('td').siblings()[2].innerHTML;
      const campo = $(this).attr('id');
      console.log(id);
      console.log(campo);
      console.log(valChanged);
      const datosCambiados = new FormData();
      datosCambiados.append('id', id);
      datosCambiados.append('nombreCampo',campo);
      datosCambiados.append('cambio', valChanged);
        fetch(baseurl + "/SpecificService/UpdateInputs",{
        method:"POST",
        body: datosCambiados
        })
        .then(responsive => responsive.text());     
  })
}

  function validarFechasCierre(fechaAsig){

    $('#fInicior').on('change', function(){
       fechaAsig = new Date (fechaAsig);
       var fechaInicio = new Date ($('#fInicior').val());
       var fechaFin = new Date ($('#fFinr').val());

        if (fechaInicio.getTime() < fechaAsig.getTime() || fechaInicio.getTime() > fechaFin.getTime()) {
              $('#btn-enviar-modal').attr('disabled', 'true');
              swal('error', 'La fecha de Inicio  no puede ser menor a la de Asignación', 'error' );
              $('#adv').show(400);
        } 
        if (fechaInicio.getTime() > fechaAsig.getTime() && fechaInicio.getTime() <= fechaFin.getTime()) {
              $('#btn-enviar-modal').removeAttr("disabled");
              $('#adv').hide(400);
        }

        
    });

    $('#fFinr').on('change', function(){
       fechaAsig = new Date (fechaAsig);
       var fechaInicio = new Date ($('#fInicior').val());
       var fechaFin = new Date ($('#fFinr').val());

        if (fechaFin.getTime() < fechaAsig.getTime() || fechaInicio.getTime() > fechaFin.getTime()) {
              $('#btn-enviar-modal').attr('disabled', 'true');
              swal('error', 'La fecha final no puede ser menor a la de Asignación', 'error' );
              $('#adv').show(400);
        }
        if(fechaFin.getTime() > fechaAsig.getTime() && fechaInicio.getTime() <= fechaFin.getTime()){
              $('#btn-enviar-modal').removeAttr("disabled");
              $('#adv').hide(400);
        }

        // if (fechaInicio.getTime() > fechaFin.getTime()) {
        //   swal('error', 'La fecha de Inicio  no puede ser mayor a la de finalización', 'info' );
        //   $('#btn-enviar-modal').attr('disabled', 'true');
        //    $('#adv').show(400);
        // } else {
        //     $('#btn-enviar-modal').removeAttr("disabled");
        //       $('#adv').hide(400);
        // }

    });


  }


    //-------------Validar input link------------
    function validarLink(link){
      if (link != null && link != "") {
        var drive = document.getElementById('link');
        drive.disabled = true;
        drive.value = link;
      } else {
        var drive = document.getElementById('link');
        drive.disabled = false;
        drive.value = "";
      }
    }
    //-------------validar check para mostrar u ocultar formulario -------------
    function validarForm(){
      var checkboxs = document.getElementsByClassName('checkbox');
      var flag = 0;
    //Validar si algun check está marcado
    for (var i = 0; i < checkboxs.length; i++) {
      if (checkboxs[i].checked == true) {
        flag = 1;
      }
    }
    if (flag == 1) {
      mostrarForm();
    }
    else if (flag == 0) {
      ocultarForm();
    }
  }
    // Mostrar formulario del modal
    function mostrarForm(){
      var  form = document.getElementById('formulario');
      form.style.display = 'block';
    //Del form dejamos requeridos inputs
    // $('#fInicior').prop("required", true);
    // $('#fFinr').prop("required", true);
    // $('#state').prop("required", true);
    
    //Mostrar select segun el roll
    var roll = document.getElementById('session_role').value;
    if (roll == 4 || roll == 0) {
      var select = document.getElementById('reasignar');
      select.style.display = 'block';
    }
  }
    //Ocultar formulario del modal
    function ocultarForm(){
      var form = document.getElementById('formulario');
      form.style.display = 'none';
      document.getElementById('squaredTwo').checked = false;
      $('#fInicior').removeAttr("required");
      //ocultamos el select
      var select = document.getElementById('reasignar');
      select.style.display = 'none';

      $('#fInicior').val("");
      $('#fFinr').val("");
  }


  function quitarRequired(){
    $('#fInicior').removeAttr("required");
    $('#fFinr').removeAttr("required");
    $('#state').removeAttr("required");
  }
  //checkbox para marcar o desmarcar el resto de checkbox
  function marcar(source, id){
  checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
  for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
  {
  if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
  {
  checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
  validarForm(id);
}
}
}
function showMessage(mensaje){
  if(mensaje == "ok"){
    swal({
      title: "Bien hecho!",
      text: "Actividad asignada satisfactoriamente",
      type: "success",
      confirmButtonText: "Ok"
    });
  }
  if(mensaje == "error") {
    swal({
      title: "error!",
      text: "Actividades ya existentes ",
      type: "error",
      confirmButtonText: "Ok"
    });
  }
  if(mensaje == "no existe") {
    swal({
      title: "error!",
      text: "Actividades no existen ",
      type: "error",
      confirmButtonText: "Ok"
    });
  }
  if(mensaje == "no seleccionado") {
    swal({
      title: "No seleccionaste un ingeniero!",
      text: "intenta de nuevo ",
      type: "info",
      confirmButtonText: "Ok"
    });
  }
  if(mensaje == "actualizado") {
    swal({
      title: "Bien hecho!",
      text: "Actividades actualizadas satisfactoriamente\nCorreos enviados",
      type: "success",
      confirmButtonText: "Ok"
    });
  }
}
</script>
<body data-url="<?= URL::base(); ?>">
  <input type="hidden" id="session_id" value="<?= $_SESSION["id"] ?>"/>
  <input type="hidden" id="session_role" value="<?= $_SESSION["role"] ?>"/>
<br><br><br><br>
<div class="container center">
  <button type="button" class="btn btn-primary" id="proximos">Próximos </button><span id="proximosBadge" class="badge">...</span>
  <button type="button" class="btn btn-warning" id="hoy">Hoy <span id="hoyBadge" class="badge">...</span></button>
  <button type="button" class="btn btn-danger" id="expirados">Expirados <span id="expiradosBadge" class="badge">...</span></button>
</div>
<!-- <a href="<?= URL::to('Grafics/getGrafics'); ?>" data-toggle="tooltip" title="Ver Graficas"><img src="<?= URL::to('assets/img/grafics.gif'); ?>" alt="graficas"  class="botonIcon"></a> -->
<!-- menu sticky -->
<div class="contenedor closed" id="content_fixed">
  <div id="btn_fixed" >
    <span class="rotate-90 text">
      <i class="glyphicon glyphicon-chevron-up"></i><span style="margin-left: 10px;">Ver menú</span>
    </span>
  </div>
  <div class="hidden" id="menu_fixed">
    <span id="btn_close_fixed">
      <i class="glyphicon glyphicon-chevron-right"></i> Cerrar
    </span>
    <a href="#section_transport" class="boton" id="Transporte">TRANSPORTE</a>
    <a href="#section_GDATOS" class="boton" id="GDatos">GDATOS</a>
    <div class="menu-fixed">
      <ul>
        <li class="total" title="progreso total de la orden"><span>% Total Progreso</span></li>
        <li class="ejecutado" title="ejecutadas de la orden"><span>% ejecutadas</span></li>
        <li class="enviado" title="enviadas de la orden"><span>% enviadas</span></li>
        <li class="cancelado" title="canceladas de la orden"><span>% cancelado</span></li>
      </ul>
    </div>
  </div>
</div>
<!-- menu sticky 2 Rporte -->
<div class="contenedor2 closed2" id="content_fixed2">
  <div id="btn_fixed2" >
    <span class="rotate-902 text2">
      <i class="glyphicon glyphicon-chevron-up"></i><span style="margin-left: 10px;"> Reportes</span>
    </span>
  </div>
  <div class="hidden" id="menu_fixed2">
    <span id="btn_close_fixed2">
      <i class="glyphicon glyphicon-chevron-right"></i> Cerrar
    </span>
    <a href="<?= URL::to('Report/totalReport?id='.$_SESSION["id"].'&&role='.$_SESSION["role"].''); ?>" class="boton2" id="total">TOTAL</a>
    <a href="<?= URL::to('Report/thisMonthReport?id='.$_SESSION["id"].'&&role='.$_SESSION["role"].'&anio='.date('Y')); ?>" class="boton2" id="esteMes">Total este Mes</a>
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle boton2 btnPorMes" type="button" id="porMes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Por Mes</button>
      <div class="dropdown-menu per" aria-labelledby="dropdownMenuButton" id="boxPorMes">
      <!-- ****************************CAMBIOS***************** -->
      <!-- SE LLENA DINAMICAMENTE -->
      </div>
      
    </div>
    <?php
    if ($_SESSION["role"] == 4) {

      echo '<div class="dropdown">';
      echo '<button class="btn btn-secondary dropdown-toggle boton2" type="button" id="porMes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PROYECCIÓN</button>';
      echo '<div class="dropdown-menu per" aria-labelledby="dropdownMenuButton">';
      echo '<a class="mes" href="'.URL::to("Report/billing_report?mesSel=01").'">Enero</a>';
      echo '<a class="mes" href="'.URL::to("Report/billing_report?mesSel=02").'">Febrero</a>';
      echo '<a class="mes" href="'.URL::to("Report/billing_report?mesSel=03").'">Marzo</a>';
      echo '<a class="mes" href="'.URL::to("Report/billing_report?mesSel=04").'">Abril</a>';
      echo '<a class="mes" href="'.URL::to("Report/billing_report?mesSel=05").'">Mayo</a>';
      echo '<a class="mes" href="'.URL::to("Report/billing_report?mesSel=06").'">Junio</a>';
      echo '<a class="mes" href="'.URL::to("Report/billing_report?mesSel=07").'">Julio</a>';
      echo '<a class="mes" href="'.URL::to("Report/billing_report?mesSel=08").'">Agosto</a>';
      echo '<a class="mes" href="'.URL::to("Report/billing_report?mesSel=09").'">Septiembre</a>';
      echo '<a class="mes" href="'.URL::to("Report/billing_report?mesSel=10").'">Octubre</a>';
      echo '<a class="mes" href="'.URL::to("Report/billing_report?mesSel=11").'">Noviembre</a>';
      echo '<a class="mes" href="'.URL::to("Report/billing_report?mesSel=12").'">Diciembre</a>';
      echo '</div>';
      echo '</div>';
    }
    ?>
<!--  <div class="menu-fixed2">
<ul>
<li class="total2" title="progreso total de la orden"><span>% Total Progreso</span></li>
<li class="ejecutado2" title="ejecutadas de la orden"><span>% ejecutadas</span></li>
<li class="enviado2" title="enviadas de la orden"><span>% enviadas</span></li>
<li class="cancelado2" title="canceladas de la orden"><span>% cancelado</span></li>
</ul>
</div> -->
</div>
</div>
<!-- Modal tabla actividades por entregar-->
<div class="modal fade" id="ModalEventosProximos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style= "z-index: 100000">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?= URL::to('assets/img/close.ico'); ?>" alt="cerrar" class="modalImage" ></button>
        <h4 class="modal-title" id="titleEvent">Modal tabla vencidas</h4>
      </div>
      <div class="modal-body" id="cuerpoModal">
        <table id="tableEventosPrioritarios" class='table_cr table-hover table-striped table ' width='100%'>
        </table>
      </div>
      <div class="modal-footer">
        <h4 class="foot">Zolid By ZTE Colombia | All Right Reserved</h4>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar  <i class="glyphicon glyphicon-chevron-up"></i></button>
      </div>
    </div>
  </div>
</div>
<!--========================================= tabla transporte =========================================-->
<?php
if ($_SESSION["role"] == 1 || $_SESSION["role"] == 3 || $_SESSION["role"] == 4 || $_SESSION["role"] == 7) {
  // echo "<div style='display: block; padding-top: 40px' id='section_transport'></div><div class='container-fluid'>";
  echo "<br><br>";
//<!-- /.box-header -->
  echo "<div class='box-body' style='margin: 0px 38px;'>";
  echo "<center>";
  echo "<legend >Lista de actividades TRANSPORTE</legend>";
  echo "</center>";
  echo "<table id='tableTransport' class='table-hover table_cr table table-striped' width='100%'>";
  echo "</table>";
  echo "</div>";
  echo "</div>";
//
//   //===================================<!-- fin tabla transporte ===================================-->
}
if ($_SESSION["role"] == 2 || $_SESSION["role"] == 3 || $_SESSION["role"] == 4 || $_SESSION["role"] == 7) {
//   //========================================<!-- tabla gdatos========================================-->
  echo "<div id='section_GDATOS'></div><br><br><br>";
  echo "<div>";
//       //<!-- /.box-header -->
  echo "<div class='box-body' style='margin: 0px 38px;'>";
  echo "<center>";
  echo "<legend>Lista de actividades GDATOS</legend>";
  echo "</center>";
  echo "<table id='tableGDATOS' class='table_cr table  table-hover table-striped'>";
  echo "</table>";
  echo "</div>";
  echo "</div>";
//        //===================================<!-- fin tabla GDATOS ===================================-->
}
?>




<!-- Modal -->
<form method="post" action="" id="formularioModal" class="well form-horizontal">
  <form method="post">
    <div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" onclick="ocultarForm()" aria-label="Close"><span aria-hidden="true"><i class='glyphicon glyphicon-eye-close'></i> cerrar</span></button>
            <h1 class="modal-title">Detalles del Evento</h1>
            <h4 id="orden"></h4>
          </div>
          <div class="container">
            <div class="modal-body">
              <h3 class="subtitulo">Tabla Actividades</h3>
              <table id='tablaActividades' class='table-hover table_cr table table-striped'>
                <thead>
                  <tr>
                    <th>
                      <div class="squaredTwo">
                        <input type="checkbox" value="None" id="squaredTwo" class="checkbox" name="checkbox" onclick="marcar(this);" />
                        <label for="squaredTwo"></label>
                      </div>
                    </th>
                    <th>Id actividad</th>
                    <!-- <th>Proyecto</th> -->
                    <th>Tipo</th>
                    <th>Cant.</th>
                    <th>Estación base</th>
                    <th>Ingeniero Asignado</th>
                    <th>Documentador Asignado</th>
                    <th>F. Asignación</th>
                    <th>Fecha Cierre </th>
                    <th>F. Forecast</th>
                    <th>F. Ejecución</th>
                    <th>estado</th>
                    <th>Link Envio 1</th>
                    <th>Link Envio 2</th>
                  </tr>
                </thead>
                <tbody name="body" id="body">
                </table>
                <input type="button" id="btn_actualizar_links" value="Actualizar Evidencia">
              </div>
                <!-- if ($_SESSION["role"] == 0 || $_SESSION["role"] == 4) { -->
              <div style='transition: 2s; display: none;background-color: #fafafa;width: 97%;border-radius: 19px;border: 1px solid #f0f0f0; margin: 15px 16px;' id='reasignar' class="container">
                <h3 class="subtitulo">Reasignar Actividades</h3>
                <div class='row-fluid'>
                  <div class='input-group'>
                    <span class='input-group-addon'><i class='glyphicon glyphicon-user'></i></span>
                    <select class='selectBre' name='Ingeniero' data-show-subtext='true' data-live-search='true'  data-width='80%'>
                      <option value=''>Seleccione Ingeniero</option>
                      <optgroup label="Transporte  GDRT">
                        <option value="80158472" class="ing"><b>Andres Alberto Rubio Idrobo</b></option>
                        <option value="1032364958"><b>Cesar David Duran Alvarez</b></option>
                        <option value="1022350779"><b>Giovanny Reyes Torres</b></option>
                        <option value="80392886"><b>Juan Carlos Olmos Bonilla</b></option>
                        <option value="5166463"><b>Jhon Erik Gamez Gonzales</b></option>
                        <option value="1013638956"><b>Charlinne Yessenia Suarez Medina</b></option>
                        <option value="1014251868"><b>Marcela Fernanda Herrera Quila</b></option>
                        <option value="80160305"><b>Miguel Angel Moreno Alarcon</b></option>
                        <option value="72265383"><b>Jaime Luis Escobar De Los Reyes</b></option>

                        <option value="1015465171"><b>Juan Camilo Aranda Martinez</b></option>
                        <option value="1019053842"><b>Andres Felipe Cifuentes Soto</b></option>
                        <option value="79514291"><b>Edgar Ramirez Pardo</b></option>
                      </optgroup>
                      <optgroup label="GDATOS  GDRCD">
                        <option value="1070916624"><b>Daniel Guillermo Reyes Prieto</b></option>
                        <option value="1012399862"><b>Jhon Fredy Novoa</b></option>
                        <option value="80831884"><b>Juan Carlos Estevez Rojas</b></option>

                        <option value="1023919425"><b>Juri Andrea Pita Correa</b></option>
                        <option value="1026284286"><b>Alvaro Agudelo Bayona</b></option>
                        <option value="79615710"><b>Freddy Carlos Peña Moreno</b></option>
                        <option value="1070951857"><b>Oscar Leonardo Gomez Ramirez</b></option>
                      </optgroup>
                      <optgroup label="Ingeniero Claro">
                        <option value="1"><b>Jhon Alejandro Salazar Tapasco</b></option>
                        <option value="10"><b>Lina Marcela Duque Morales</b></option>
                        <option value="1065631508"><b>Julián Camilo Durán Hernández</b></option>
                        <option value="11"><b>Luis Mauricio Gomez Arias</b></option>
                        <option value="12"><b>Luis Gabriel Pineda Gomez</b></option>
                        <option value="13"><b>Luis Carlos Mejia Ahumada</b></option>
                        <option value="14"><b>Oscar Javier Barbosa Cuellar</b></option>
                        <option value="15"><b>Oscar Eduardo Otero Flores</b></option>
                        <option value="16"><b>Vivian Lorena Plazas Riano</b></option>
                        <option value="17"><b>Yolanda Cortes Gil</b></option>
                        <option value="18"><b>Eduardo Martinez</b></option>
                        <option value="19"><b>Guillermo Riaño</b></option>
                        <option value="2"><b>Andres Hernandez</b></option>
                        <option value="20"><b>r Riano</b></option>
                        <option value="21"><b>Diego Velez</b></option>
                        <option value="3"><b>Carlos Andres Tovar Piraban</b></option>
                        <option value="4"><b>Henry Ledesma</b></option>
                        <option value="5"><b>Javier Pineda Lopez</b></option>
                        <option value="52700033"><b>Sandra Paola Varón García</b></option>
                        <option value="6"><b>Jhon Vicente Salgado Rodriguez</b></option>
                        <option value="7"><b>Johann Smit Orozco Larrota</b></option>
                        <option value="8"><b>Jorge Anibal Hernandez Rodriguez</b></option>
                        <option value="80158472"><b>Andres Alberto Rubio Idrobo</b></option>
                        <option value="9"><b>Jose Zambrano</b></option>
                      </optgroup>
                      <optgroup label="Ingeniero Datafill Seguimiento">
                        <option value="1019101659"><b>Maria Fernanda Abello Forero</b></option>
                        <option value="1074415450"><b>Luis Alberto Guzman Gonzales</b></option>
                        <option value="17653787"><b>Leonardo Alberto Conde Torres</b></option>
                        <option value="94499841"><b>Diego Javier Arboleda Loaiza</b></option>
                      </optgroup>
                    </select>
                    
                    <button style='margin-left: 20px;' type='submit' class='btn btn-success'  onclick="quitarRequired(); this.form.action='<?= URL::to('SpecificService/reasign'); ?>'">Reasignar</button>
                  </div>

                  <div class='input-group'>
                    <!-- <?php /*print_r*/($list_docs) ?> -->
                    <span class='input-group-addon'><i class='glyphicon glyphicon-user'></i></span>
                    <select class='selectBre' name='Documentador' id="Documentador" data-show-subtext='true' data-live-search='true'  data-width='80%'>
                      <option value=''>Seleccione Documentador</option>
                      <?php
                      for ($i=0; $i <count($list_docs) ; $i++) { 
                        echo '<option value="'. $list_docs[$i]->K_IDUSER . '">'. $list_docs[$i]->nombres .'</option>';
                      }
                      ?>
                    </select>
                    
                    <button style='margin-left: 20px;' type='submit' class='btn btn-success'  onclick="quitarRequired(); this.form.action='<?= URL::to('SpecificService/reasignardocumentador'); ?>'">Reasignar documentador</button>
                  </div>


                </div>

                <br><br>

              </div>
            </form>
            <div class="container" style="display: none;background-color: #fafafa;width: 97%;border-radius: 19px;border: 1px solid #f0f0f0;" id="formulario">
              <h3 class="subtitulo">Cerrar Actividades</h3>
              <fieldset>
                <div class="widget bg_white m-t-25 display-block">
                  <fieldset class="col-md-6 control-label">
                    <div class="form-group" >
                      <label class="control-label col-md-3" for="link">Link Drive de la Orden : &nbsp;</label>
                      <div class="col-sm-8" id="enlace">
                        <input type="input" class="form-control m-b-5" id="link" placeholder="Link Drive de la Orden" name="link" >
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label class="control-label col-md-3" for="fInicior">Fecha Inicio Real: &nbsp;</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control m-b-5" id="fInicior" placeholder="Fecha Inicio Real" name="fInicior" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" for="fFinr">Fecha Fin Real: &nbsp;</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control m-b-5" id="fFinr" placeholder="Fecha Fin Real" name="fFinr" >
                      </div>
                    </div> -->
                    <div class="form-group" style="display: flex;">
                        <label class="col-md-3 control-label" for="fInicior">Fecha Inicio Real:</label>
                        <div class="col-md-8 selectContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar "></i></span>
                                <input type='date' name="fInicior" id="fInicior" class="form-control" value="" required>
                                <div class="input-group-btn">
                                    <button type="button" id="btnTodayDateIni" class="btn btn-primary" title="Fecha Actual"><i class="glyphicon glyphicon-calendar"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="display: flex;">
                        <label class="col-md-3 control-label" for="fFinr">Fecha Fin Real:</label>
                        <div class="col-md-8 selectContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar "></i></span>
                                <input type='date' name="fFinr" id="fFinr" class="form-control" value="" required>
                                <div class="input-group-btn">
                                    <button type="button" id="btnTodayDateFin" class="btn btn-primary" title="Fecha Actual"><i class="glyphicon glyphicon-calendar"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="advertencia" style="display: none;" id="adv"><i class="glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp; verifica las fechas</span>
                  </fieldset>
                  <fieldset>
                    <div class="form-group">
                      <label class="control-label col-md-3" for="crq">CRQ: &nbsp;</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control m-b-5" id="crq" placeholder="CRQ" name="crq">
                      </div>
                    </div>
                    <div class="form-group m-b-5">
                      <label class="control-label col-md-3" for="state">Estado: &nbsp;</label>
                      <div class="col-sm-8">
                        <select class="form-control m-b-5" id="state" name="state" >
                          <option value="">seleccione estado</option>
                          <option value="Enviado">Enviado</option>
                          <option value="Cancelado">Cancelado</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group m-b-5">
                      <label class="control-label col-md-3" for="observacionesCierre">Observaciones de Cierrre: &nbsp;</label>
                      <div class="col-sm-8">
                        <textarea class="form-control m-b-5" rows="2" id="observacionesCierre" name="observacionesCierre" placeholder="Observaciones de Cierre"></textarea>
                      </div>
                    </div>
                    <br>
                    <div class="form-group m-b-5">
                      <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" id="btn-enviar-modal" class="btn btn-success btn-block" onclick="this.form.action='<?= URL::to('SpecificService/updateSpectService'); ?>'">Enviar</button>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </fieldset>
            </div>
          </tbody>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-info btn-block" id="btnCerrarModal" data-dismiss="modal">CERRAR</button> -->
        </div>
      </div>
    </div>
  </div>
</form>

<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script> -->
<?php
$r = time();
if (isset($message)) {
  echo '<script type="text/javascript">showMessage("'.$message.'");</script>';
}
?>
<script>
  $('#btnTodayDateIni').on('click', function(){
    var hoy = formatDate(new Date());
    var fecha =  $('#fInicior');
    fecha.val(hoy);
  });
  $('#btnTodayDateFin').on('click', function(){
    var hoy = formatDate(new Date());
    var fecha =  $('#fFinr');
    fecha.val(hoy);
  });

  function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
  }



  $(function(){
    $("#btn_actualizar_links").click(function(){
      $.ajax({
        type: "POST",
        url: baseurl + "/SpecificService/updateLinkFormModal",
      data: $("#formularioModal").serialize(), // Adjuntar los campos del formulario enviado.
      success: function(data){
        var obj = JSON.parse(data);
        $.each(obj,function(i,item){
          $("#"+item).parent().html("<img src='"+baseurl+"/assets/img/check.png' alt='evidencia Enviada' width='35' title='evidencia Enviada'>");
        });
      }
      });
      return false; // Evitar ejecutar el submit del formulario.
    });
  });
</script>
<script type="text/javascript"> 
  const list_docs = '<?php echo json_encode($list_docs); ?>';
  const docs_name = JSON.parse(list_docs);
  const docs_names = {};
  $.each(docs_name, function(i, item) {
     docs_names[item.K_IDUSER] = item['nombres'];
  });

  var baseurl = "<?php echo URL::base(); ?>";
  var rol = "<?php echo $_SESSION["role"] ?>";
  var id_usuario = "<?php echo $_SESSION["id"] ?>";
</script>
<!-- llenar tablas -->
<script type="text/javascript" src="<?= URL::to("assets/js/services/listServices.js?v=25"); ?>"></script>
<!-- alertas de proximidad de tiempo -->
<script type="text/javascript" src="<?= URL::to('assets/js/services/ModalTiempos.js'); ?>"></script>
</body>