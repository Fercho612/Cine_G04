<?php
$conn = new mysqli("localhost", "root", "", "cine") or die("not connected" . mysqli_connect_error());
// ABM de géneros
if (isset($_POST["accion"]) && $_POST["accion"] == "editar_genero") {
  $nombre = $_POST["genero-" . $_POST["seleccion"]];
  $sql = "UPDATE generos SET genero = '" . $nombre . "' WHERE genero_id = " . $_POST["seleccion"];
  $conn->query($sql);
}
if (isset($_POST["accion"]) && $_POST["accion"] == "eliminar_genero") {
  $sql = "UPDATE peliculas SET genero_id = NULL WHERE genero_id = " . $_POST["id"];
  $conn->query($sql);
  $sql = "DELETE FROM generos WHERE genero_id = " . $_POST["id"];
  $conn->query($sql);
}
if (isset($_POST["accion"]) && $_POST["accion"] == "agregar_genero") {
  $sql = "INSERT INTO generos (genero) VALUES ('" . $_POST["genero"] . "')";
  $conn->query($sql);
}

// ABM de restricciones
if (isset($_POST["accion"]) && $_POST["accion"] == "editar_restriccion") {
  $nombre = $_POST["restriccion-" . $_POST["seleccion"]];
  $sql = "UPDATE restricciones SET restriccion = '" . $nombre . "' WHERE restriccion_id = " . $_POST["seleccion"];
  $conn->query($sql);
}
if (isset($_POST["accion"]) && $_POST["accion"] == "eliminar_restriccion") {
  $sql = "UPDATE peliculas SET restriccion_id = NULL WHERE restriccion_id = " . $_POST["id"];
  $conn->query($sql);
  $sql = "DELETE FROM restricciones WHERE restriccion_id = " . $_POST["id"];
  $conn->query($sql);
}
if (isset($_POST["accion"]) && $_POST["accion"] == "agregar_restriccion") {
  $sql = "INSERT INTO restricciones (restriccion) VALUES ('" . $_POST["restriccion"] . "')";
  $conn->query($sql);
}


header("Location: administracion.php");
?>