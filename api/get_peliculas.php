<?php
// get_peliculas.php
// Este archivo devolverá un JSON con un array con la info de todas las películas. Permite filtrar por un criterio o limitar la cantidad de películas

$server = "localhost";
$username = "cine";
$password = "0000";
$database = "Cine";
$conn = new mysqli($server, $username, $password, $database);
if($conn->connect_error){
    die("Conexión Fallida: " . $conn->connect_error);
}	
$conn->set_charset("utf8");

if(isset($_POST["limite"]) && $_POST["limite"] > 0){
    $sql = "SELECT pelicula_id, nombre, duracion, director FROM peliculas LIMIT ". $_POST["limite"];
}
else{
    $sql = "SELECT pelicula_id, nombre, duracion, director FROM peliculas";
}

$result = $conn->query($sql);
$arr = array();

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
	$arr[$row["pelicula_id"]] = $row;
    }
}
echo json_encode($arr);

?>
