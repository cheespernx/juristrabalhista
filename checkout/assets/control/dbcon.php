<?php

/*
*
* @return \PDO
*/

/*
function getConnection(){

  $dsn = 'mysql:host=vps.nexusnx.com;dbname=clientes';
  $user = 'root';
  $pass = 'aw96b6k13751';
  
  try {
    $pdo = new PDO($dsn, $user, $pass);
    return $pdo;
  } catch (PDOException $ex) {
    echo 'Erro: '.$ex->getMessage();
  }
}
*/

  // session_start();
  /* Dados do Banco de Dados a conectar */
  
  $servername = "vps.nexusnx.com";
  $database = "clientes";
  $username = "root";
  $password = "aw96b6k13751";

  $conn = mysqli_connect($servername, $username, $password, $database);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
?>