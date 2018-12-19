$(function() {
    recorded = {
        init: function() {
            recorded.events();
            recorded.getList_modernzaciones();

        },
        //Eventos de la ventana.
        events: function() {

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
                                recorded.printTable(obj);
                            }
                    );
                },

        printTable: function(data) {
            // nombramos la variable para la tabla y llamamos la configuiracion que se encuentra en /assets/js/modules/helper.js
            recorded.tabla_modernizaciones = $('#tabla_modernizaciones').DataTable(recorded.configTable(data, [

                {title: "OT", data: "K_IDORDER"},
                {title: "Actividad", data: "K_IDCLARO"},
                {title: "Tipo", data: "tipo_orden"},
                {title: "Sitio", data: "K_IDSITE"},
                {title: "Trabajo", data: "trabajo"},
                {title: "Id", data: "id"},
                {title: "Tipo tecnologia", data: "tipo_tecnologia"},
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

    };
    recorded.init();
});