<?php
if (isset($_COOKIE["username"]) && isset($_COOKIE["contrasena"])) {
  $conn = new mysqli("localhost", "root", "", "cine") or die("not connected" . mysqli_connect_error());
  $sql = "SELECT privilegios FROM clientes WHERE usuario = '" . $_COOKIE["username"] . "' AND contrasena = '" . $_COOKIE["contrasena"] . "';";
  $res = $conn->query($sql);
  if ($res->num_rows == 0 || $res->fetch_assoc()["privilegios"] == 0) {
    header("Location: index.php");
  }
} else {
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administración - Cine-GO4</title>
  <link rel="icon" href="Multimedia/Logos/logo.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="administracion.css">
  <script src="administracion.js"></script>
</head>

<body>
  <?php include 'Layout/header.php'; ?>
  <main class="w-100 py-5 color-black d-flex justify-content-center">
    <div id="ventana_admin" class="container rounded shadow d-flex flex-column col-11 col-md-10">

      <?php if (!isset($_GET["pelicula"])) { ?>
      <section>
        <h4> Peliculas </h4>
        <table class="table table-striped rounded">
          <tr>
            <th> # </th>
            <th> Título </th>
            <th> Director </th>
            <th> Duracion </th>
            <th> Imagen </th>
            <th> Género </th>
            <th> Restriccion </th>
          </tr>
          <?php
        $sql = "SELECT pelicula_id, nombre, director, duracion, ruta_imagen, restriccion, genero
          FROM peliculas 
          LEFT JOIN restricciones USING(restriccion_id)
          LEFT JOIN generos USING(genero_id);";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
          while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "  <th>" . $row["pelicula_id"] . "</th>";
            echo "  <td>" . $row["nombre"] . "</td>";
            echo "  <td>" . $row["director"] . "</td>";
            echo "  <td>" . $row["duracion"] . "</td>";
            echo "  <td><img src='" . $row["ruta_imagen"] . "'></td>";
            echo "  <td>" . $row["restriccion"] . "</td>";
            echo "  <td>" . $row["genero"] . "</td>";
            echo "</tr>";
          }
        }
          ?>
        </table>
      </section>
      <section>
        <h4> Restricciones </h4>
        <form id="form-restricciones" action="abm.php" method="post">
          <table class="table table-striped">
            <tr>
              <th> # </th>
              <th> Restriccion </th>
              <th> Acciones </th>
            </tr>
            <?php
        $res = $conn->query("SELECT restriccion_id, restriccion FROM restricciones;");
        if ($res->num_rows > 0) {
          while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "  <th>" . $row["restriccion_id"] . "</th>";
            echo "  <td><input id='restriccion-" . $row["restriccion_id"] . "' name='restriccion-" . $row["restriccion_id"] . "' value='" . $row["restriccion"] . "' class='form-control' disabled></td>";
            echo "  <td>";
            echo "    <button type='button' id='modificar-restriccion-" . $row["restriccion_id"] . "' onclick='modificarRestriccion(" . $row["restriccion_id"] . ")'";
            echo "    class='btn btn-primary'> Editar </button>";
            echo "    <button type='submit' id='guardar-restriccion-" . $row["restriccion_id"] . "' name='seleccion' value='" . $row["restriccion_id"] . "'";
            echo "    class='btn btn-primary d-none'> Guardar </button>";
            echo "    <button type='button' id='eliminar-restriccion-" . $row["restriccion_id"] . "' name='seleccion' onclick='eliminarRestriccion(" . $row["restriccion_id"] . ")'";
            echo "    class='btn btn-danger'> Eliminar </button>";
            echo "  </td>";
            echo "</tr>";
          }
        }
            ?>
          </table>
          <input id="eliminar-restriccion-id" type="hidden" name="id" value="0">
          <input id="accion_restriccion" type="hidden" name="accion" value="editar_restriccion">
        </form>
        <form action="abm.php" method="post" id="form-nuevo-restriccion">
          <h5> Nueva restricción </h5>
          <div class="input-group">
            <input type="text" name="restriccion" placeholder="Nombre de la restriccion" class="form-control" required>
            <button type="submit" class="btn btn-primary"> Guardar </button>
            <input type="hidden" name="accion" value="agregar_restriccion">
          </div>
        </form>
      </section>
      <br> 
      <section>
        <h4> Géneros </h4>
        <form id="form-generos" action="abm.php" method="post">
          <table class="table table-striped">
            <tr>
              <th> # </th>
              <th> Género </th>
              <th> Acciones </th>
            </tr>
            <?php
        $res = $conn->query("SELECT genero_id, genero FROM generos;");
        if ($res->num_rows > 0) {
          while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "  <th>" . $row["genero_id"] . "</th>";
            echo "  <td><input id='genero-" . $row["genero_id"] . "' name='genero-" . $row["genero_id"] . "' value='" . $row["genero"] . "' class='form-control' disabled></td>";
            echo "  <td>";
            echo "    <button type='button' id='modificar-genero-" . $row["genero_id"] . "' onclick='modificarGenero(" . $row["genero_id"] . ")'";
            echo "    class='btn btn-primary'> Editar </button>";
            echo "    <button type='submit' id='guardar-genero-" . $row["genero_id"] . "' name='seleccion' value='" . $row["genero_id"] . "'";
            echo "    class='btn btn-primary d-none'> Guardar </button>";
            echo "    <button type='button' id='eliminar-genero-" . $row["genero_id"] . "' name='seleccion' onclick='eliminarGenero(" . $row["genero_id"] . ")'";
            echo "    class='btn btn-danger'> Eliminar </button>";
            echo "  </td>";
            echo "</tr>";
          }
        }
            ?>
          </table>
          <input id="eliminar-genero-id" type="hidden" name="id" value="0">
          <input id="accion_genero" type="hidden" name="accion" value="editar_genero">
        </form>
        <form action="abm.php" method="post" id="form-nuevo-genero">
          <h5> Nuevo Género </h5>
          <div class="input-group">
            <input type="text" name="genero" placeholder="Nombre del género" class="form-control" required>
            <button type="submit" class="btn btn-primary"> Guardar </button>
            <input type="hidden" name="accion" value="agregar_genero">
          </div>
        </form>
      </section>
      <?php } else { ?>
      <section>
        <h4> Agregar Pelicula </h4>
      </section>
      <?php } ?>
    </div>
  </main>
  <?php include 'Layout/footer.php'; ?>
</body>

</html>