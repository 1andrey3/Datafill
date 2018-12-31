$(function() {
    ordenModer = {
        init: function() {
            ordenModer.events();
            ordenModer.getList_moderDetail();
        },
        //Eventos de la ventana.
        events: function() {
            $('#tabla_ordenAsoc').on('click', 'a.opc-orden', ordenModer.onClickBtnEditOrden);
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
                {title: "Opciones", data: ordenModer.getButtons},
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

        onClickBtnEditOrden: function(e) {
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var record = ordenModer.tabla_ordenAsoc.row(trParent).data();

//            ordenModer.showDetailsOrdenModer(record);
            console.log(record);
        },
        displayModal: function(algo){
            $('#modal_form').show();
            console.log(algo);
        }
    };
    ordenModer.init();
});