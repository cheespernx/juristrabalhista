<!doctype html>
<html lang="pt-br">

<head>
  <title>Administração JurisTrabalhista</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="../assets/css/.min.css?v=2.1.1" rel="stylesheet" />
  <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
      <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
          <a class="navbar-brand" href="#">Área do Administrador</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon icon-bar"></span>
          <span class="navbar-toggler-icon icon-bar"></span>
          <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">notifications</i>
                <span class="notification"><?php echo $novosPedidos; ?></span>
                <p class="d-lg-none d-md-block">
                  Ações
                </p>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <?php while ($pedidop = mysqli_fetch_assoc($sqlp)) { ?>
                  <a class="dropdown-item" href="vieworder.php?id=<?php echo $pedidop['id'] ?>">Novo pedido de <?php echo $pedidop['nome'] ?></a>
                <?php } ?>
              </div>
            </li>
            <!-- your navbar here -->
          </ul>
        </div>
      </div>
    </nav>



</body>

</html>