function modificarGenero(id) {
  $(`#genero-${id}`).prop("disabled", false);
  $(`#modificar-genero-${id}`).addClass("d-none");
  $(`#guardar-genero-${id}`).removeClass("d-none");
}

function eliminarGenero(id) {
  if (confirm(`¿Desea eliminar este género? Se eliminará de todas las películas que lo tengan`)) {
    $("#accion_genero").val("eliminar_genero");
    $("#eliminar-genero-id").val(id);
    $("#form-generos").submit();
  }
}