function validar_selects_doc() {
    var selects = $('#example .select_doc');
      $.each(selects,function( i, select ) {
        var tr = $(this).parents('tr');
        var idActividad = tr.children('td')[0];
        console.log(idActividad.innerHTML);
        console.log("num_documentador="+select.value);
        document.getElementById("documentador_"+i).value= select.value;
      });

}