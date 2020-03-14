<?php
  session_start();
  $notificationCode = $_POST['notificationCode'];
  //$data['token'] = '2c708b4a-3544-4e4a-a4e2-0434cfc99a4f32a5c02e4065a1ae3e0cdfe23a0a554d08d5-0317-47aa-a12a-d9f27eb971be';
  $data['token'] = '5B56B51400CE46F2B75FF66672061652';
  $data['email'] = 'contato@topprimesegurosesaude.com.br';

  $data = http_build_query($data);

  // $url = 'https://sandbox.api.pagseguro.com/digital-payments/v1/transactions/'.$notificationCode;
  $url = 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?'.$data;

  $curl = curl_init($url);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
  $xml = curl_exec($curl);
  curl_close($curl);

  $xml= simplexml_load_string($xml);

  echo $xml->status;
  echo $xml->code;
    
  $reference = $xml -> reference;
  $status = $xml -> status;
  $paymentMethod = $xml -> paymentMethod;
  $codigo = $xml -> transaction_code;
  //$status = $xml -> status -> description;
  //$codigo = $xml -> transaction -> code;

    include_once('dbcon.php');
    $queryStatusPedido = "SELECT * FROM dental WHERE codigo = '$codigo'";
    $sqlStatusPedido = mysqli_query($conn, $queryStatusPedido);
    $result = mysqli_num_rows($sqlStatusPedido);
    if($result == 1){
      $queryAtualizaStatusPedido = "UPDATE dental SET status_pgto = '$status' WHERE codigo = '$codigo'";
      $sqlAtualizaStatusPedido = mysqli_query($conn, $queryAtualizaStatusPedido);
      $_SESSION['status_pgto'] = $status;
    }
?>