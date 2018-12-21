$(function() {
    modernizacion = {
        init: function() {
            modernizacion.events();
            modernizacion.getList_modernzaciones();

        },
        //Eventos de la ventana.
        events: function() {
            $('#tabla_modernizaciones').on('click', 'a.opc-orden', modernizacion.onClickBtnEditOrden);
        },

        getList_modernzaciones: function() {
            //metodo ajax (post)
            $.post(baseurl + '/Modernizaciones/c_get_modernizaciones',
                    {
                        //parametros
                    },
                    // función que recibe los datos
                            function(data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                modernizacion.printTable(obj);
                            }
                    );
                },

        printTable: function(data) {
            // nombramos la variable para la tabla y llamamos la configuiracion que se encuentra en /assets/js/modules/helper.js
            modernizacion.tabla_modernizaciones = $('#tabla_modernizaciones').DataTable(modernizacion.configTable(data, [
                {title: "OT", data: "K_IDORDER"},
                {title: "Actividad", data: "K_IDCLARO"},
                {title: "Sitio", data: "N_NAME"},
                {title: "Fecha asignacion", data: "D_ASIG_Z"},
                {title: "Fecha ejecucion claro", data: "D_CLARO_F"},
                {title: "Estado", data: "N_ESTADO"},
                {title: "Proyecto", data: "N_PROYECTO"},
                {title: "Fecha forecast", data: "D_FORECAST"},
                {title: "Fecha creacion", data: "D_DATE_CREATION"},
                {title: "Solicitante", data: "N_ING_SOL"},
                {title: "Region", data: "n_region"},
                {title: "Opciones", data: modernizacion.getButtons},
            ]));
        },

        // Datos de configuracion del datatable
        configTable: function(data, columns, onDraw) {
            return {
                data: data,
                columns: columns,
                "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json"
                },
                dom: 'Blfrtip',
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
                    + "<a class='btn btn-default btn-xs opc-orden btn_datatable_cami' data-btn='hito' title='Hitos Ots'><span class='glyphicon glyphicon-edit'></span></a>"
                    + "</div>";
            return botones;
        },

        onClickBtnEditOrden: function(e) {
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var record = modernizacion.tabla_modernizaciones.row(trParent).data();

            const url = baseurl + `/Modernizaciones/c_getOrdenDetail/${record.K_IDORDER}`;
            window.open(url, '_blank');

//            modernizacion.showDetailsOrdenModer(record);
            console.log(record);
        },

    };
    modernizacion.init();
});