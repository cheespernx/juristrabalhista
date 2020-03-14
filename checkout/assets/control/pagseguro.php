<?php 

  define("URL", "https://topprimesegurosesaude.com.br/checkout/");
  $sandbox = false;

  if($sandbox){ // Caso seja Sandbox
    define("EMAIL_PAGSEGURO", "contato@topprimesegurosesaude.com.br");
    define("MOEDA_PAGAMENTO", "BRL");
    define("URL_NOTIFICACAO", "http://prime.topprimesegurosesaude.com.br/admin/notificacao.php");
    define("EMAIL_LOJA", "contato@topprimesegurosesaude.com.br");
    define("TOKEN_PAGSEGURO", "5B56B51400CE46F2B75FF66672061652");
    define("URL_PAGSEGURO", "https://ws.sandbox.pagseguro.uol.com.br/v2/");
    define("SCRIPT_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
  } else { // Caso seja Produção
    define("MOEDA_PAGAMENTO", "BRL");
    define("URL_NOTIFICACAO", "http://prime.topprimesegurosesaude.com.br/admin/notificacao.php");
    define("EMAIL_LOJA", "contato@topprimesegurosesaude.com.br");
    define("EMAIL_PAGSEGURO", "contato@topprimesegurosesaude.com.br");
    define("TOKEN_PAGSEGURO", "2c708b4a-3544-4e4a-a4e2-0434cfc99a4f32a5c02e4065a1ae3e0cdfe23a0a554d08d5-0317-47aa-a12a-d9f27eb971be");
    define("URL_PAGSEGURO", "https://ws.pagseguro.uol.com.br/v2/");
    define("SCRIPT_PAGSEGURO", "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
  };
?>