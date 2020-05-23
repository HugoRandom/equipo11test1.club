<?php
  include("conexion.php");

  $Boton = 'true';
  $TuIP = get_client_ip();
  $Fecha = date("Ymd");
  $Hora = date("His");

  $sql = "INSERT INTO Votacion (boton, ip, fecha, hora) VALUES ($Boton, '$TuIP', $Fecha, $Hora)";

  echo $sql;

  mysqli_query($conn, $sql);
  mysqli_close($conn);

  header('Location: index.php')

?>
