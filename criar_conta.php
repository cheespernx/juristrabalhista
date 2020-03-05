<?php 
	session_start();
  include_once("dbcon.php");

  if( (isset($_POST['user'])) && (isset($_POST['pass'])) && (isset($_POST['email'])) ){  
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pass']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
		$pwd = password_hash($pwd, PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 3, 'threads' => 3]);

    $queryUser = "SELECT * FROM usuarios WHERE username = '$user'";
    $queryEmail = "SELECT * FROM usuarios WHERE email = '$email'";

    $resultUser = mysqli_query($conn, $queryUser);
    $rowsUser = mysqli_num_rows($resultUser);

    $resultEmail = mysqli_query($conn, $queryEmail);
    $rowsEmail = mysqli_num_rows($resultEmail);

		if($rowsUser > 0){
			$_SESSION['erro_cadastro'] = 'Ops... Parece que já existe alguém com esse usuário. Tente outro.';
			echo "<script> window.history.back(); </script>";
		} else if($rowsEmail > 0) {
			$_SESSION['erro_cadastro'] = 'Este e-mail já foi utilizado por outra pessoa. Se é você, faça login <a href="login/">Aqui</a>. Se não, tente outro e-mail.';
			echo "<script> window.history.back(); </script>";
		} else {
			$tipo_user = 'membro';
			$status_assinatura = 'inativa';
			$data_vencimento = date("d/m/Y");
			$plano = 'free';
			$data_cadastro = date("d/m/Y");

			$sql = "INSERT INTO usuarios (email, username, pwd, tipo_user, status_assinatura, data_vencimento, plano, data_cadastro) VALUES";
			$sql .= "('$email', '$user', '$pwd', '$tipo_user', '$status_assinatura', '$data_vencimento', '$plano', '$data_cadastro')";

			if (mysqli_query($conn, $sql)) {
				$_SESSION['sucesso'] = 'Prontinho, você já pode <a href="login/"><b>fazer login aqui</b>.</a> E em seguida, basta ativar o seu plano para poder começar a utilizar a sua conta.';
        echo "<script> window.history.back(); </script>";
        
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

		}
	}
?>