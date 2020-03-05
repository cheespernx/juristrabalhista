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
<title>Juristrabalhista</title>
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
                Victor Carvalho
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <i class="material-icons">person</i>
                    <span class="sidebar-normal"> Meu Perfil </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <i class="material-icons">edit</i>
                    <span class="sidebar-normal"> Editar Perfil </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="sair.php">
                    <i class="material-icons">close</i>
                    <span class="sidebar-normal"> Sair </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="examples/dashboard.html">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item <?php echo $collapse == 'conteudo' ? 'active':''; ?>">
            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
              <i class="material-icons">image</i>
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
                    <span class="sidebar-normal"> Julgados Salvos </span>
                  </a>
                </li>
                <li class="nav-item <?php echo $pagina == 'pecas' ? 'active':''; ?>">
                  <a class="nav-link" href="#">
                    <i class="material-icons">book</i>
                    <span class="sidebar-normal"> Peças </span>
                  </a>
                </li>
              </ul>
            </div>
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