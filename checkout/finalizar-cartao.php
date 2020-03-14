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

   
  <script>
    var idPlano = "<?php echo $id ?>";
    var nomePlano = "<?php echo $nome ?>";
    var operadora = "<?php echo $operadora ?>";
    var valorPlano = "<?php echo $valor ?>";
    var valorPromocional = "<?php echo $valorPromocional ?>";
    var codigoPlano = "<?php echo $codigoPlano ?>";
    var categoria = "<?php echo $categoria ?>";
    var inclusaoDependentes = "<?php echo $inclusaoDependentes ?>";
    var tipoPlano = "<?php echo $tipo ?>";
    var modalidadePlano = "<?php echo $modalidade ?>";    
  </script>
    
    <title>Checkout Top Prime</title>
</head>

<body>
<div id="target"></div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container">
      <a class="navbar-brand" href="https://topprimesegurosesaude.com.br"><img src="assets/img/logo-padrão@1x-09.png" width="150px" alt="Top Prime Seguros"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSite">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="#" class="nav-link ml-5">Finalizar Compra</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1 class="display-3">Obrigado!</h1>
        <p class="lead">Você acabou de adquirir um produto de ponta, seja Bem-Vindo à família <strong>Top Prime Seguros & Saúde</strong>, clique no link abaixo para retornar ao site.</p>
        <hr>
        <p>
          Dúvidas? <a href="">Fale conosco</a>
        </p>
        <p class="lead">
          <a class="btn btn-primary btn-sm" href="https://topprimesegurosesaude.com.br" style="color: #fff;" id="link-boleto" name="link-boleto" role="button">Voltar ao site</a>
        </p>
      </div>
    </div>
  </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap/bootstrap.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="<?php echo SCRIPT_PAGSEGURO; ?>"></script>
    <script src="assets/plugins/mask-field/jquery.mask.min.js"></script>
    <script src="assets/js/validator.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
</body>

</html>