$(function() {
    ordenModer = {
        init: function() {
            ordenModer.events();
            ordenModer.getList_moderDetail();
        },
        ids_form: 0,
        alertaModal: false,
        cleanModal: function(){
            $("#mdl-form").removeClass("este");
            $(".d-if div.p15 input, .d-if div.p15 select").css({"border-color":"#d2d6de","background":"white"}); // PARA CUANDO SE CIERRE EL MODAL, TODOS LOS BORDES QUEDEN DEL COLOR PREDETERMINADOS Y NO ROJOS
            $("#updateModer")[0].reset();
            $("div.showAlert").addClass("alertCI");
            $("div.showAlert").removeClass("showAlert");
        },
        //Eventos de la ventana.
        events: function() {
            $('#edModer').click(ordenModer.form_modal);
            $('#tabla_ordenAsoc').on('click', 'a.opc-orden', ordenModer.modalSolo);
            $('#mdl-moder-send').on('click', ordenModer.getUpdates);
            $("div.tit").on("click",function(){
                const div = $(this);
                ordenModer.animacionPlaceholder(div);
            });
            $("input.clickx").on("focus",function(){
                const div = $(this).siblings("div.tit");
                ordenModer.animacionPlaceholder(div);
            });
            $("button.close").on("click",ordenModer.cleanModal);
            $("button.Cancelar").on("click",ordenModer.cleanModal)
        },

        getList_moderDetail: function() {
            //metodo ajax (post)
            $.post(baseurl + '/Modernizaciones/c_getOrdenDetailsModerById',
                    {
                        idOrden: idOrden
                    },
                    // función que recibe los datos
                            function(data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                ordenModer.printTableModer(obj);
                            }
                    );
                },

        printTableModer: function(data) {
            ordenModer.tabla_ordenAsoc = $('#tabla_ordenAsoc').DataTable(ordenModer.configTableModer(data, [
                {title: "OT", data: "K_IDORDER"},
                {title: "Tipo", data: "tipo_orden"},
                {title: "Trabajo", data: "trabajo"},
                {title: "Id", data: "id"},
                {title: "Tipo Tecnologia", data: "tipo_tecnologia"},
                {title: "Fecha Cierre Ingeniero", data: "f_cierre_ing"},
                {title: "opc", data: ordenModer.getButtons},
            ]));
        },

        // Datos de configuracion del datatable
        configTableModer: function(data, columns, onDraw) {
            return {
                data: data,
                columns: columns,
                "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json"
                },
                dom: 'Blfrtip',
                buttons: [
                    {
                        text: 'Excel <span class="fa fa-file-excel-o"></span>',
                        className: 'btn-cami_cool',
                        extend: 'excel',
                        title: 'ZOLID EXCEL',
                        filename: 'zolid ' + fecha_actual
                    },
                    {
                        text: 'Imprimir <span class="fa fa-print"></span>',
                        className: 'btn-cami_cool',
                        extend: 'print',
                        title: 'Reporte Zolid',
                    }
                ],
                select: true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                ordering: true,
                columnDefs: [{
                        // targets: -1,
                        // visible: false,
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[1, 'asc']],
                drawCallback: onDraw
            }
        },

        getButtons: function(obj) {
            var botones = "<div class='btn-group-vertical'>"
                    + "<a style='padding: 2px 3px 5px 5px;' class='btn btn-default btn-xs opc-orden btn_datatable_cami' data-btn='hito' title='Ver Asociadas'><span class='glyphicon glyphicon-edit'></span></a>"
                    + "</div>";
            return botones;
        },

        // funciones para modal de unico registro
        modalSolo: function(e){
            var aMod = $(this);
            var trParent = aMod.parents('tr');
            var record = ordenModer.tabla_ordenAsoc.row(trParent).data();
            ordenModer.postModer(record.id_moder);

        },


        // funciones para el modal
        form_modal: function(e){
            const hay_sel = ordenModer.tabla_ordenAsoc.rows({selected: true}).any();// booleanos q indica si hay algo seleccionado
            if (hay_sel) {
                const seleccionadas = ordenModer.tabla_ordenAsoc.rows({selected: true}).data();// los datos de los elem seleccionados
                const cuantas = ordenModer.tabla_ordenAsoc.rows( { selected: true } ).count();
                const id_modernizaciones = [];

                for (var i = 0; i < cuantas; i++) {
                    id_modernizaciones.push(seleccionadas[i].id_moder);
                }

                ordenModer.postModer(id_modernizaciones);


            } else {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000
                });
                toast({
                    type: 'error',
                    title: 'No seleccionaste ninguna fila!'
                });
            }
            
        },
        //
        postModer: function(id_modernizaciones){
             $.post( baseurl + '/Modernizaciones/js_getModer', 
                    {
                        mds: id_modernizaciones
                    }, 
                    function(data) {
                        const obj = JSON.parse(data);
                        if (obj.length > 1) {
                            ordenModer.fillModal(obj);
                        } else {
                            ordenModer.fillModal(obj, true);
                        } 
                    }
                );
        },

        // llenar el modal
        fillModal: function(obj, unic = false){
           if (unic) {
               $("#mdl-form").addClass("este");
               ordenModer.llenarModalUnico(obj)
            } else {
                $("#mdl-form").addClass("este");
                ordenModer.llenarModalVarios(obj)
           }
        },
        //
        llenarModalUnico: function(obj){
            ordenModer.llenarNoEditables(ss)
            // console.log(ss); // ss Valores no editables
            $("#alertCI").css("display","none");
            $.each(obj[0], function(i, item) {
                $('#' + i).val(item); // ESTA FUNCIÓN SE USA PARA RECORRER CADA INPUT Y LLENARLO RESPECTIVAMENTE
                if(item != "" || item != null){
                    const div = $('#' + i).siblings("div.tit")
                    ordenModer.animacionPlaceholder(div);
                }
            });
            ordenModer.ids_form = obj[0].id_moder;
            ordenModer.alertaModal = false;

        },

        arrayColumn: function(array, columnName){
            return array.map(function(value,index) {
                return value[columnName];
            })
        },
        //

        llenarModalVarios: function(obj){
            ordenModer.ids_form = ordenModer.arrayColumn(obj, 'id_moder');
            ordenModer.alertaModal = true;
            ordenModer.llenarNoEditables(ss);
            //Función para la animación del placeholder
            $.each(obj[0], function(i, item) {
                if(item != "" || item != null){
                    const div = $('#' + i).siblings("div.tit")
                    ordenModer.animacionPlaceholder(div);
                }
            });
            var tipo_orden1 = [] , trabajo1 = [] , tipo_tecnologia1 = [] , f_cierre_ing1 = [] , ingeniero1 = [] , in_service_sitio1 = [] , f_ingreso_servicio_claro1 = [] , estado_tx1 = [] , fecha_tx_lista1 = [] , estado_cw1 = [] , fecha_cw_lista1 = [] , rfe1 = [] , estado_df1 = [] , fecha_df1 = [] , rfic1 = [] , rfi1 = [] , estado_instalacion1 = [] , fecha_instalacion1 = [] , estado_integracion1 = [] , fecha_integracion1 = [] , estado_onair1 = [] , fecha_inservice1 = [] , contratista_cw1 = [] , mes_inservice1 = [] , anio_inservice1 = [] ;
            $.each(obj,function(i,item){
            tipo_orden1[i] = item["tipo_orden"];    trabajo1[i] = item["trabajo"];
            tipo_tecnologia1[i] = item["tipo_tecnologia"];  f_cierre_ing1[i] = item["f_cierre_ing"];
            ingeniero1[i] = item["ingeniero"];  in_service_sitio1[i] = item["in_service_sitio"];
            f_ingreso_servicio_claro1[i] = item["f_ingreso_servicio_claro"];    estado_tx1[i] = item["estado_tx"];
            fecha_tx_lista1[i] = item["fecha_tx_lista"];    estado_cw1[i] = item["estado_cw"];
            fecha_cw_lista1[i] = item["fecha_cw_lista"];    rfe1[i] = item["rfe"];
            estado_df1[i] = item["estado_df"];fecha_df1[i] = item["fecha_df"];
            rfic1[i] = item["rfic"];    rfi1[i] = item["rfi"];
            estado_instalacion1[i] = item["estado_instalacion"];    fecha_instalacion1[i] = item["fecha_instalacion"];
            estado_integracion1[i] = item["estado_integracion"];    fecha_integracion1[i] = item["fecha_integracion"];
            estado_onair1[i] = item["estado_onair"];    fecha_inservice1[i] = item["fecha_inservice"];
            contratista_cw1[i] = item["contratista_cw"];    mes_inservice1[i] = item["mes_inservice"];
            anio_inservice1[i] = item["anio_inservice"];
            });
            var array = [];
            array[0] = tipo_orden1;
            array[1] = trabajo1;
            array[2] = tipo_tecnologia1;
            array[3] = f_cierre_ing1;
            array[4] = ingeniero1;
            array[5] = in_service_sitio1;
            array[6] = f_ingreso_servicio_claro1;
            array[7] = estado_tx1;
            array[8] = fecha_tx_lista1;
            array[9] = estado_cw1;
            array[10] = fecha_cw_lista1;
            array[11] = rfe1;
            array[12] = estado_df1;
            array[13] = fecha_df1;
            array[14] = rfic1;
            array[15] = rfi1;
            array[16] = estado_instalacion1;
            array[17] = fecha_instalacion1;
            array[18] = estado_integracion1;
            array[19] = fecha_integracion1;
            array[20] = estado_onair1;
            array[21] = fecha_inservice1;
            array[22] = contratista_cw1;
            array[23] = mes_inservice1;
            array[24] = anio_inservice1;
            var campos = Object.keys(obj[0]);
            campos.splice(0,2); campos.splice(2,1);
            ordenModer.valFiltro(array,campos);
            if(alertCamposIguales){
                $("div.alertCI").addClass("showAlert");
                $("div.alertCI").removeClass("alertCI");
            }
        },
        //VALFILTRO Y FILTAR VERIFICAN SI LOS CAMPOS SELECCIONADOS SON IGUALES EN TODAS LAS FILAS O NO
        valFiltro: function(arreglo,valores){
            $.each(arreglo,function(i){
                if(ordenModer.filtrar(arreglo[i])){
                    $('#'+valores[i]).val(arreglo[i][0]);

                    // console.log(valores[i]," : SI")
                }else{
                    alertCamposIguales = true;
                    $('#'+valores[i]).css({"border-color":"red", "background":"floralwhite"});
                    // console.log(valores[i]," : NO")
                }
            })
        },
        filtrar: function(arreglo){
            const equal = arreglo.filter(function(item, index, array){
                return array.indexOf(item) === index;
            });
            if (equal.length === 1) {
                return true;
            } else {
                return false;
            }
        },
        //LLENA LOS QUE NO SON EDITABLE
        llenarNoEditables: function(noEditable){
            $("#ot").val(noEditable[0]);
            $("#actividad").val(noEditable[1]);
            $("#sitio").val(noEditable[2]);
            $("#f_asignacion").val(noEditable[3]);
            $("#f_ejecucion_claro").val(noEditable[4]);
            $("#estado").val(noEditable[5]);
            $("#proyecto").val(noEditable[6]);
            $("#f_forecast").val(noEditable[7]);
            $("#f_creacion").val(noEditable[8]);
            $("#solicitante").val(noEditable[9]);
            $("#region").val(noEditable[10]);
        },
        //animación para los input, si estan vacíos
        animacionPlaceholder: function(div){
            div.addClass("tit2");
            const titulo = div.children("label")
            titulo.removeClass("pdown").addClass("pdown2");
            const input = div.siblings("input.clickx");
            input.attr("placeholder","");
            input.blur(function(){
                if(input.val()==""||input.val()==null|| input.val()==" " || input.val()=="  "){
                    div.removeClass("tit2");
                    titulo.removeClass("pdown2").addClass("pdown");
                    input.attr("placeholder",titulo.html());
                };
            })
        },

        //AQUÍ IRÁ LA RECOLECCIÓN DE INFORMACIÓN DE LOS CAMPOS  PARA LUEGO PASARLOS POR LA FUNCION DE ACTUALIZACIÓN
        getUpdates: function(){
            if(ordenModer.alertaModal == true){
                Swal({
                    title: '¿Seguro que desea continuar?',
                    text: "se editará la información de las filas seleccionadas",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'green',
                    cancelButtonColor: 'red',
                    confirmButtonText: 'Actualizar',
                    cancelButtonText: 'Cancelar'
                  }).then((booleano) => {
                    if (booleano.value == true) {
                        update();
                    }else{
                        swal("Actualización Cancelada","","info");
                    }
                  });
            }else{
                update();
            }

            function update(){
                var form = $("#updateModer").children();
                        form = form.children();
                        var inputs = form.children("input");
                        var selects = form.children("select");
                        var valoresInput = {};
                        var valoresSelect = {};
                        var cont = 0;
                        $.each(inputs, function(i,item){
                            valoresInput[inputs[i].id] = inputs[i].value;
                            while(cont < 7){
                                valoresSelect[selects[cont].id] = selects[cont].value;
                                cont++;
                            }
                        })
                        const updateData= {selects : valoresSelect, inputs : valoresInput};
                        //FUNCIÓN PARA LIMPIAR TODOS LOS CAMPOS QUE ESTÉN VACÍOS EN UN OBEJTO Y ASÍ NO SE REMPLACEN LOS CAMPOS VACÍOS
                        function clean(obj) { 
                            for (var propName in obj) { 
                                if (obj[propName] === null || obj[propName] === undefined || obj[propName] === "") { 
                                    delete obj[propName]; 
                                } 
                            } 
                        } 
                        clean(updateData.selects);clean(updateData.inputs);
                        $(".d-if div.p15 input, .d-if div.p15 select").css("border-color","#d2d6de");
                        ordenModer.updateModer(updateData); //<----- VA AL AJAX DE ACTUALIZACIÓN 
            }
        },
        //
        updateModer: function(cambios){
            $.post(baseurl + '/Modernizaciones/updateModer',
                {
                    updates : cambios,
                    ids :ordenModer.ids_form
                },
                function(data){
                    if(data){
                        swal("Actualización realizada con Éxito","" ,"success").then((result) => {
                            location.reload();
                        });
                    }else{
                        swal("Actualización realizada con Éxito","" ,"error");
                    }
                }
            );
        }
    }
    ordenModer.init();
});