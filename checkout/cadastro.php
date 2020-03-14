<?php 
  error_reporting(E_ALL & ~E_NOTICE); 
  ini_set("display_errors", "On");

  include_once('assets/control/dbcon.php');

  // Informações sobre a contratação
  if(isset($_POST['plano'])){
    $plano = $_POST['plano'];
  };

  if(isset($_POST['produto'])){
    $produto = $_POST['produto'];
  };

  if(isset($_POST['qtd-vidas'])){
    $qtdVidas = $_POST['qtd-vidas'];
  };

  // Validação e Setagem das VARs do Titular
  if(isset($_POST['cpf-titular']) && isset($_POST['nome-titular']) && isset($_POST['nasc-titular']) && isset($_POST['mae-titular']) && isset($_POST['sexo-titular'])){
    $cpfTitular = $_POST['cpf-titular']; // Chave Principal
    $nomeTitular = $_POST['nome-titular'];
    $nascTitular = $_POST['nasc-titular'];
    $maeTitular = $_POST['mae-titular'];
    $sexoTitular = $_POST['sexo-titular'];
  };

  // Validação e Setagem das VARs do Responsável Financeiro
  if(isset($_POST['cpf-resp-financeiro']) && isset($_POST['nome-resp-financeiro']) && isset($_POST['nasc-resp-financeiro']) && isset($_POST['mae-resp-financeiro']) && isset($_POST['sexo-resp-financeiro'])){
    $cpfRespFinanceiro = $_POST['cpf-resp-financeiro']; // Chave Principal
    $nomeRespFinanceiro = $_POST['nome-resp-financeiro'];
    $nascRespFinanceiro = $_POST['nasc-resp-financeiro'];
    $maeRespFinanceiro = $_POST['mae-resp-financeiro'];
    $sexoRespFinanceiro = $_POST['sexo-resp-financeiro'];
  };

  // Valida se Existem Dependentes ou não
  if(isset($_POST['dep']) && $_POST['dep'] == 'sim'){
    // Validação e Setagem das VARs do Dependente 1
    if(isset($_POST['cpf-dep1']) && isset($_POST['nome-dep1']) && isset($_POST['nasc-dep1']) && isset($_POST['mae-dep1']) && isset($_POST['sexo-dep1'])){
      $cpfDep1 = $_POST['cpf-dep1']; // Chave Principal
      $nomeDep1 = $_POST['nome-dep1'];
      $nascDep1 = $_POST['nasc-dep1'];
      $maeDep1 = $_POST['mae-dep1'];
      $sexoDep1 = $_POST['sexo-dep1'];
    };

    // Validação e Setagem das VARs do Dependente 1
    if(isset($_POST['cpf-dep2']) && isset($_POST['nome-dep2']) && isset($_POST['nasc-dep2']) && isset($_POST['mae-dep2']) && isset($_POST['sexo-dep2'])){
      $cpfDep2 = $_POST['cpf-dep2']; // Chave Principal
      $nomeDep2 = $_POST['nome-dep2'];
      $nascDep2 = $_POST['nasc-dep2'];
      $maeDep2 = $_POST['mae-dep2'];
      $sexoDep2 = $_POST['sexo-dep2'];
    };
  };

  // QUERY de Inserção dos dados do Responsável Financeiro
  $sqlCadastroRespFinanceiro = "INSERT INTO dental (nome, cpf, data_nasc, sexo, nome_da_mae, plano, produto, qtd_vidas) VALUES ('$nomeRespFinanceiro', '$cpfRespFinanceiro', '$nascRespFinanceiro', '$sexoRespFinanceiro', '$maeRespFinanceiro', '$plano', '$produto', '$qtdVidas')";

  $resultado1 = mysqli_query($conn, $sqlCadastroRespFinanceiro);

  if($resultado1){
    $_SESSION['status'] = "OK - RespFinanceiro";

    // Salva o ID de Inserção da ultima conexão
    $idTitular = mysqli_insert_id($conn);
    $_SESSION['id'] = $idTitular;

    // QUERY de Inserção dos dados do Titular
    $sqlCadastroTitular = "UPDATE dental SET 
    nome_titular = '$nomeTitular',
    cpf_titular = '$cpfTitular',
    data_nasc_titular = '$nascTitular',
    nome_da_mae_titular = '$maeTitular'
    WHERE id = '$idTitular'";

    if(mysqli_query($conn, $sqlCadastroTitular)){ // Testa se o Titular foi inserido
      $_SESSION['status'] = "OK - Titular";

      if(isset($_POST['dep']) && $_POST['dep'] == 'sim'){ // Testa se existe Dependentes

        $titular = $_SESSION['id'];
        $sqlCadastroDependente1 = "INSERT INTO dependentes (titular, nome, cpf, data_nascimento, sexo, nome_da_mae) VALUES ('$idTitular', '$nomeDep1', '$cpfDep1', '$nascDep1', '$sexoDep1', '$maeDep1')";

        $resultadoDep1 = mysqli_query($conn, $sqlCadastroDependente1);

        if($resultadoDep1){ // Executa a Inserção do DEP1
          $_SESSION['status'] = "OK - DEP1";
        };

        if(isset($_POST['cpf-dep2']) && isset($_POST['nome-dep2']) && isset($_POST['nasc-dep2']) && isset($_POST['mae-dep2']) && isset($_POST['sexo-dep2'])){ // Testa se existe o DEP2

          $sqlCadastroDependente2 = "INSERT INTO dependentes (titular, nome, cpf, data_nascimento, sexo, nome_da_mae) VALUES ('$idTitular', '$nomeDep2', '$cpfDep2', '$nascDep2', '$sexoDep2', '$maeDep2')";

          /* ===*===*=== */

          $resultadoDep2 = mysqli_query($conn, $sqlCadastroDependente2);
          if($resultadoDep2){ // Executa a Inserção do DEP1
            $_SESSION['status'] = "OK - DEP2";
            echo "<script>window.location.href = 'index.php';</script>";
          };
        };        
      };
      echo "<script>window.location.href = 'index.php';</script>";
    };
  };

?>