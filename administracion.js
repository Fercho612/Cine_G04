// Género
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

// Formato
function modificarFormato(id) {
  $(`#formato-${id}`).prop("disabled", false);
  $(`#modificar-formato-${id}`).addClass("d-none");
  $(`#guardar-formato-${id}`).removeClass("d-none");
}

function eliminarFormato(id) {
  if (confirm(`¿Desea eliminar este género? Se eliminará de todas las películas que lo tengan`)) {
    $("#accion_formato").val("eliminar_formato");
    $("#eliminar-formato-id").val(id);
    $("#form-formatos").submit();
  }
}

// Restricciones
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

// Películas
function eliminarPelicula() {
  if (confirm(`¿Desea eliminar esta pelicula? Se eliminarán todas las funciones asociadas`)) {
    $("#accion_pelicula").val("eliminar_pelicula");
    $("#form-pelicula").submit();
  }
}

// Salas
function modificarSala(id) {
  $(`#sala-${id}`).prop("disabled", false);
  $(`#modificar-sala-${id}`).addClass("d-none");
  $(`#guardar-sala-${id}`).removeClass("d-none");
}

function eliminarSala(id) {
  if (confirm(`¿Desea eliminar esta sala? Se eliminarán todas las funciones que la contengan y sus entradas`)) {
    $("#accion_sala").val("eliminar_sala");
    $("#eliminar-sala-id").val(id);
    $("#form-salas").submit();
  }
}

// Funciones
function eliminarFuncion(id){
  if(confirm(`¿Desea eliminar esta funcion? Al hacerlo se perderá información de las entradas relacionadas`)){
    $("#accion_funciones").val("eliminar_funcion");
    $("#funcion_id").val(id);
    $("#form-funciones").submit();
  }
}
