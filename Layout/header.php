<?php
$conn = new mysqli("localhost", "root", "", "cine") or die("not connected" . mysqli_connect_error());
if (isset($_COOKIE["username"])) {
  $privilegio = $conn->query("SELECT privilegios FROM clientes WHERE usuario = '" . $_COOKIE["username"] . "'")->fetch_assoc()["privilegios"];
}
?>

<script src="cookie.js"> </script>
<header class="w-100">
  <div class="container">
    <nav class="navbar navbar-dark navbar-expand-md py-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
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
              <a class="nav-link color_primary fs-4" aria-current="page" href="index.php">Cartelera</a>
            </li>
            <li class="nav-item">
              <a class="nav-link color_primary fs-4" href="#footer">Contactos</a>
            </li>
            <?php if (!isset($_COOKIE["username"])) { ?>
            <li class="nav-item">
              <a class="nav-link color_primary fs-4" href="login.php">Iniciar Sesión</a>
            </li>
            <?php
            } else {
              if ($privilegio == 1) { ?>
            <li class="nav-item">
              <a class="nav-link color_primary fs-4" href="administracion.php">Administracion</a>
            </li>
            <?php }?>
            <li class="nav-item">
              <a class="nav-link color_primary fs-4" onclick="deleteAllCookies()" href="login.php">Cerrar Sesión</a>
            </li>
              <?php }?>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>