<?php 
  session_start();
  require("../validate.php");
  $tipoUser = $_SESSION['tipo_user'];
  if($tipoUser == 'membro'){
    header('Location: ../membro/index.php');
  }
  $_SESSION['pagina'] = 'user';
  $_SESSION['collapse'] = 'profile';
  $idUsuario = $_SESSION['user_id'];
  require("view/sidebar_admin.php");

  include_once('controller/dbcon.php');

  $sql = "SELECT * FROM usuarios WHERE id = '$idUsuario'";
  $query = mysqli_query($conn, $sql);
  $data = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Juristrabalhista
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
      window.onload = function()  {
        CKEDITOR.replace( 'editor1', {
         filebrowserBrowseUrl: 'assets/ckeditor/ckfinder/ckfinder.html',
         filebrowserUploadUrl: 'assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
       } );
      };
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-159918073-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-159918073-1');
</script>
</head>

<body class="">
  <div class="wrapper ">
    
    <div class="main-panel">
      <!-- Navbar -->
      <?php require("view/header_admin.php"); ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">perm_identity</i>
                  </div>
                  <h4 class="card-title">Editar perfil -
                    <small class="category">Complete o seu perfil</small>
                  </h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="editar_informacoes_conta.php">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label >Username</label>
                          <input type="text" class="form-control" name="user" value="<?php echo $data['username']; ?>">
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <label >E-mail</label>
                          <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label >Nome Completo</label>
                          <input type="text" class="form-control" name="nome" value="<?php echo $data['nome']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label >CEP</label>
                          <input type="text" class="form-control" id="cep" value="<?php echo $data['cep']; ?>" name="cep" size="10" inputmode="numeric" data-mask-selectonfocus="true" data-mask="99.999-999" onblur="pesquisacep(this.value);" >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label >Rua</label>
                          <input type="text" class="form-control" id="rua" value="<?php echo $data['rua']; ?>" name="rua">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label >Cidade</label>
                          <input type="text" class="form-control" value="<?php echo $data['cidade']; ?>" id="cidade" name="cidade">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label >Estado</label>
                          <input type="text" class="form-control" value="<?php echo $data['uf']; ?>" id="uf" name="uf">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label >Bairro</label>
                          <input type="text" class="form-control" value="<?php echo $data['bairro']; ?>" id="bairro" name="bairro">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label >Número</label>
                          <input type="text" class="form-control" value="<?php echo $data['numero']; ?>" id="numero" name="numero">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Biografia</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"> Escreva aqui um pouco sobre você.</label>
                            <textarea class="form-control" rows="5" id="biografia" name="biografia"><?php echo $data['biografia']; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-rose pull-right">Atualizar perfil</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="../assets/img/default-avatar.png" />
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray">Membro <?php echo $data['plano']; ?></h6>
                  <h4 class="card-title"><?php echo $data['nome']; ?></h4>
                  <p class="card-description">
                    <?php echo $data['biografia']; ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Filters</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger active-color">
            <div class="badge-colors ml-auto mr-auto">
              <span class="badge filter badge-purple" data-color="purple"></span>
              <span class="badge filter badge-azure" data-color="azure"></span>
              <span class="badge filter badge-green" data-color="green"></span>
              <span class="badge filter badge-warning" data-color="orange"></span>
              <span class="badge filter badge-danger" data-color="danger"></span>
              <span class="badge filter badge-rose active" data-color="rose"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="header-title">Sidebar Background</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="ml-auto mr-auto">
              <span class="badge filter badge-black active" data-background-color="black"></span>
              <span class="badge filter badge-white" data-background-color="white"></span>
              <span class="badge filter badge-red" data-background-color="red"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger">
            <p>Sidebar Mini</p>
            <label class="ml-auto">
              <div class="togglebutton switch-sidebar-mini">
                <label>
                  <input type="checkbox">
                  <span class="toggle"></span>
                </label>
              </div>
            </label>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger">
            <p>Sidebar Images</p>
            <label class="switch-mini ml-auto">
              <div class="togglebutton switch-sidebar-image">
                <label>
                  <input type="checkbox" checked="">
                  <span class="toggle"></span>
                </label>
              </div>
            </label>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="header-title">Images</li>
        <li class="active">
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="assets/img/sidebar-1.jpg" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="assets/img/sidebar-2.jpg" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="assets/img/sidebar-3.jpg" alt="">
          </a>
        </li>
        <li>
          <a class="img-holder switch-trigger" href="javascript:void(0)">
            <img src="assets/img/sidebar-4.jpg" alt="">
          </a>
        </li>
      </ul>
    </div>
  </div>

  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Excluir julgado
            </div>
            <div class="modal-body">
                Deseja realmente excluir o julgado?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok">Excluir</a>
            </div>
        </div>
    </div>
</div>


  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.0" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script src="assets/js/plugins/cep.js"></script>
 <script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  
    $(document).ready(function() {
      $('.datatable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "Todos"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Buscar julgados",
        }
      });

      var table = $('.datatable').DataTable();
    });
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    // Alert Config
    var sucesso = <?php echo $_SESSION['sucesso']; $_SESSION['sucesso'] = ''; ?>;
    if(sucesso == 1){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">check</i></div> <strong>Julgado</strong> adicionado com sucesso.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'success',
        allow_dismiss: true
      });
    } else if(sucesso == 2){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">warning</i></div> <strong>Erro: </strong> Os campos não podem estar vazios.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'danger',
        allow_dismiss: true
      });
    } else if(sucesso == 3){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">error_outline</i></div> <strong>Erro:</strong> Julgado não adicionado.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'danger',
        allow_dismiss: true
      });
    } else if(sucesso == 4){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">warning</i></div> <strong>Julgado</strong> excluído com sucesso.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'warning',
        allow_dismiss: true
      });
    } else if(sucesso == 5){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">error_outline</i></div> <strong>Erro:</strong>Julgado não excluído.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'danger',
        allow_dismiss: true
      });
    } else if(sucesso == 6){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">error_outline</i></div> <strong>Erro:</strong> Selecione um Julgado.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'danger',
        allow_dismiss: true
      });
    } else if(sucesso == 7){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">favorite</i></div> <strong>Julgado</strong> favoritado com sucesso.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'success',
        allow_dismiss: true
      });
    } else if(sucesso == 8){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">error_outline</i></div> <strong>Erro: </strong> Julgado não favoritado, tente novamente mais tarde.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'danger',
        allow_dismiss: true
      });
    } else if(sucesso == 9){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">favorite</i></div> <strong>Julgado</strong> desfavoritado com sucesso.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'success',
        allow_dismiss: true
      });
    } else if(sucesso == 10){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">favorite_border</i></div> <strong>Julgado</strong> atualizado com sucesso.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'success',
        allow_dismiss: true
      });
    } else if(sucesso == 11){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">favorite_border</i></div> <strong>Erro: </strong> Julgado não atualizado.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'danger',
        allow_dismiss: true
      });
    } else if(sucesso == 12){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">favorite_border</i></div> <strong>Comentário</strong> adicionado com sucesso.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'success',
        allow_dismiss: true
      });
    } else if(sucesso == 13){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">favorite_border</i></div> <strong>Erro: </strong> Comentário não adicionado.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'danger',
        allow_dismiss: true
      });
    } else if(sucesso == 14){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">check</i></div> <strong>Conta </strong> atualizada com sucesso.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'success',
        allow_dismiss: true
      });
    } else if(sucesso == 15){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">check</i></div> <strong>Erro: </strong> Conta não atualizada. Tente novamente mais tarde.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'danger',
        allow_dismiss: true
      });
    } else if(sucesso == 16){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">error_outline</i></div> <strong>Erro: </strong> Conta desconhecida.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'danger',
        allow_dismiss: true
      });
    } else if(sucesso == 17){
      var notify = $.notify('<div class="alert-icon"><i class="material-icons">error_outline</i></div> <strong>Erro: </strong> Este usuário já está sendo utilizado.', {
        icon: 'glyphicon glyphicon-alert',
        type: 'danger',
        allow_dismiss: true
      });
    } 
    
  </script>
</body>

</html>
