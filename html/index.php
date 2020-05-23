<?php
  include("conexion.php");
  $TuIP = get_client_ip();
  $sql = "SELECT boton, fecha, hora, ip FROM Votacion";
  $sql2 = "SELECT ip FROM Votacion";
  $Result = mysqli_query($conn, $sql);
  $Result2 = mysqli_query($conn, $sql2);
  $Aux = 1;
  $Si = 0;
  $No = 0;
?>

<!DOCTYPE html>
<html>
<head>
  <title>
    Equipo #11
  </title>
  <meta name="viewport" content="initial-scale=1.0">
  <meta charset="utf-8">

  <!-- CSS Bootstrap-->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body class="container bg-light">
  <div class="container bg-white">

    <!-- Texto Inicial -->
    <br>
    <div class="row justify-content-center border border-dark rounded-pill p-2 bg-dark text-white">
      <br>
      <div class="col-10">
        <h1 class="text-center">
          BIENVENIDOS A NUESTRA PAGINA WEB
        </h1>
      </div>
      <div class="col-10">
        <h2 class="text-center font-weight-bold">
          Equipo #11 - Presentes por la Patria
        </h2>
      </div>
      <div class="col-10">
        <h3 class="text-center font-italic">
          ¡Corriendo con PHP!
        </h2>
      </div>
    </div>
    <br>

    <!-- Datos actuales para que los gozen-->
    <div class="row justify-content-center p-2">
      <div class="col-5 border border-dark rounded p-2 table-secondary mr-3">
        <h4 class="text-center">
          <div class="font-weight-bold">
            Tu Direccion IP:
          </div>
          <?php echo $TuIP ?></h4>
      </div>
      <div class="col-5 border border-dark rounded p-2 table-secondary">
        <h4 class="text-center">
          <div class="font-weight-bold">
            Fecha y Hora (Servidor):
          </div>
          <?php echo date("Y-M-d H:i:s"); ?>
        </h4>
      </div>
    </div>

    <!-- Voy a revisar cada IP para que no haya trampas -->
    <?php
      while ($L2 = mysqli_fetch_array($Result2))
      {
        if ($TuIP == $L2[0]) {
          $Aux = 0;
        }
      }
    ?>

    <!-- Para la gente que no haya votado-->
    <?php if ($Aux == 1): ?>
    <br>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <form class="form-horizontal" action="guardarSi.php" method="post">
          <button type="submit" class="btn btn-success btn-lg btn-block">
            SI
          </button>
        </form>
      </div>
      <div class="col-md-4">
        <form class="form-horizontal" action="guardarNo.php" method="post">
          <button type="submit" class="btn btn-danger btn-lg btn-block">
            NO
          </button>
        </form>
      </div>
    </div>
    <br>
    <?php endif; ?>

    <!-- Para la gente YA votó-->
    <?php if($Aux == 0): ?>
      <br>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading">¡Gracias por tu Voto!</h4>
        <p> Cada voto es importante para nosotros y agradecemos de tu participación.</p>
      </div>
    <?php endif; ?>

    <!-- Texto de Listado :v-->
    <div class="row justify-content-center ">
      <div class="col">
        <div class="alert alert-dark text-center border border-dark" role="alert">
          <h3 class="text-uppercase"> Listado de Votos actuales. </h3>
        </div>
      </div>
    </div>
    <div class="bg-dark">
      <hr>
    </div>

    <!-- Tabla de Votos-->
    <div class="row justify-content-center ">
      <table class="table table-sm border border-dark text-center">
        <thead class="bg-dark text-white">
          <tr class="text-center font-weight-bold">
            <td>
              Voto
            </td>
            <td>
              Fecha
            </td>
            <td>
              Hora
            </td>
            <td >
              IP
            </td>
          </tr>
        </thead>
        <tbody>
          <?php
           // Proceso donde uso la base de datos y me tiro a la droga.
            while ($L = mysqli_fetch_array($Result))
            {
              echo "<tr";
              for ($i=0; $i<4; $i++)
              {
                if ($i == 0){
                  if ($L[$i] == 1) {
                    echo " class='table-success'>\n\t\t<td> Si </td>\n";
                    $Si++;
                  }
                  else {
                    echo " class='table-danger'>\n\t\t<td> No </td>\n";
                    $No++;
                  }
                }
                else {
                  echo "\t\t<td> $L[$i] </td>\n";
                }
              }
              echo "\t</tr>\n";
            }
          ?>
        </tbody>
      </table>
    </div>

    <!-- Cantidades de Votos -->
    <div class="form-row justify-content-center">
      <div class="col-4 text-center">
        <label class="text-font-weight">
           <u>Cantidad de Si:</u>
          <strong> <?php echo $Si; ?> </strong>
        </label>
      </div>
      <div class="col-4 text-center">
        <label class="text-font-weight">
          <u>Cantidad de No:</u>
          <strong> <?php echo $No; ?> </strong>
        </label>
      </div>
    </div>
  </div>
</body>
<hr>
<br>
<!-- Aqui tendria que ir algo mas, pero me dio weba ->
<?php
  mysqli_close($conn);
?>
