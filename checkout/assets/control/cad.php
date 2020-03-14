<?php 

session_start();
//header('Content-Type: application/json; charset=utf-8');
include 'dbcon.php';
/*
$Dados1 = file_get_contents('php://input');

$Dados = json_decode($Dados1, true);

$nome = $Dados["nome-resp-financeiro"];
$email = $Dados["senderEmail"];
$ddd = $Dados["senderAreaCode"];
$telefone_cel = $Dados["senderPhone"];
$data_nasc = $Dados["nasc-resp-financeiro"];
$cpf = $Dados["cpf-resp-financeiro"];
$sexo = $Dados["sexo-resp-financeiro"];
$nome_da_mae = $Dados["mae-resp-financeiro"];
$nome_titular = $Dados["nome-titular"];
$data_nasc_titular = $Dados["nasc-titular"];
$cpf_titular = $Dados["cpf-titular"];
$sexo_titular = $Dados["sexo-titular"];
$nome_da_mae_titular = $Dados["mae-titular"];
$cep = $Dados["shippingAddressPostalCode"];
$uf = $Dados["shippingAddressState"];
$cidade = $Dados["shippingAddressCity"];
$rua = $Dados["shippingAddressStreet"];
$bairro = $Dados["shippingAddressDistrict"];
$numero = $Dados["shippingAddressNumber"];
$complemento = $Dados["shippingAddressComplement"];
$plano = $Dados["itemDescription1"];
$produto = $Dados["produto"];
$tipo_user = 'Cliente';
$qtd_vidas = $Dados["itemQuantity1"];
$valor = $Dados["valorTotalPlano"];
$status_pedido = 'Pedido';

*/
/*
$nome = $_POST["nome-resp-financeiro"];
$email = $_POST["senderEmail"];
$ddd = $_POST["senderAreaCode"];
$telefone_cel = $_POST["senderPhone"];
$data_nasc = $_POST["nasc-resp-financeiro"];
$cpf = $_POST["cpf-resp-financeiro"];
$sexo = $_POST["sexo-resp-financeiro"];
$nome_da_mae = $_POST["mae-resp-financeiro"];
$nome_titular = $_POST["nome-titular"];
$data_nasc_titular = $_POST["nasc-titular"];
$cpf_titular = $_POST["cpf-titular"];
$sexo_titular = $_POST["sexo-titular"];
$nome_da_mae_titular = $_POST["mae-titular"];
$cep = $_POST["shippingAddressPostalCode"];
$uf = $_POST["shippingAddressState"];
$cidade = $_POST["shippingAddressCity"];
$rua = $_POST["shippingAddressStreet"];
$bairro = $_POST["shippingAddressDistrict"];
$numero = $_POST["shippingAddressNumber"];
$complemento = $_POST["shippingAddressComplement"];
$plano = $_POST["itemDescription1"];
$produto = $_POST["produto"];
$tipo_user = 'Cliente';
$qtd_vidas = $_POST["itemQuantity1"];
$valor = $_POST["valorTotalPlano"];
$status_pedido = 'Pedido';*/



$codigo = $_POST["codigo"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$ddd = $_POST["ddd"];
$telefone_cel = $_POST["telefone_cel"];
$data_nasc = $_POST["data_nasc"];
$cpf = $_POST["cpf"];
$sexo = $_POST["sexo"];
$nome_da_mae = $_POST["nome_da_mae"];
$nome_titular = $_POST["nome_titular"];
$data_nasc_titular = $_POST["data_nasc_titular"];
$cpf_titular = $_POST["cpf_titular"];
$sexo_titular = $_POST["sexo_titular"];
$nome_da_mae_titular = $_POST["nome_da_mae_titular"];
$cep = $_POST["cep"];
$uf = $_POST["uf"];
$cidade = $_POST["cidade"];
$rua = $_POST["rua"];
$bairro = $_POST["bairro"];
$numero = $_POST["numero"];
$complemento = $_POST["complemento"];
$plano = $_POST["plano"];
$produto = $_POST["produto"];
$tipo_user = 'Cliente';
$qtd_vidas = $_POST["qtd_vidas"];
$valor = $_POST["valor"];
$status_pedido = 'Pedido';
$statusDep = $_POST['statusDep'];

$sql = "INSERT INTO dental (codigo, nome, email, ddd, telefone_cel, data_nasc, cpf, sexo, nome_da_mae, nome_titular, data_nasc_titular, cpf_titular, sexo_titular, nome_da_mae_titular, cep, uf, cidade, rua, bairro, numero, complemento, plano, produto, tipo_user, qtd_vidas, valor, status_pedido, data_cad) VALUES ('$codigo', '$nome', '$email', '$ddd', '$telefone_cel', '$data_nasc', '$cpf', '$sexo', '$nome_da_mae', '$nome_titular', '$data_nasc_titular', '$cpf_titular', '$sexo_titular', '$nome_da_mae_titular', '$cep', '$uf', '$cidade', '$rua', '$bairro', '$numero', '$complemento', '$plano', '$produto', '$tipo_user', '$qtd_vidas', '$valor', '$status_pedido',  NOW())";

if(mysqli_query($conn, $sql)){
  $result = mysqli_affected_rows($conn);
  $_SESSION['insertId'] = mysqli_insert_id($conn);

  echo "<script>console.log('".$_SESSION['insertId']."')</script>";

  echo "<script>console.log('".mysqli_affected_rows($conn)."');</script>";
  return $result;
} else {
  echo "<script>console.log('".mysqli_error($conn)."');</script>";
}
?>