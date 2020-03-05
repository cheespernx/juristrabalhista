<?php
  /* Dados do Banco de Dados a conectar */
  $servername = "sql170.main-hosting.eu";
  $database = "u668533246_juristrab";
  $username = "u668533246_juristrab";
  $password = "aw96b6k13751";
  $conn = mysqli_connect($servername, $username, $password, $database);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>