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

function modificarRestriccion(id) {
  $(`#restriccion-${id}`).prop("disabled", false);
  $(`#modificar-restriccion-${id}`).addClass("d-none");
  $(`#guardar-restriccion-${id}`).removeClass("d-none");
}

function eliminarRestriccion(id) {
  if (confirm(`¿Desea eliminar esta restricción? Se eliminará de todas las películas que lo tengan`)) {
    $("#accion_restriccion").val("eliminar_restriccion");
    $("#eliminar-restriccion-id").val(id);
    $("#form-restricciones").submit();
  }
}

function eliminarPelicula() {
  if (confirm(`¿Desea eliminar esta pelicula? Se eliminarán todas las funciones asociadas`)) {
    $("#accion_pelicula").val("eliminar_pelicula");
    $("#form-pelicula").submit();
  }
}