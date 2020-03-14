<?php

  $servername = "vps.nexusnx.com";
  $database = "produtos";
  $username = "root";
  $password = "aw96b6k13751";

  $conn = mysqli_connect($servername, $username, $password, $database);
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  if(isset($_GET['plano'])){
    $codigo = $_GET['plano'];
  } else {
    $codigo = "AMIL-DENT-F-M";
  }
  

  $querySelecaoProdutos = "SELECT * FROM odontologico WHERE codigo = '$codigo'";

  $execQuery = mysqli_query($conn, $querySelecaoProdutos);

  if($execQuery){
    $data = mysqli_fetch_assoc($execQuery);
    $id = $data['id'];
    $nome = $data['nome'];
    $operadora = $data['operadora'];
    $valor = $data['valor'];
    $valorPromocional = $data['valor_promocional'];
    $codigoPlano = $data['codigo'];
    $categoria = $data['categoria'];
    $inclusaoDependentes = $data['inclusao_dependentes'];
    $tipo = $data['tipo'];
    $modalidade = $data['modalidade'];
  }

// ===\===\===\===\=== SISTEMA DE CÁLCULO END ===\===\===\===\===\===\===\===

