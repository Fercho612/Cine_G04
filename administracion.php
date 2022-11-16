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
      <section id="section-peliculas">
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
            echo "  <td><a href='administracion.php?pelicula=" . $row["pelicula_id"] . "'>" . $row["nombre"] . "</a></td>";
            echo "  <td>" . $row["director"] . "</td>";
            echo "  <td>" . $row["duracion"] . "</td>";
            echo "  <td><img src='" . $row["ruta_imagen"] . "'></td>";
            echo "  <td>" . $row["genero"] . "</td>";
            echo "  <td>" . $row["restriccion"] . "</td>";
            echo "</tr>";
          }
        }
          ?>
        </table>

        <a href="administracion.php?pelicula=0" class="btn btn-primary"> Agregar Película </a>
        <br>
      </section>
      <br>
      <section id="section-salas">
        <h4> Salas </h4>
        <form id="form-salas" action="abm.php" method="post">
          <table class="table table-striped">
            <tr>
              <th> # </th>
              <th> Sala </th>
              <th> Acciones </th>
            </tr>
            <?php
        $res = $conn->query("SELECT sala_id, sala FROM salas;");
        if ($res->num_rows > 0) {
          while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "  <th>" . $row["sala_id"] . "</th>";
            echo "  <td><input id='sala-" . $row["sala_id"] . "' name='sala-" . $row["sala_id"] . "' value='" . $row["sala"] . "' class='form-control' disabled></td>";
            echo "  <td>";
            echo "    <button type='button' id='modificar-sala-" . $row["sala_id"] . "' onclick='modificarSala(" . $row["sala_id"] . ")'";
            echo "    class='btn btn-primary'> Editar </button>";
            echo "    <button type='submit' id='guardar-sala-" . $row["sala_id"] . "' name='seleccion' value='" . $row["sala_id"] . "'";
            echo "    class='btn btn-primary d-none'> Guardar </button>";
            echo "    <button type='button' id='eliminar-sala-" . $row["sala_id"] . "' name='seleccion' onclick='eliminarSala(" . $row["sala_id"] . ")'";
            echo "    class='btn btn-danger'> Eliminar </button>";
            echo "  </td>";
            echo "</tr>";
          }
        }
            ?>
          </table>
          <input id="eliminar-sala-id" type="hidden" name="id" value="0">
          <input id="accion_sala" type="hidden" name="accion" value="editar_sala">
        </form>
        <form action="abm.php" method="post" id="form-nuevo-restriccion">
          <h5> Nueva sala </h5>
          <div class="input-group">
            <input type="text" name="sala" placeholder="Nombre de la sala" class="form-control" required>
            <button type="submit" class="btn btn-primary"> Guardar </button>
            <input type="hidden" name="accion" value="agregar_sala">
          </div>
        </form>
      </section>
      <br>
      <section id="section-restricciones">
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
            <input type="text" name="restriccion" placeholder="Descripción de la restriccion" class="form-control"
              required>
            <button type="submit" class="btn btn-primary"> Guardar </button>
            <input type="hidden" name="accion" value="agregar_restriccion">
          </div>
        </form>
      </section>
      <br><br>
      <section id="section-generos">
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
      
      <section id="section-generos">
        <h4> Idiomas </h4>
        <form id="form-idiomas" action="abm.php" method="post">
          <table class="table table-striped">
            <tr>
              <th> # </th>
              <th> Género </th>
              <th> Acciones </th>
            </tr>
            <?php
        $res = $conn->query("SELECT idioma_id, idioma FROM idiomas;");
        if ($res->num_rows > 0) {
          while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "  <th>" . $row["idioma_id"] . "</th>";
            echo "  <td><input id='idioma-" . $row["idioma_id"] . "' name='idioma-" . $row["idioma_id"] . "' value='" . $row["idioma"] . "' class='form-control' disabled></td>";
            echo "  <td>";
            echo "    <button type='button' id='modificar-idioma-" . $row["idioma_id"] . "' onclick='modificarIdioma(" . $row["idioma_id"] . ")'";
            echo "    class='btn btn-primary'> Editar </button>";
            echo "    <button type='submit' id='guardar-idioma-" . $row["idioma_id"] . "' name='seleccion' value='" . $row["idioma_id"] . "'";
            echo "    class='btn btn-primary d-none'> Guardar </button>";
            echo "    <button type='button' id='eliminar-idioma-" . $row["idioma_id"] . "' name='seleccion' onclick='eliminarIdioma(" . $row["idioma_id"] . ")'";
            echo "    class='btn btn-danger'> Eliminar </button>";
            echo "  </td>";
            echo "</tr>";
          }
        }
            ?>
          </table>
          <input id="eliminar-idioma-id" type="hidden" name="id" value="0">
          <input id="accion_idioma" type="hidden" name="accion" value="editar_idioma">
        </form>
        <form action="abm.php" method="post" id="form-nuevo-idioma">
          <h5> Nuevo Idioma </h5>
          <div class="input-group">
            <input type="text" name="idioma" placeholder="Nombre del género" class="form-control" required>
            <button type="submit" class="btn btn-primary"> Guardar </button>
            <input type="hidden" name="accion" value="agregar_idioma">
          </div>
        </form>
      </section>
      <br>
      <section id="section-formatos">
        <h4> Formatos </h4>
        <form id="form-formatos" action="abm.php" method="post">
          <table class="table table-striped">
            <tr>
              <th> # </th>
              <th> Formato </th>
              <th> Acciones </th>
            </tr>
            <?php
        $res = $conn->query("SELECT formato_id, formato FROM formatos;");
        if ($res->num_rows > 0) {
          while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "  <th>" . $row["formato_id"] . "</th>";
            echo "  <td><input id='formato-" . $row["formato_id"] . "' name='formato-" . $row["formato_id"] . "' value='" . $row["formato"] . "' class='form-control' disabled></td>";
            echo "  <td>";
            echo "    <button type='button' id='modificar-formato-" . $row["formato_id"] . "' onclick='modificarFormato(" . $row["formato_id"] . ")'";
            echo "    class='btn btn-primary'> Editar </button>";
            echo "    <button type='submit' id='guardar-formato-" . $row["formato_id"] . "' name='seleccion' value='" . $row["formato_id"] . "'";
            echo "    class='btn btn-primary d-none'> Guardar </button>";
            echo "    <button type='button' id='eliminar-formato-" . $row["formato_id"] . "' name='seleccion' onclick='eliminarFormato(" . $row["formato_id"] . ")'";
            echo "    class='btn btn-danger'> Eliminar </button>";
            echo "  </td>";
            echo "</tr>";
          }
        }
            ?>
          </table>
          <input id="eliminar-formato-id" type="hidden" name="id" value="0">
          <input id="accion_formato" type="hidden" name="accion" value="editar_formato">
        </form>
        <form action="abm.php" method="post" id="form-nuevo-formato">
          <h5> Nuevo Formato </h5>
          <div class="input-group">
            <input type="text" name="formato" placeholder="Descripción del formato" class="form-control" required>
            <button type="submit" class="btn btn-primary"> Guardar </button>
            <input type="hidden" name="accion" value="agregar_formato">
          </div>
        </form>
      </section>
      <?php } else { ?>


      <!-- Pestaña de película -->


      <section id="section-peliculas">
        <?php
        if ($_GET["pelicula"] == 0) {
          echo "<h4> Agregar Pelicula </h4>";
        } else {
          $info_pelicula = $conn->query("SELECT * FROM peliculas WHERE pelicula_id = " . $_GET["pelicula"])->fetch_assoc();
          echo "<h4> Editar Pelicula </h4>";
        }
        ?>
        <form id="form-pelicula" method="post" action="abm.php" enctype="multipart/form-data">
          <label for="titulo" class="form-label"> Título de la película: </label>
          <input type="text" name="titulo" class="form-control" placeholder="Título" required <?php if
            (isset($info_pelicula)) echo "value='" . $info_pelicula["nombre"] . "'"; ?>>
          <label for="director" class="form-label"> Director de la película: </label>
          <input type="text" name="director" class="form-control" placeholder="Director" required <?php if
            (isset($info_pelicula)) echo "value='" . $info_pelicula["director"] . "'"; ?>>
          <br>
          <div class="row">
            <div class="col-6 col-md-3">
              <label for="duracion" class="form-label"> Duración (en minutos): </label>
              <input type="number" name="duracion" class="form-control" placeholder="Duración" max="999" min="1"
                required <?php if (isset($info_pelicula)) echo "value='" . $info_pelicula["duracion"] . "'" ?>>
            </div>
            <div class="col-6 col-md-3">
              <label for="restriccion" class="form-label"> Restriccion: </label>
              <select name="restriccion" id="restriccion" class="form-select">
                <?php
        $res = $conn->query("SELECT restriccion_id, restriccion FROM restricciones;");
        if ($res->num_rows > 0) {
          while ($row = $res->fetch_assoc()) {
            echo "<option value='" . $row["restriccion_id"];
            if (isset($info_pelicula) && $info_pelicula["restriccion_id"] == $row["restriccion_id"])
              echo "' selected>";
            else
              echo "'>";
            echo $row["restriccion"];
            echo "</option>";
          }
        }
                ?>
              </select>
            </div>
            <div class="col-6 col-md-3">
              <label for="genero" class="form-label"> Género: </label>
              <select name="genero" id="genero" class="form-select">
                <?php
        $res = $conn->query("SELECT genero_id, genero FROM generos;");
        if ($res->num_rows > 0) {
          while ($row = $res->fetch_assoc()) {
            echo "<option value='" . $row["genero_id"];
            if (isset($info_pelicula) && $info_pelicula["genero_id"] == $row["genero_id"])
              echo "' selected>";
            else
              echo "'>";
            echo $row["genero"];
            echo "</option>";
          }
        }
                ?>
              </select>
            </div>
            <div class="col-6 col-md-3">
              <label for="imagen" class="form-label"> Imagen: </label>
              <input type="file" name="imagen" class="form-control">
            </div>
          </div>
          <br>
          <?php if ($_GET["pelicula"] == 0) { ?>
          <button type="submit" name="accion" value="agregar_pelicula" class="btn btn-primary"> Añadir </button>
          <?php } else { ?>
          <button type="submit" class="btn btn-primary"> Guardar </button>
          <button type="submit" class="btn btn-danger" onclick="eliminarPelicula()"> Eliminar </button>
          <input type="hidden" name="accion" value="editar_pelicula" id="accion_pelicula">
          <input type="hidden" name="id" value="<?php echo $_GET["pelicula"]; ?>">
          <?php } ?>
        </form>
      </section>
      <?php if ($_GET["pelicula"] > 0) { ?>
      <section id="section-funciones">
        <h4> Funciones </h4>
        <table class="table table-striped">
          <tr>
            <th> # </th>
            <th> Sala </th>
            <th> Idioma </th>
            <th> Formato </th>
            <th> Hora </th>
            <th> Precio </th>
            <th> Disponible </th>
            <th> </th>
          </tr>
          <?php
          $sql = "SELECT funcion_id, sala, idioma, formato, hora, precio, disponible
FROM funciones
LEFT JOIN salas USING (sala_id)
LEFT JOIN idiomas USING (idioma_id)
LEFT JOIN formatos USING (formato_id)
WHERE pelicula_id = " . $_GET["pelicula"];
          $res = $conn->query($sql);
          if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
              echo "<tr>";
              echo "  <th>" . $row["funcion_id"] . "</th>";
              echo "  <td>" . $row["sala"] . "</td>";
              echo "  <td>" . $row["idioma"] . "</td>";
              echo "  <td>" . $row["formato"] . "</td>";
              echo "  <td>" . $row["hora"] . "</td>";
              echo "  <td>" . $row["precio"] . "</td>";
              echo "  <td><input class='form-check-input' type='checkbox' value='1' id='disponible-" . $row["funcion_id"] . "' onclick='toggleDisponibilidad(".$row["funcion_id"].");'";
              if ($row["disponible"] == 1)
                echo " checked>";
              else
                echo " >";
              echo "</td>";
              echo "  <td><button class='btn btn-danger' onclick='eliminarFuncion(" . $row["funcion_id"] . ")' type='button'> Eliminar </button>";
              echo "</tr>";
            }
          }
          ?>
          <form method="post" action="abm.php" id="form-disponible">
            <input type="hidden" name="funcion_id" id="disponible_funcion_id" value="0">
            <input type="hidden" name="accion" value="toggle_funcion">
            <input type="hidden" name="pelicula" value="<?php echo $_GET["pelicula"]?>">
            <input type="hidden" name="activar" value="0" id="disponibilidad">
          </form>
        </table>
        <h5>Agregar función</h5>
        <form id="form-funciones" method="post" action="abm.php">
          <table class="table table-striped">
            <tr>
              <th> Sala </th>
              <th> Idioma </th>
              <th> Formato </th>
              <th> Hora </th>
              <th> Precio </th>
              <th> </th>
            </tr>
            <tr>
              <td>
                <select name="sala" class="form-select">
                  <?php
          $res = $conn->query("SELECT sala, sala_id FROM salas");
          if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
              echo "<option value='" . $row["sala_id"] . "'>" . $row["sala"] . "</option>";
            }
          }
                  ?>
                </select>
              </td>
              <td>
                <select name="idioma" class="form-select">
                  <?php
          $res = $conn->query("SELECT idioma, idioma_id FROM idiomas");
          if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
              echo "<option value='" . $row["idioma_id"] . "'>" . $row["idioma"] . "</option>";
            }
          }
                  ?>
                </select>
              </td>
              <td>
                <select name="formato" class="form-select">
                  <?php
          $res = $conn->query("SELECT formato, formato_id FROM formatos");
          if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
              echo "<option value='" . $row["formato_id"] . "'>" . $row["formato"] . "</option>";
            }
          }
                  ?>
                </select>
              </td>
              <td>
                <input type="datetime-local" class="form-control" name="hora" required>
              </td>
              <td>
                <input type="number" min="1" class="form-control" name="precio" value="100" required>
              </td>
            </tr>
          </table>
          <input id="accion_funciones" type="hidden" name="accion" value="agregar_funcion">
          <input type="hidden" name="pelicula" value="<?php echo $_GET["pelicula"]; ?>">
          <input type="hidden" name="funcion_id" value="0" id="funcion_id">
          <button type="submit" class="btn btn-primary"> Guardar </button>
        </form>
      </section>
      <?php } ?>
      <?php } ?>
    </div>
  </main>
  <?php include 'Layout/footer.php'; ?>
</body>

</html>