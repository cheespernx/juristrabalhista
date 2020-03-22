<?php
  session_start();
  $pagina = $_SESSION['pagina'];
  $collapse = $_SESSION['collapse'];
  $_SESSION['pagina'] = '';
  $_SESSION['collapse'] = '';
?>
<!doctype html>
<html lang="pt-br">

<head>
<title>Adminstração Juristrabalhista</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<!-- Material Kit CSS -->
<link href="assets/css/.min.css?v=2.1.1" rel="stylesheet" />
<link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
<link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body>
  <div class="sidebar" data-color="rose" data-background-color="black" data-image="assets/img/sidebar-1.jpg">
<!--
Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

Tip 2: you can also add an image using data-image tag
-->
      <div class="logo">
        <a href="https://juristrabalhista.com" class="simple-text logo-mini">
          JT
        </a>
        <a href="https://juristrabalhista.com" class="simple-text logo-normal">
          Juris<b>Trabalhista</b>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="assets/img/default-avatar.png"/>
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                <?php echo $_SESSION['user']; ?>
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item <?php echo $pagina == 'user' ? 'active':''; ?>">
                  <a class="nav-link" href="user.php">
                    <i class="material-icons">person</i>
                    <span class="sidebar-normal"> Meu Perfil </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../sair.php">
                    <i class="material-icons">close</i>
                    <span class="sidebar-normal"> Sair </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item <?php echo $pagina == 'index' ? 'active':''; ?>">
            <a class="nav-link" href="index.php">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item <?php echo $collapse == 'conteudo' ? 'active':''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
              <i class="material-icons">sort</i>
              <p> Conteúdo
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="pagesExamples">
              <ul class="nav">
                <li class="nav-item <?php echo $pagina == 'julgados' ? 'active':'';?>">
                  <a class="nav-link" href="julgados.php">
                    <i class="material-icons">library_books</i>
                    <span class="sidebar-normal"> Julgados </span>
                  </a>
                </li>
                <li class="nav-item <?php echo $pagina == 'julgados_favoritos' ? 'active':''; ?>">
                  <a class="nav-link" href="julgados_favoritos.php">
                    <span class="sidebar-mini"> <i class="material-icons">favorite</i> </span>
                    <span class="sidebar-normal"> Meus Julgados Salvos </span>
                  </a>
                </li>
                <li class="nav-item <?php echo $pagina == 'pecas' ? 'active':''; ?>">
                  <a class="nav-link" href="modelo_pecas.php">
                    <i class="material-icons">menu_book</i>
                    <span class="sidebar-normal"> Modelos de Peças </span>
                  </a>
                </li>
                <li class="nav-item <?php echo $pagina == 'podcast' ? 'active':''; ?>">
                  <a class="nav-link" href="podcasts.php">
                    <i class="material-icons">mic</i>
                    <span class="sidebar-normal"> PodCasts </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item <?php echo $pagina == 'configuracoes' ? 'active':''; ?>">
            <a class="nav-link" href="#">
              <i class="material-icons">build</i>
              <p> Configurações </p>
            </a>
          </li>
          <li class="nav-item <?php echo $pagina == 'produtos' ? 'active':''; ?>">
            <a class="nav-link" href="planos.php">
              <i class="material-icons">add_shopping_cart</i>
              <p> Produtos </p>
            </a>
          </li>
          <li class="nav-item <?php echo $pagina == 'faturamento' ? 'active':''; ?>">
            <a class="nav-link" href="#">
              <i class="material-icons">payment</i>
              <p> Faturamento </p>
            </a>
          </li>
        </ul>
    </div>
  </div>
</body>
</html>