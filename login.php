<?php 
	session_start();
  include_once("dbcon.php");

  if((isset($_POST['user'])) && (isset($_POST['pass']))){  
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    $query = "SELECT * FROM usuarios WHERE username = '$user'";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
  
    $id = $data['id'];
    $name = $data['nome'];
    $tipoUser = $data['tipo_user'];
    $stored_hash = $data['pwd'];
		$_SESSION['status_assinatura'] == $data['status_assinatura'];
    
    $verify = password_verify($pass, $stored_hash);

    $_SESSION['token_acesso'] = md5(crypt(date("FjYgia")));
    $_SESSION['start_login'] = time();
    $_SESSION['logout_time'] = $_SESSION['start_login'] + 60 * 60;
    $_SESSION['exp_time'] = $_SESSION['start_login'] + 30 * 60;
    

    if($verify){
      $_SESSION['nome'] = $name;
      $_SESSION['user'] = $user;
      $_SESSION['user_id'] = $id;
      $_SESSION['p_hash'] = $stored_hash;
      $_SESSION['tipo_user'] = $tipoUser;

      if($tipoUser == 'admin'){
        $_SESSION['not-auth'] = false;
        unset($_SESSION['erro_login']);
        header('Location: admin/');
      }
      if ($tipoUser == 'membro'){
        $_SESSION['not-auth'] = false;
        unset($_SESSION['erro_login']);
        header('Location: membro/');
      }

    } else {
      $_SESSION['not-auth'] = true;
      $_SESSION['erro_login'] = 'Usuário ou senha inválidos.';
      header('Location: login/index.php');
    }
  } else {
      $_SESSION['not-auth'] = true;
      $_SESSION['erro_login'] = 'Insira um usuário e uma senha válidos.';
      header('Location: login/index.php');
  }
?>