<?php
// get_funciones.php
// Este archivo devolverá un JSON con un array con la info de todas las funciones de la película pedida. Permite filtrar por un criterio o limitar la cantidad de películas

$server = "localhost";
$username = "cine";
$password = "0000";
$database = "Cine";
$conn = new mysqli($server, $username, $password, $database);
if($conn->connect_error){
    die("Conexión Fallida: " . $conn->connect_error);
}	
$conn->set_charset("utf8");

$sql  = "
SELECT f.funcion_id, f.sala_id, f.pelicula_id, f.idioma_id, hora, precio, f.formato_id, idioma, formato, nombre
FROM funciones AS f
LEFT JOIN idiomas USING(idioma_id)
LEFT JOIN formatos USING(formato_id)
LEFT JOIN salas USING(sala_id)
LEFT JOIN peliculas USING(pelicula_id)
WHERE f.pelicula_id = " . $_POST["pelicula"] . ";";

$result = $conn->query($sql);
$arr = array();

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
	$arr[$row["pelicula_id"]] = $row;
    }
}
echo json_encode($arr);

?>
