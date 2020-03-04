<?php
session_start();
$pagina = $_SESSION['id_pagina'];
$collapse = $_SESSION['id_collapse'];
$_SESSION['id_pagina'] = '';
$_SESSION['id_collapse'] = '';


$tipoUser = $_SESSION['tipo_user'];
if ($tipoUser != 'admin' and $tipoUser == 'cliente') {
header('Location: cliente/areadocliente.php');
}


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
        <a href="index.php" class="simple-text logo-normal">
          Juris<b>Trabalhista</b>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="assets/img/faces/avatar.jpg"/>
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                <?php echo TrataNome($_SESSION['nome']); ?>
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
        <li class="nav-item <?php echo $pagina == 'index'?'active':'' ?>">
          <a class="nav-link" href="index.php">
            <i class="material-icons">dashboard</i>
              <p>Início</p>
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="gestao.php">
            <i class="material-icons">build</i>
              <p>Gestão</p>
          </a>
        </li>
        <li class="nav-item <?php echo $pagina == 'comercial'?'active':'' ?>">
          <a class="nav-link" href="comercial.php">
            <i class="material-icons">work</i>
              <p>Comercial</p>
          </a>
        </li>
				 <li class="nav-item <?php echo $pagina == 'conteudo'?'active':'' ?>">
          <a class="nav-link" href="conteudo.php">
            <i class="material-icons">edit</i>
              <p>Conteúdo</p>
          </a>
        </li>
        <li class="nav-item <?php echo $collapse == 'crm'?'active':'' ?>">
          <a class="nav-link" data-toggle="collapse" href="#" data-target="#div-crm">
            <i class="material-icons">supervisor_account</i>
              <p>CRM
                <b class="caret"></b>
              </p>
          </a>
          <div class="collapse" id="div-crm">
            <ul class="nav">
              <li class="nav-item <?php echo $pagina == 'cadastro_cliente'?'active':'' ?>">
                <a class="nav-link" href="cadastro_cliente.php">
                  <i class="material-icons">assignment_ind</i>
                    <p>Cadastro de Cliente</p>
                </a>
              </li>
              <li class="nav-item <?php echo $pagina == 'lista'?'active':'' ?>">
                <a class="nav-link" href="lista.php">
                  <i class="material-icons">list_alt</i>
                  <p>Clientes</p>
                </a>
              </li>
              <li class="nav-item <?php echo $pagina == 'cadastro_consultores'?'active':'' ?>">
                <a class="nav-link" href="cadastro_consultores.php">
                  <i class="material-icons">assignment_ind</i>
                    <p>Cadastro de Usuários</p>
                </a>
              </li>
              <li class="nav-item <?php echo $pagina == 'lista_consultores'?'active':'' ?>">
                <a class="nav-link" href="lista_consultores.php">
                  <i class="material-icons">list_alt</i>
                    <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item <?php echo $pagina == 'agenda'?'active':'' ?>">
                <a class="nav-link" href="agenda.php">
                  <i class="material-icons">view_agenda</i>
                    <p>Tarefas</p>
                </a>
              </li>
            </ul>            
          </div>
        </li>
        
        <li class="nav-item <?php echo $collapse == 'produtos'?'active':'' ?>">
          <a class="nav-link" data-toggle="collapse" href="#" data-target="#div-produtos">
            <i class="material-icons">shopping_cart</i>
              <p>Produtos
                <b class="caret"></b>
              </p>
          </a>
          <div class="collapse" id="div-produtos">
            <ul class="nav">
              <li class="nav-item <?php echo $pagina == 'produtos_odonto'?'active':'' ?>">
                <a class="nav-link" href="produtos_odonto.php">
                  <i class="material-icons">add_shopping_cart</i>
                    <p>Adicionar produtos</p>
                </a>
              </li>
              <li class="nav-item <?php echo $pagina == 'produtos_seguros'?'active':'' ?>">
                <a class="nav-link" href="#">
                  <i class="material-icons">home</i>
                  <p>Ver produtos</p>
                </a>
              </li>
            </ul>            
          </div>
        </li>
      </ul>
    </div>
  </div>
</body>
</html>