$(function() {
    ordenModer = {
        init: function() {
            ordenModer.events();
            ordenModer.getList_moderDetail();

        },
        //Eventos de la ventana.
        events: function() {
            $('#edModer').click(ordenModer.form_modal);
            $('#tabla_ordenAsoc').on('click', 'a.opc-orden', ordenModer.modalSolo)
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
                    + "<a class='btn btn-default btn-xs opc-orden btn_datatable_cami' data-btn='hito' title='Ver Asociadas'><span class='glyphicon glyphicon-edit'></span></a>"
                    + "</div>";
            return botones;
        },

        // funcionews para modal de unico registro
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
                console.log('es unico');
                ordenModer.llenarModalUnico(obj)

           } else {

                ordenModer.llenarModalVarios(obj)
                console.log('es de varios');
           }
            
        },

        //
        llenarModalUnico: function(obj){
            console.log(ss); // ss Valores no editables
        },

        //
        llenarModalVarios: function(obj){
            console.log(ss);
        },





    };
    ordenModer.init();
});