<?php
$connexion = new mysqli("localhost", "root", "", "cine") or die("not connected" . mysqli_connect_error());
$query_pelicula = "SELECT * FROM peliculas";
$get_peliculas = mysqli_query($connexion, $query_pelicula);
$nums_peliculas = mysqli_num_rows($get_peliculas);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cine-GO4</title>
  <link rel="icon" href="Multimedia/Logos/logo.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <style>
    .card_movie {
      max-width: 350px;
      max-height: 404px;
    }

    .card_movie_img {
      border: #161A1D 3px solid;
      border-radius: 1em;
    }

    .card_movie_img:hover {
      box-shadow: 0px 0px 15px 1px #161A1D;
    }
  </style>
  <?php include 'Layout/header.php'; ?>
  <main class="w-100 py-5 color_black">
    <section id="cartelera" class="container py-5">
      <h3 class="fs-1 text-center mb-5 fw-semibold text-light">Peliculas en cartelera</h3>
      <div class="content-fluid row m-0 justify-content-center">
        <?php
        if ($nums_peliculas <= 0) {
          echo "<h4>No hay peliculas</h4>";
        } else {
          while ($rows_peliculas = mysqli_fetch_array($get_peliculas)) {
        ?>
        <div class="card_movie col-12 col-sm-6 col-lg-3 mb-3">
          <a href="pedidos.php?pelicula=<?= $rows_peliculas['pelicula_id']; ?>">
            <img src='fotos_peliculas/<?= $rows_peliculas["pelicula_id"]; ?>.jpg' alt="<?= $rows_peliculas["nombre"];?>"
              class="w-100 h-100 img-responsive card_movie_img">
          </a>
        </div>
        <?php
          }
        }
        ?>
    </section>
  </main>
  <?php include 'Layout/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>
</body>

</html>