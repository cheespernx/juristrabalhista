<?php 
    session_start();
    include_once('assets/control/calculo.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/37212eb3e5.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/style.css" />

    <title>JurisTrabalhista</title>

</head>

<body>
<div id="target"></div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container">
      <a class="navbar-brand" href="https://juristrabalhista">Juris<b>Trabalhista</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSite">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="#" class="nav-link ml-5"><img src="https://img.icons8.com/metro/20/000000/1-circle.png"> - Checkout <i class="fas fa-check"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <button id="pay-button">Abrir modal de pagamento</button>
    </div>
  </div>
  

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap/bootstrap.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://assets.pagar.me/checkout/checkout.js"></script>
   
    <script src="assets/plugins/mask-field/jquery.mask.min.js"></script>
    <script src="assets/js/validator.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
    <script>
      $(document).ready(function() {
          var button = $('#pay-button');

          button.click(function() {

              // INICIAR A INSTÂNCIA DO CHECKOUT
              // declarando um callback de sucesso
              var checkout = new PagarMeCheckout.Checkout({"encryption_key":"ek_live_K1gbuoUcypATT2oI68pwWD78rzF2cD", success: function(data) {
                  console.log(data);
                  //Tratar aqui as ações de callback do checkout, como exibição de mensagem ou envio de token para captura da transação
              }});

              // DEFINIR AS OPÇÕES
              // e abrir o modal
              // É necessário passar os valores boolean em "var params" como string
              var params = {"customerData":"false", "amount":"29.90", "createToken": "false", "interestRate": 10 };
              checkout.open(params);
          });
      });
    </script>
</body>

</html>