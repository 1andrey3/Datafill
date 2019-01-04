$(function() {
    ordenModer = {
        init: function() {
            ordenModer.events();
            ordenModer.getList_moderDetail();
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
               $("button.close").on("click",function(){
                   $("#mdl-form").removeClass("in").hide();
                   $("#updateModer")[0].reset();
                })
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
            // console.log(ss); // ss Valores no editables
            $.each(obj[0], function(i, item) {
                $('#' + i).val(item); // ESTA FUNCIÓN SE USA PARA RECORRER CADA INPUT Y LLENARLO RESPECTIVAMENTE
                if(item != "" || item != null){
                    const div = $('#' + i).siblings("div.tit")
                    ordenModer.animacionPlaceholder(div);
                }
            });
            
        },
        //
        llenarModalVarios: function(obj){
            ordenModer.llenarNoEditables(ss)
            // console.log(ss); // ss Valores no editables
            console.log(obj); 
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
            var form = $("#updateModer").children();
            form = form.children();
            var inputs = form.children("input");
            var selects = form.children("select");
            var valoresInput = {};
            var valoresSelect = {};
            var cont = 0;
            for (let i = 11; i < inputs.length; i++) {
                 valoresInput[inputs[i].id] = inputs[i].value;
                 while(cont < 7){
                     valoresSelect[selects[cont].id] = selects[cont].value;
                     cont++;
                 }
            }
            valoresInput["id_moder"] = $("#id_moder").val();
            // console.log(valoresInput);
            // console.log(valoresSelect);
            const updateData= {selects : valoresSelect, inputs : valoresInput};
            // updateData["selects"] = valoresSelect;
            // updateData["inputs"] =  valoresInput;
            ordenModer.updateModer(updateData); //<----- VA AL AJAX DE ACTUALIZACIÓN 
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
                    updates : cambios
                    // updates : cambios.serializeArray()
                },
                function(data){
                    if(data){
                        swal("Actualización Realizada con Éxito","" ,"warning");
                    }else{
                        alert("esto es un error")
                    }
                }

            
            
            );
        }
    }
    ordenModer.init();
});