<?php
  session_start();
  include_once("dbcon.php");
  // init.php
  // Ficheiro de inicialização de configurações gerais
  define('DS', DIRECTORY_SEPARATOR);
  define('ROOT',$_SERVER['DOCUMENT_ROOT']);
  define('SITE_ROOT',ROOT.DS.'meu_site');
  # 2º alternativa
  # define('SITE_ROOT',DS.'var'.DS.'www'.DS.'meu_site');
  define('LIB_CLASS',SITE_ROOT.DS.'classes');
  define('LIB_INCLUDES',SITE_ROOT.DS.'includes');


  if(!isset($_SESSION['user_id'])) {
    header('Location: ../login/index.php');
  } else {
    $user = $_SESSION['user'];
    $query = "SELECT * FROM usuarios WHERE username = '$user'";
    $sql = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($sql);
    $_SESSION['tipo_user'] = $data['tipo_user'];
    $_SESSION['userID'] = $data['id'];
    $_SESSION['username'] = $data['username'];

    // Lockscreen system
    $time = time();

    $time_exp = $time - $_SESSION['exp_time'];
    $time_logout = $time - $_SESSION['logout_time'];

    if($time_logout > 30){
      header('Location: sair.php');
    } else {
      if($time_exp > 15){
        header('Location: ../login/lock.php');
      } else {
        $_SESSION['exp_time'] + 60 * 60;
        $_SESSION['logout_time'] + 30 * 60;
      }
    }
    
  }
?>