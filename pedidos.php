<?php
  $connexion = new mysqli("localhost","root","","cine") or die ("not connected".mysqli_connect_error());
  
  $query_pelicula = "SELECT * FROM peliculas left JOIN generos using(genero_id) left join restricciones USING(restriccion_id) WHERE pelicula_id=".$_GET['pelicula'];
  $get_peliculas = mysqli_query($connexion,$query_pelicula);
  $rows_peliculas = mysqli_fetch_array($get_peliculas);

  $query_funciones = "SELECT * FROM entradas inner join funciones USING(funcion_id) WHERE entrada_id=1";
  $get_funciones = mysqli_query($connexion,$query_funciones);
  $row_funciones = mysqli_fetch_array($get_funciones);
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'Layout/header.php';?>
<style> 
  .modal{
    --bs-modal-width: 50vw;
  }
  .card_movie_buy{
    background: #0B090A;
    color: #B1A7A6;
    border: #B1A7A6 2px solid;;
    border-radius: 10px;
  }
  .card_movie_buy li{
    border-bottom: 1px solid #B1A7A6;
  } 
  .asientos img{
    width: 60px;
    height: 60px;
  }
  .asientos img:hover{
    cursor: pointer;
  }
  #Btn_SS{
    width: 300px !important;
  }
  .modal-content,.modal-dialog{
    width: 50vw !important;
  }
  select{
    width: 120px;
    border-radius: 10px;
    outline: none;
  }
</style>
<main class="w-100 p-5">
  <h2 class="text-center fs-1 color_wt"><?=$rows_peliculas['nombre']?></h2>
  <div class="container-lg p-3 row mx-auto flex-wrap-reverse flex-md-nowrap">
    <div class="col-12 col-md-9 mt-3 p-0 d-flex flex-column">
          <span class="fs-2 text-center d-block color_wt">Comprar entradas</span>
          <form action="">
            <div class="my-3">
              <label for="funcion_formato" class="fs-4 me-3 color_wt">Selecciona formato: </label>
              <select name="formato" id="funcion_formato" class="text-center p-1">
                <option value="2">2D</option>
                <option value="1">3D</option>
                <option value="3">4DX</option>
              </select>
            </div>
            <div class="my-3">
              <label for="funcion_horario" class="fs-4 me-3 color_wt">Selecciona un horario: </label>
              <select name="" id="funcion_horario" class="text-center p-1">
                <option value="">19:30</option>
                <option value="">19:30</option>
                <option value="">19:30</option>
              </select>
            </div>
            <div class="my-3">
              <label for="Btn_SS" class="fs-4 me-3 color_wt">Selecciona un asiento: </label>
              <!-- Button trigger modal -->
              <button id="Btn_SS" type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#ModalAsientos">
                Seleccione asiento
              </button>

              <!-- Modal -->
              <div class="modal fade" id="ModalAsientos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content bg-black">
                    <div class="modal-header">
                      <h3 class="modal-title fs-5 color_wt" id="exampleModalLabel">Seleccione asientos deseados</h3>
                      <button type="button" class="btn color_wt" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x color_wt fs-4"></i></button>
                    </div>
                    <div class="modal-body">
                      <div class="mt-4 asientos w-100">
                        <?php 
                          $seat_active = array(); 
                          for ($i=1;$i<=12;$i++){
                            $char = 64 + $i;
                            $row = chr($char);
                            if($i==3){
                              echo "<div class='w-100' style='height:60px;'></div>";
                            }
                            echo "<div class='d-flex flex-row' name='row' value='$row'>";
                            if($i<=2){
                              echo "<div style='width: 120px;'></div>"; 
                              for($j=1;$j<=10;$j++){
                                  if($j==6){
                                    echo "<div style='width: 60px;'></div>"; 
                                  }
                                  $asiento = $row . strval($j);
                                  if($row_funciones['codigo_asiento'] == $asiento){
                                    echo "<div class='d-inline' value='$row$j'><img src='Multimedia/Sillas/seat-occupied.png' alt='asiento' value='$row$j'></div>";
                                  }else{
                                    echo "<div class='d-inline' value='$row$j'><img src='Multimedia/Sillas/seat-free.png' alt='asiento' 
                                    onclick='seat_active(`$row`,$j)'></div>";
                                  } 
                                } 
                              echo "<div style='width: 120px;'></div>"; 
                            }
                            if($i>2 and $i<11){
                              echo "<div style='width: 60px;'></div>"; 
                              for($j=1;$j<=9;$j++){
                                $asiento = $row . strval($j);
                                if($j==3 or $j==8){
                                  echo "<div style='width: 120px;'></div>"; 
                                }
                                if($row_funciones['codigo_asiento'] == $asiento){
                                  echo "<div class='d-inline' value='$row$j'><img src='Multimedia/Sillas/seat-occupied.png' alt='asiento' value='$row$j'></div>";
                                }else{
                                  echo "<div class='d-inline' value='$row$j'><img src='Multimedia/Sillas/seat-free.png' alt='asiento' 
                                  onclick='seat_active(`$row`,$j)'></div>";
                                }
                              }
                              echo "<div style='width: 60px;'></div>"; 
                            }
                            if($i>11){
                              for($j=1;$j<=15;$j++){
                                $asiento = $row . strval($j);
                                if($row_funciones['codigo_asiento'] == $asiento){
                                  echo "<div class='d-inline' value='$row$j'><img src='Multimedia/Sillas/seat-occupied.png' alt='asiento' value='$row$j'></div>";
                                }else{
                                  echo "<div class='d-inline' value='$row$j'><img src='Multimedia/Sillas/seat-free.png' alt='asiento' 
                                  onclick='seat_active(`$row`,$j)'></div>";
                                }
                              }
                            }
                            echo "</div>";
                          }
                          ?>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" onclick="save_seats()" data-bs-dismiss="modal">Save changes</button>
                    </div>
                  </div>
                </div> 
              </div>
              <input type="hidden" name="arr" id="arr">
            </div>
            <div class="my-3">
              <label for="funcion_mpago" class="fs-4 me-3 color_wt">Forma de pago: </label>
              <select name="funcion_mpago" id="funcion_mpago" class="text-center p-1">
                <option value="1">Débito</option>
                <option value="2">Crédito</option>
                <option value="3">Efectivo</option>
              </select>
            </div>             
            <div class="d-flex justify-content-center my-5">
              <button type="submit" class="btn btn-dark mx-auto p-3">Comprar entradas</button>
            </div>
          </form>
    </div>
    <div class="col-12 col-md-3 p-2 card_movie_buy d-flex flex-column align-items-center h-50">
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
<script src="https://code.jquery.com/jquery-3.6.1.min.js"integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="pedidos.js"></script>
</body>
</html>