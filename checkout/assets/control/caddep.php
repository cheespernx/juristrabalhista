<?php 
session_start();
include 'dbcon.php';
$idInsert = $_SESSION['insertId'];

$statusDep = $_GET['dep'];

  if($statusDep == '1'){
    $nomeDep1 = $_POST['nomeDep1'];
    $nascDep1 = $_POST['nascDep1'];
    $maeDep1 = $_POST['maeDep1'];
    $sexoDep1 = $_POST['sexoDep1'];
    $cpfDep1 = $_POST['cpfDep1'];

    $sqlDep1 = "INSERT INTO dependentes (titular, nome, cpf, data_nascimento, sexo, nome_da_mae) VALUES ('$idInsert', '$nomeDep1', '$cpfDep1', '$nascDep1','$sexoDep1', '$maeDep1')";

    if(mysqli_query($conn, $sqlDep1)){
      echo "<script>console.log('Dependentes Incluidos com sucesso')</script>";
    };
  }
  if($statusDep == '2'){
    $nomeDep1 = $_POST['nomeDep1'];
    $nascDep1 = $_POST['nascDep1'];
    $maeDep1 = $_POST['maeDep1'];
    $sexoDep1 = $_POST['sexoDep1'];
    $cpfDep1 = $_POST['cpfDep1'];

    $sqlDep = "INSERT INTO dependentes (titular, nome, cpf, data_nascimento, sexo, nome_da_mae) VALUES ('$idInsert', '$nomeDep1', '$cpfDep1', '$nascDep1','$sexoDep1', '$maeDep1');";

    $nomeDep2 = $_POST['nomeDep2'];
    $nascDep2 = $_POST['nascDep2'];
    $maeDep2 = $_POST['maeDep2'];
    $sexoDep2 = $_POST['sexoDep2'];
    $cpfDep2 = $_POST['cpfDep2'];

    $sqlDep .= "INSERT INTO dependentes (titular, nome, cpf, data_nascimento, sexo, nome_da_mae) VALUES ('$idInsert', '$nomeDep2', '$cpfDep2', '$nascDep2','$sexoDep2', '$maeDep2')";

    if(mysqli_multi_query($conn, $sqlDep)){
      echo "<script>console.log('Dependentes Incluidos com sucesso')</script>";
    }
  }

  echo "<script>console.log('".mysqli_affected_rows($conn)."');</script>";
  return $result;
?>