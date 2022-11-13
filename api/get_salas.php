<?php
// get_salas.php
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

$sql  = "SELECT sala, sala_id, aire_acondicionado FROM salas;";

$result = $conn->query($sql);
$arr = array();

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
	$arr[$row["sala_id"]] = $row;
    }
}
echo json_encode($arr);

?>
