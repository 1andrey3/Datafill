$(function() {
    ordenModer = {
        init: function() {
            ordenModer.events();
            ordenModer.getList_moderDetail();
        },
        ids_form: 0,
        alertaModal: false,
        cleanModal: function(){
            $("#mdl-form").removeClass("in").hide();
            $(".d-if div.p15 input, .d-if div.p15 select").css("border-color","#d2d6de");
            $("#updateModer")[0].reset();
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
               $("#mdl-form").addClass("in").show();
               ordenModer.llenarModalUnico(obj)
            } else {
                $("#mdl-form").addClass("in").show();
                $("button.close").on("click",function(){$("#mdl-form").removeClass("in").hide();})
                ordenModer.llenarModalVarios(obj)
           }
            
        },
        //
        llenarModalUnico: function(obj){
            ordenModer.llenarNoEditables(ss)
            console.log(obj);
            
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
            var alertCamposIguales = false;
            var tipo_orden = [] ;var trabajo = [] ;var id = [] ;var tipo_tecnologia = [] ;var f_cierre_ing = [] ;var ingeniero = [] ;var in_service_sitio = [] ;var f_ingreso_servicio_claro = [] ;var estado_tx = [] ;var fecha_tx_lista = [] ;var estado_cw = [] ;var fecha_cw_lista = [] ;var rfe = [] ;var estado_df = [] ;var fecha_df = [] ;var rfic = [] ;var rfi = [] ;var estado_instalacion = [] ;var fecha_instalacion = [] ;var estado_integracion = [] ;var fecha_integracion = [] ;var estado_onair = [] ;var fecha_inservice = [] ;var contratista_cw = [] ;var mes_inservice = [] ;var anio_inservice = [] ;
            $.each(obj,function(i,item){
                tipo_orden[i] = item["tipo_orden"];
                trabajo[i] = item["trabajo"];
                tipo_tecnologia[i] = item["tipo_tecnologia"];
                f_cierre_ing[i] = item["f_cierre_ing"];
                ingeniero[i] = item["ingeniero"];
                in_service_sitio[i] = item["in_service_sitio"];
                f_ingreso_servicio_claro[i] = item["f_ingreso_servicio_claro"];
                estado_tx[i] = item["estado_tx"];
                fecha_tx_lista[i] = item["fecha_tx_lista"];
                estado_cw[i] = item["estado_cw"];
                fecha_cw_lista[i] = item["fecha_cw_lista"];
                rfe[i] = item["rfe"];
                estado_df[i] = item["estado_df"];
                fecha_df[i] = item["fecha_df"];
                rfic[i] = item["rfic"];
                rfi[i] = item["rfi"];
                estado_instalacion[i] = item["estado_instalacion"];
                fecha_instalacion[i] = item["fecha_instalacion"];
                estado_integracion[i] = item["estado_integracion"];
                fecha_integracion[i] = item["fecha_integracion"];
                estado_onair[i] = item["estado_onair"];
                fecha_inservice[i] = item["fecha_inservice"];
                contratista_cw[i] = item["contratista_cw"];
                mes_inservice[i] = item["mes_inservice"];
                anio_inservice[i] = item["anio_inservice"];
            });
            var igual_tipoOrden = tipo_orden.filter(function(item2, index, array) {
                return array.indexOf(item2) === index;
            })
            if (igual_tipoOrden.length === 1) {
                $('#tipo_orden').val(obj[0]["tipo_orden"])
                // console.log("Campos de tipo orden IGUALES");
            }else{
                alertCamposIguales = true;
                $('#tipo_orden').css("border-color","red");
                // console.log("tipo orden NO IGUALES");
            }

            var igual_trabajo = trabajo.filter(function(item2, index, array) {
                return array.indexOf(item2) === index;
            })
            if (igual_trabajo.length === 1) {
                $('#trabajo').val(obj[0]["trabajo"])
                // console.log("Campos trabajo IGUALES");
            }else{
                alertCamposIguales = true;
                $('#trabajo').css("border-color","red");
                // console.log(" trabajo NO IGUALES");
            }

            var igual_tipo_tecnologia = tipo_tecnologia.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_tipo_tecnologia.length === 1) {
                $('#tipo_tecnologia').val(obj[0]["tipo_tecnologia"])
                // console.log("Campos tipo_tecnologia IGUALES");
            }else{
                alertCamposIguales = true;
                $('#tipo_tecnologia').css("border-color","red");
                // console.log(" tipo_tecnologia NO IGUALES");
            }

            var igual_f_cierre_ing = f_cierre_ing.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_f_cierre_ing.length === 1) {
                $('#f_cierre_ing').val(obj[0]["f_cierre_ing"])
                // console.log("Campos f_cierre_ing IGUALES");
            }else{
                alertCamposIguales = true;
                $('#f_cierre_ing').css("border-color","red");
                // console.log(" f_cierre_ing NO IGUALES");
            }

            var igual_ingeniero = ingeniero.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_ingeniero.length === 1) {
                $('#ingeniero').val(obj[0]["ingeniero"])
                // console.log("Campos ingeniero IGUALES");
            }else{
                alertCamposIguales = true;
                $('#ingeniero').css("border-color","red");
                // console.log(" ingeniero NO IGUALES");
            }

            var igual_in_service_sitio = in_service_sitio.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_in_service_sitio.length === 1) {
                $('#in_service_sitio').val(obj[0]["in_service_sitio"])
                // console.log("Campos in_service_sitio IGUALES");
            }else{
                alertCamposIguales = true;
                $('#in_service_sitio').css("border-color","red").val('');
                // console.log(" in_service_sitio NO IGUALES");
            }

            var igual_f_ingreso_servicio_claro = f_ingreso_servicio_claro.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_f_ingreso_servicio_claro.length === 1) {
                $('#f_ingreso_servicio_claro').val(obj[0]["f_ingreso_servicio_claro"])
                // console.log("Campos f_ingreso_servicio_claro IGUALES"); 
            }else{
                alertCamposIguales = true;
                $('#f_ingreso_servicio_claro').css("border-color","red");
                // console.log(" f_ingreso_servicio_claro NO IGUALES");
            }

            var igual_estado_tx = estado_tx.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_estado_tx.length === 1) {
                $('#estado_tx').val(obj[0]["estado_tx"])
                // console.log("Campos estado_tx IGUALES");
            }else{
                alertCamposIguales = true;
                $('#estado_tx').css("border-color","red").val('');
                // console.log(" estado_tx NO IGUALES");
            }

            var igual_fecha_tx_lista = fecha_tx_lista.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_fecha_tx_lista.length === 1) {
                $('#fecha_tx_lista').val(obj[0]["fecha_tx_lista"])
                // console.log("Campos fecha_tx_lista IGUALES");
            }else{
                alertCamposIguales = true;
                $('#fecha_tx_lista').css("border-color","red");
                // console.log(" fecha_tx_lista NO IGUALES");
            }

            var igual_estado_cw = estado_cw.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_estado_cw.length === 1) {
                $('#estado_cw').val(obj[0]["estado_cw"])
                // console.log("Campos estado_cw IGUALES");
            }else{
                alertCamposIguales = true;
                $('#estado_cw').css("border-color","red").val('');
                // console.log(" estado_cw NO IGUALES");
            }

            var igual_fecha_cw_lista = fecha_cw_lista.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_fecha_cw_lista.length === 1) {
                $('#fecha_cw_lista').val(obj[0]["fecha_cw_lista"])
                // console.log("Campos fecha_cw_lista IGUALES");
            }else{
                alertCamposIguales = true;
                $('#fecha_cw_lista').css("border-color","red");
                // console.log(" fecha_cw_lista NO IGUALES");
            }

            var igual_rfe = rfe.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_rfe.length === 1) {
                $('#rfe').val(obj[0]["rfe"])
                // console.log("Campos rfe IGUALES");
            }else{
                alertCamposIguales = true;
                $('#rfe').css("border-color","red");
                // console.log(" rfe NO IGUALES");
            }

            var igual_estado_df = estado_df.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_estado_df.length === 1) {
                $('#estado_df').val(obj[0]["estado_df"])
                // console.log("Campos estado_df IGUALES");
            }else{
                alertCamposIguales = true;
                $('#estado_df').css("border-color","red").val('');
                // console.log(" estado_df NO IGUALES");
            }

            var igual_fecha_df = fecha_df.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_fecha_df.length === 1) {
                $('#fecha_df').val(obj[0]["fecha_df"])
                // console.log("Campos fecha_df IGUALES");
            }else{
                alertCamposIguales = true;
                $('#fecha_df').css("border-color","red");
                // console.log(" fecha_df NO IGUALES");
            }

            var igual_rfic = rfic.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_rfic.length === 1) {
                $('#rfic').val(obj[0]["rfic"])
                // console.log("Campos rfic IGUALES");
            }else{
                alertCamposIguales = true;
                $('#rfic').css("border-color","red");
                // console.log(" rfic NO IGUALES");
            }

            var igual_rfi = rfi.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_rfi.length === 1) {
                $('#rfi').val(obj[0]["rfi"])
                // console.log("Campos rfi IGUALES");
            }else{
                alertCamposIguales = true;
                $('#rfi').css("border-color","red");
                // console.log(" rfi NO IGUALES");
            }

            var igual_estado_instalacion = estado_instalacion.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_estado_instalacion.length === 1) {
                $('#estado_instalacion').val(obj[0]["estado_instalacion"])
                // console.log("Campos estado_instalacion IGUALES");
            }else{
                alertCamposIguales = true;
                $('#estado_instalacion').css("border-color","red").val('');
                // console.log(" estado_instalacion NO IGUALES");
            }

            var igual_fecha_instalacion = fecha_instalacion.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_fecha_instalacion.length === 1) {
                $('#fecha_instalacion').val(obj[0]["fecha_instalacion"])
                // console.log("Campos fecha_instalacion IGUALES");
            }else{
                alertCamposIguales = true;
                $('#fecha_instalacion').css("border-color","red");
                // console.log(" fecha_instalacion NO IGUALES");
            }

            var igual_estado_integracion = estado_integracion.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_estado_integracion.length === 1) {
                $('#estado_integracion').val(obj[0]["estado_integracion"])
                // console.log("Campos estado_integracion IGUALES");
            }else{
                alertCamposIguales = true;
                $('#estado_integracion').css("border-color","red").val('');
                // console.log(" estado_integracion NO IGUALES");
            }

            var igual_fecha_integracion = fecha_integracion.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_fecha_integracion.length === 1) {
                $('#fecha_integracion').val(obj[0]["fecha_integracion"])
                // console.log("Campos fecha_integracion IGUALES");
            }else{
                alertCamposIguales = true;
                $('#fecha_integracion').css("border-color","red");
                // console.log(" fecha_integracion NO IGUALES");
            }

            var igual_estado_onair = estado_onair.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_estado_onair.length === 1) {
                $('#estado_onair').val(obj[0]["estado_onair"])
                // console.log("Campos estado_onair IGUALES");
            }else{
                alertCamposIguales = true;
                $('#estado_onair').css("border-color","red").val('');
                // console.log(" estado_onair NO IGUALES");
            }

            var igual_fecha_inservice = fecha_inservice.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_fecha_inservice.length === 1) {
                $('#fecha_inservice').val(obj[0]["fecha_inservice"])
                // console.log("Campos fecha_inservice IGUALES");
            }else{
                alertCamposIguales = true;
                $('#fecha_inservice').css("border-color","red");
                // console.log(" fecha_inservice NO IGUALES");
            }

            var igual_contratista_cw = contratista_cw.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_contratista_cw.length === 1) {
                $('#contratista_cw').val(obj[0]["contratista_cw"])
                // console.log("Campos contratista_cw IGUALES");
            }else{
                alertCamposIguales = true;
                $('#contratista_cw').css("border-color","red");
                // console.log(" contratista_cw NO IGUALES");
            }

            var igual_mes_inservice = mes_inservice.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_mes_inservice.length === 1) {
                $('#mes_inservice').val(obj[0]["mes_inservice"])
                // console.log("Campos mes_inservice IGUALES");
            }else{
                alertCamposIguales = true;
                $('#mes_inservice').css("border-color","red");
                // console.log(" mes_inservice NO IGUALES");
            }


            var igual_anio_inservice = anio_inservice.filter(function(item2, index, array) {
                    return array.indexOf(item2) === index;
                })
            if (igual_anio_inservice.length === 1) {
                $('#anio_inservice').val(obj[0]["anio_inservice"])
                // console.log("Campos anio_inservice IGUALES");
            }else{
                alertCamposIguales = true;
                $('#anio_inservice').css("border-color","red");
                // console.log(" anio_inservice NO IGUALES");
            }
            if(alertCamposIguales){
                $("#alertCI").css("display","block");
            }
        },
        //
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
                        //FUNCIÓN PARA LIMPIAR TODOS LOS CAMPOS QUE ESTÉN VACÍOS EN UN OBEJTO
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
            // NOTACIÓN AJAX
            // $.post( baseurl + '/Modernizaciones/js_getModer', 
            //         {
            //             mds: id_modernizaciones
            //         }, 
            //         function(data) {
            //             const obj = JSON.parse(data);
            //             if (obj.length > 1) {
            //                 ordenModer.fillModal(obj);
            //             } else {
            //                 ordenModer.fillModal(obj, true);
            //             } 
            //         }
            //     );
            // var obj = JSON.stringify(cambios);
            // console.log(cambios);
            $.post(baseurl + '/Modernizaciones/updateModer',
                {
                    updates : cambios,
                    ids :ordenModer.ids_form
                    // updates : cambios.serializeArray()
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