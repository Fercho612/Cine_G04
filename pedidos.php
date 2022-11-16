<?php
  $connexion = new mysqli("localhost","root","","cine") or die ("not connected".mysqli_connect_error());
  
  $query_pelicula = "SELECT * FROM peliculas left JOIN generos using(genero_id) left join restricciones USING(restriccion_id) WHERE pelicula_id=".$_GET['pelicula'];
  $get_peliculas = mysqli_query($connexion,$query_pelicula);
  $rows_peliculas = mysqli_fetch_array($get_peliculas);

  $query_salas = "SELECT * FROM salas WHERE sala_id='1'";
  $get_salas = mysqli_query($connexion,$query_salas);
  $row_sala = mysqli_fetch_array($get_salas);
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
<style> 
  .card_movie_buy{
    background: #0B090A;
    color: #F5F3F4;
    border: #F5F3F4 2px solid;;
    border-radius: 10px;
  }
  .card_movie_buy li{
    border-bottom: 1px solid #F5F3F4;
  } 
  .asientos img{
    width: 45px;
    height: 45px;
  }
</style>
<main class="w-100 p-5">
  <h2 class="text-center fs-1"><?=$rows_peliculas['nombre']?></h2>
  <div class="container-lg p-3 row mx-auto justify-content-between flex-wrap-reverse">
    <div class="col-12 col-md-9 mt-3 p-0 d-flex justify-content-center">
        <div class="">
          <span class="fs-2 text-center d-block">Comprar entradas</span>
          <div class="mt-4 asientos">
            <?php 
              for ($i=0;$i<$row_sala['num_asientos'];$i++){
            ?>
              <img src="Multimedia/Sillas/seat-free.png" alt="">
            <?php } ?>
          </div>
        </div>
    </div>
    <div class="col-12 col-md-3 p-2 card_movie_buy d-flex flex-column align-items-center">
      <img class="w-75" src='Multimedia/Peliculas/<?=$rows_peliculas['ruta_imagen']?>' alt="">
      <ul class="p-0 mt-4 ">
          <li class="carac_peli fs-5 py-2 w-100">Director: <?=$rows_peliculas['director']?></li>
          <li class="carac_peli fs-5 py-2 w-100">Duración: <?=$rows_peliculas['duracion']?> min</li>
          <li class="carac_peli fs-5 py-2 w-100">Género: <?=$rows_peliculas['genero']?></li>
          <li class="carac_peli fs-5 py-2 w-100">Restricción: <?=$rows_peliculas['restriccion']?></li>
        </ul>
    </div>
  </div>  
</main>

<?php include 'Layout/footer.php';?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>