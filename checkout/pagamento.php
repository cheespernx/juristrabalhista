<?php 
  include_once('assets/control/pagseguro.php');

  $url = 'https://api.pagar.me/1/subscriptions';

  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8"));
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $retorno = curl_exec($curl);
  curl_close($curl);
  $xml = simplexml_load_string($retorno);
  echo json_encode($xml);
?>