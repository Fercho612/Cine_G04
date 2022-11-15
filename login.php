<?php
$nombre_usado = 0;
$usuario_inexistente = 0;
$contrasena_incorrecta = 0;
if (isset($_POST["registro"])) {
  $server = "localhost";
  $username = "cine";
  $password = "0000";
  $database = "cine";
  $conn = new mysqli($server, $username, $password, $database);
  if ($conn->connect_error) {
    die("Conexión Fallida: " . $conn->connect_error);
  }
  $conn->set_charset("utf8");
  if ($_POST["registro"] == "1") {
    // Registrar usuario
    $sql = "SELECT usuario FROM clientes WHERE usuario = '" . $_POST["username"] . "';";
    $res = $conn->query($sql);
    if ($res->num_rows == 0) {
      $sql = "      
      INSERT INTO clientes (nombre, apellido, usuario, email, contrasena)
      VALUES ('" . $_POST["nombre"] . "','" . $_POST["apellido"] . "','" . $_POST["username"] . "','" . $_POST["correo"] . "','" . $_POST["contrasena"] . "');";
      $conn->query($sql);
      setcookie("username", $_POST["username"]);
      setcookie("contrasena", $_POST["contrasena"]);
      header("Location: index.html");
    } else
      $nombre_usado = 1;
  } else {
    // Iniciar Sesión
    $sql = "SELECT usuario, contrasena FROM clientes WHERE usuario = '" . $_POST["username"] . "';";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
      if ($res->fetch_assoc()["contrasena"] == $_POST["contrasena"]) {
        setcookie("username", $_POST["username"]);
        setcookie("contrasena", $_POST["contrasena"]);
        header("Location: index.html");
      } else {
        $contrasena_incorrecta = 1;
      }
    } else {
      $usuario_inexistente = 1;
    }
  }
}
if (isset($_COOKIE["username"]))
  header("Location: index.html");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - Cine-GO4</title>
  <link rel="icon" href="Multimedia/Logos/logo.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="login.css">
  <script src="login.js"></script>
  <?php
  if (isset($_POST["registro"]) && $_POST["registro"] == 0)
    echo "<script>var registrando = false;</script>";
  else
    echo "<script>var registrando = true;</script>";
  ?>
</head>

<body>
  <header class="w-100">
    <div class="container">
      <nav class="navbar navbar-dark navbar-expand-m my-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.html">
            <img src="Multimedia/Logos/svg/logo-no-background.svg" alt="Logo" width="150" height="54"
              class="d-inline-block align-text-top">
          </a>
          <button class="navbar-toggler color_primary" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon color_primary"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
              <li class="nav-item">
                <a class="nav-link color_primary fs-4" aria-current="page" href="#cartelera">Cartelera</a>
              </li>
              <li class="nav-item">
                <a class="nav-link color_primary fs-4" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link color_primary fs-4" href="#footer">Contactos</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <main class="w-100 py-5 color-black d-flex justify-content-center">
    <form method="post" action="login.php" id="ventana_login"
      class="container rounded shadow d-flex flex-column col-12 col-sm-10 col-md-6 col-lg-5">
      <br>
      <div id="form_botones" class="d-flex justify-content-center">
        <div class="btn-group justify-content-center" id="grupo_botones">
          <button type="button" id="btn_tab_registrar" onclick="tab_registrar()" class="btn btn-primary"> Registrarse
          </button>
          <button type="button" id="btn_tab_iniciar_sesion" onclick="tab_iniciar_sesion()"
            class="btn btn-outline-primary"> Iniciar Sesión </button>
        </div>
      </div>
      <br>
      <label for="username" id="nombre_label" class="form-label"> Nombre de usuario </label>
      <input type="text" placeholder="Nombre de usuario" name="username" id="username" class="form-control" required
        data-bs-toggle="tooltip" data-bs-title="Debe contener entre 4 y 40 caracteres" data-bs-placement="right">
      <br>
      <div id="alerta_username" class="alerta">
        <?php
        if ($nombre_usado == 1) {
          echo '<div class="alert alert-danger"> <i class="fa-solid fa-triangle-exclamation"> </i> Ese nombre de usuario ya está en uso </div>';
        }
        if ($usuario_inexistente == 1) {
          echo '<div class="alert alert-danger"> <i class="fa-solid fa-triangle-exclamation"> </i> No se ha encontrado este nombre de usuario </div>';
        }
        ?>
      </div>
      <label for="nombre" id="nombre_label" class="form-label registro"> Nombre </label>
      <input type="text" placeholder="Nombre" name="nombre" id="nombre" class="form-control registro">
      <br class="registro">
      <div id="alerta_nombre" class="alerta"> </div>
      <label for="apellido" id="apellido_label" class="form-label registro"> Apellido </label>
      <input type="text" placeholder="Apellido" name="apellido" id="apellido" class="form-control registro">
      <br class="registro">
      <div id="alerta_apellido" class="alerta"> </div>
      <label for="contrasena" id="contrasena_label" class="form-label"> Contraseña </label>
      <input type="password" placeholder="Contraseña" name="contrasena" id="contrasena" class="form-control" required
        data-bs-toggle="tooltip" data-bs-title="Debe contener al menos 4 caracteres" data-bs-placement="right">
      <br>
      <div id="alerta_contrasena" class="alerta">
        <?php
        if ($contrasena_incorrecta == 1) {
          echo '<div class="alert alert-danger"> <i class="fa-solid fa-triangle-exclamation"> </i> La contraseña es incorrecta </div>';
        }
        ?>
      </div>
      <label for="contraseña2" id="contrasena2_label" class="form-label registro"> Repetir Contraseña </label>
      <input type="password" placeholder="Contraseña" name="contrasena2" id="contrasena2" class="form-control registro"
        required data-bs-toggle="tooltip" data-bs-title="Las contraseñas deben coincidir" data-bs-placement="right">
      <br class="registro">
      <div id="alerta_contrasena2" class="alerta registro"> </div>
      <label for="correo" id="correo_label" class="form-label registro"> Correo Electrónico </label>
      <input type="email" placeholder="nombre@ejemplo.com" name="correo" id="correo" class="form-control registro"
        required>
      <br>
      <div id="alerta_correo" class="alerta registro"> </div>
      <button type="button" class="btn btn-primary w-100 d-none" id="btn_iniciar_sesion" onclick="iniciar_sesion()">
        Iniciar Sesion </button>
      <button type="button" class="btn btn-primary w-100 d-block" id="btn_registrar" onclick="registrar()"> Registrarse
      </button>

      <input id="hidden_registro" type="hidden" name="registro" value="1">
    </form>
  </main>
  <footer id="footer" class="w-100 p-3 color_wt">
    <div class="container row mx-auto">
      <div class="col-lg-4 mb-4 mb-md-0">
        <img src="Multimedia/Logos/svg/logo-no-background.svg" alt="Logo" class="d-inline-block align-text-top w-75">
      </div>
      <div class="col-lg-4 mb-4 mb-md-0 text-center">
        <span class="fs-3">Ayuda</span>
        <ul class="mt-3 p-0">
          <li><a href="#" class="color_wt fs-5">Metodosde pago</a></li>
          <li><a href="#" class="color_wt fs-5">Recibos</a></li>
          <li><a href="#" class="color_wt fs-5">Asientos</a></li>
        </ul>
      </div>
      <div class="col-lg-4">
        <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt sunt harum voluptate
          voluptatibus ipsum nulla nihil quo sapiente, vitae sit facilis dicta architecto, recusandae provident, ad
          explicabo sint excepturi mollitia.</p>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>
</body>

</html>