function validar_selects_doc() {
    var selects = $('#example .select_doc');
      $.each(selects,function( i, select ) {
        var tr = $(this).parents('tr');
        var idActividad = tr.children('td')[0];
        document.getElementById("documentador_"+i).value= select.value;
      });

}