<?php
  session_start();
  /* Dados do Banco de Dados a conectar */
  $servername = "vps.nexusnx.com";
  $database = "clientes";
  $username = "root";
  $password = "*********";

  $conn = mysqli_connect($servername, $username, $password, $database);
  if (!$conn) {
      echo "<script> console.log('Erro ao Conectar ao MySql') </script>";
      die("Connection failed: " . mysqli_connect_error());
  }

  echo "<script> console.log('Conectado ao MySql') </script>";
?>