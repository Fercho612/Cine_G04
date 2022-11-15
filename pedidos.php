<?php
  $connexion = new mysqli("localhost","root","","cine") or die ("not connected".mysqli_connect_error());
  $query_pelicula = "SELECT * FROM peliculas left JOIN generos using(genero_id) left join restricciones USING(restriccion_id)";
  $get_peliculas = mysqli_query($connexion,$query_pelicula);
  $rows_peliculas = mysqli_fetch_array($get_peliculas);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cine-GO4 - <?=$rows_peliculas['nombre']?></title>
  <link rel="icon" href="Multimedia/Logos/logo.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'Layout/header.php';?>

<main class="w-100 p-5">
  <div class="container-lg d-flex p-3 justify-content-between">
    <div class="w-50">
        <h2 class="text-center fs-1"><?=$rows_peliculas['nombre']?></h2>

        <div class="p-5">
          <span class="fs-2">Comprar entradas</span>
        </div>
    </div>
    <div class="p-2 card_movie_buy">
      <img class="" src='Multimedia/Peliculas/<?=$rows_peliculas['ruta_imagen']?>' alt="">
      <ul class="p-0 mt-4 d-flex flex-column">
          <li class="carac_peli fs-5 p-2">Director: <?=$rows_peliculas['director']?></li>
          <li class="carac_peli fs-5 p-2">Duración: <?=$rows_peliculas['duracion']?> min</li>
          <li class="carac_peli fs-5 p-2">Género: <?=$rows_peliculas['genero']?></li>
          <li class="carac_peli fs-5 p-2">Restricción: <?=$rows_peliculas['restriccion']?></li>
        </ul>
    </div>
  </div>  
</main>

<?php include 'Layout/footer.php';?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>