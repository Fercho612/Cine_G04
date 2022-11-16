<?php
$conn = new mysqli("localhost", "root", "", "cine") or die("not connected" . mysqli_connect_error());
if(isset($_POST["pelicula"])) $pelicula = $_POST["pelicula"];
$section = "#";

// ABM de formatos
if (isset($_POST["accion"]) && $_POST["accion"] == "editar_formato") {
  $nombre = $_POST["formato-" . $_POST["seleccion"]];
  $sql = "UPDATE formatos SET formato = '" . $nombre . "' WHERE formato_id = " . $_POST["seleccion"];
  $conn->query($sql);
  $section = "#section-formatos";
}
if (isset($_POST["accion"]) && $_POST["accion"] == "eliminar_formato") {
  $sql = "DELETE FROM formatos WHERE formato_id = " . $_POST["id"];
  $section = "#section-formatos";
  $conn->query($sql);
}
if (isset($_POST["accion"]) && $_POST["accion"] == "agregar_formato") {
  $sql = "INSERT INTO formatos (formato) VALUES ('" . $_POST["formato"] . "')";
  $section = "#section-formatos";
  $conn->query($sql);
}

// ABM de géneros
if (isset($_POST["accion"]) && $_POST["accion"] == "editar_genero") {
  $nombre = $_POST["genero-" . $_POST["seleccion"]];
  $sql = "UPDATE generos SET genero = '" . $nombre . "' WHERE genero_id = " . $_POST["seleccion"];
  $section = "#section-generos";
  $conn->query($sql);
}
if (isset($_POST["accion"]) && $_POST["accion"] == "eliminar_genero") {
  $sql = "DELETE FROM generos WHERE genero_id = " . $_POST["id"];
  $section = "#section-generos";
  $conn->query($sql);
}
if (isset($_POST["accion"]) && $_POST["accion"] == "agregar_genero") {
  $sql = "INSERT INTO generos (genero) VALUES ('" . $_POST["genero"] . "')";
  $conn->query($sql);
  $section = "#section-generos";
}

// ABM de restricciones
if (isset($_POST["accion"]) && $_POST["accion"] == "editar_restriccion") {
  $nombre = $_POST["restriccion-" . $_POST["seleccion"]];
  $sql = "UPDATE restricciones SET restriccion = '" . $nombre . "' WHERE restriccion_id = " . $_POST["seleccion"];
  $conn->query($sql);
  $section = "#section-restricciones";
}
if (isset($_POST["accion"]) && $_POST["accion"] == "eliminar_restriccion") {
  $sql = "DELETE FROM restricciones WHERE restriccion_id = " . $_POST["id"];
  $conn->query($sql);
  $section = "#section-restricciones";
}
if (isset($_POST["accion"]) && $_POST["accion"] == "agregar_restriccion") {
  $sql = "INSERT INTO restricciones (restriccion) VALUES ('" . $_POST["restriccion"] . "')";
  $conn->query($sql);
  $section = "#section-restricciones";
}

// ABM de salas
if (isset($_POST["accion"]) && $_POST["accion"] == "editar_sala") {
  $nombre = $_POST["sala-" . $_POST["seleccion"]];
  $sql = "UPDATE salas SET sala = '" . $nombre . "' WHERE sala_id = " . $_POST["seleccion"];
  $conn->query($sql);
  $section = "#section-salas";
}
if (isset($_POST["accion"]) && $_POST["accion"] == "eliminar_sala") {
  $sql = "DELETE FROM salas WHERE sala_id = " . $_POST["id"];
  $conn->query($sql);
  $section = "#section-salas";
}
if (isset($_POST["accion"]) && $_POST["accion"] == "agregar_sala") {
  $sql = "INSERT INTO salas (sala) VALUES ('" . $_POST["sala"] . "')";
  $section = "#section-salas";
  $conn->query($sql);
}

// ABM de películas
if (isset($_POST["accion"]) && $_POST["accion"] == "editar_pelicula") {
  $sql = "UPDATE peliculas 
  SET nombre = '" . $_POST["titulo"] . "', 
  duracion = '" . $_POST["duracion"] . "',
  director = '" . $_POST["director"] . "',
  restriccion_id = " . $_POST["restriccion"] . ",
  genero_id = " . $_POST["genero"] . "
  WHERE pelicula_id = " . $_POST["id"];
  $conn->query($sql);
  $pelicula = $_POST["id"];
  $section = "#section-peliculas";
}

if (isset($_POST["accion"]) && $_POST["accion"] == "eliminar_pelicula") {
  $sql = "DELETE FROM peliculas WHERE pelicula_id = " . $_POST["id"];
  $conn->query($sql);
  $section = "#section-peliculas";
}

if (isset($_POST["accion"]) && $_POST["accion"] == "agregar_pelicula") {
  $sql = "INSERT INTO peliculas (nombre, duracion, director, restriccion_id, genero_id) 
  VALUES ('" . $_POST["titulo"] . "', '" . $_POST["duracion"] . "', '" . $_POST["director"] . "', '" . $_POST["restriccion"] . "', '" . $_POST["genero"] . "')";
  $conn->query($sql);
  $target_dir = "fotos_peliculas/" . $conn->insert_id . ".jpg";
  move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_dir);
  $pelicula = $conn->insert_id;
  $section = "#section-peliculas";
}

// ABM de funciones
if (isset($_POST["accion"]) && $_POST["accion"] == "agregar_funcion") {
  $sql = "INSERT INTO funciones (sala_id, pelicula_id, idioma_id, formato_id, hora, precio)
  VALUES (" . $_POST["sala"] . ", " . $_POST["pelicula"] . ", " . $_POST["idioma"] . ", " . $_POST["formato"] . ", '" . $_POST["hora"] . "', " . $_POST["precio"] . ");";
  $conn->query($sql);
  $section = "#section-funciones";
}
if (isset($_POST["accion"]) && $_POST["accion"] == "eliminar_funcion") {
  $conn->query("DELETE FROM funciones WHERE funcion_id = " . $_POST["funcion_id"]);
  $section = "#section-funciones";
}
if (isset($pelicula)) {
  header("Location: administracion.php?pelicula=" . $pelicula . $section);
} else {
  header("Location: administracion.php" . $section);
}
?>