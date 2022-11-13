/*
   API del Cine
   1) Funcionamiento general de las funciones:
   Estas funciones se comunican con AJAX con los scripts PHP que traen información de la Base de Datos.
   Estas funciones son async, por lo que retornan promesas.
   En otras palabras, hacer let peliculas = getPeliculas(); dará un error.
   La forma correcta de usar estas funciones es a través del .then
   Por ejemplo, para mostrar todas las películas en la consola el comando correcto es:
   getPeliculas.then(result => {console.log(result)});

   Cuando quieras usar estas funciones para algo te recomiendo que crees una función que tome un solo parámetro para poder aplicar esta lógica. Por ejemplo:
   function mostrarPeliculas(peliculas){
     ...
   }
   Para después poder hacer
   getPeliculas.then(result => mostrarPeliculas(result));
   
   Esto se debe a que AJAX funciona de forma asincrónica, y JavaScript hace quilombo si no se trata de esta forma.

   2) Funcionamiento específico de las funciones:
   En el archivo DocumentacionAPI.txt se deteallará qué parámetros espera cada función y cómo será su salida, además se incluirán ejemplos.
   El parámetro de la promesa (siempre llamado "res" o "result") es siempre un único JSON.

   3) api_url:
   Esta es una constante que indica la ruta a la carpeta con las APIs. Si los archivos están en otra ubicación (porque por ejemplo, la carpeta tiene otro nombre), cambiala.
*/
const api_url = "http://localhost/Cine/api/"

async function getPeliculas(limite = 0){
    let res;
    
    await $.ajax({
	url: api_url + "get_peliculas.php",
	type: "POST",
	data: {limite: limite},
	success: (result, status, xhr) => {
	    res = JSON.parse(result);
	},
	error: (xhr, status, error) => {
	    console.log("Error en getPeliculas().", error);
	}
    });
    return res;
}

async function getFunciones(pelicula_id){
    let res;
    await $.ajax({
	url: api_url + "get_funciones.php",
	type: 'post',
	data: {"pelicula": pelicula_id},
	success: (result, status, xhr) => {
	    res = JSON.parse(result);
	},
	error: (xhr, status, error) => {
	    console.log("Error en getFunciones().", error);
	}
    });
    return res;
}

async function getAsientos(sala_id){
    let res;
    await $.ajax({
	url: api_url + "get_asientos.php",
	type: 'post',
	data: {"sala": sala_id},
	success: (result, status, xhr) => {
	    res = JSON.parse(result);
	},
	error: (xhr, status, error) => {
	    console.log("Error en getAsientos().", error);
	}
    });
    return res;
}

async function getSalas(){
    let res;
    await $.ajax({
	url: api_url + "get_salas.php",
	type: 'post',
	success: (result, status, xhr) => {
	    res = JSON.parse(result);
	},
	error: (xhr, status, error) => {
	    console.log("Error en getSalas().", error);
	}
    });
    return res;
}

async function getClientes(){
    let res;
    await $.ajax({
	url: api_url + "get_clientes.php",
	type: 'post',
	success: (result, status, xhr) => {
	    res = JSON.parse(result);
	},
	error: (xhr, status, error) => {
	    console.log("Error en getClientes().", error);
	}
    });
    return res;
}


getClientes().then((result) =>{
    console.log("Retorno:", result);
});
