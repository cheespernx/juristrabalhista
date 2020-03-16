<?php

  $servername = "sql170.main-hosting.eu";
  $database = "u668533246_juristrab";
  $username = "u668533246_juristrab";
  $password = "aw96b6k13751";

  $conn = mysqli_connect($servername, $username, $password, $database);
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  if(isset($_GET['plano'])){
    $nome = $_GET['plano'];
  } else {
    $nome = "premium";
  }
  

  $querySelecaoProdutos = "SELECT * FROM plano WHERE nome = '$nome'";

  $execQuery = mysqli_query($conn, $querySelecaoProdutos);

  if($execQuery){
    $data = mysqli_fetch_assoc($execQuery);
    $id = $data['id'];
    $nome = $data['nome'];
    $valor = $data['valor'];
  }

// ===\===\===\===\=== SISTEMA DE CÁLCULO END ===\===\===\===\===\===\===\===

