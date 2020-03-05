<?php 
	session_start();
  include_once("controller/dbcon.php");

  if($_POST){  
		$idUsuario = $_SESSION['user_id'];
    $user = $_POST['user'];
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];
    $biografia = $_POST['biografia'];

		$testUsername = "SELECT * FROM usuarios WHERE username = '$user'";
    $result = mysqli_query($conn, $testUsername);
    $data = mysqli_fetch_assoc($result);
		$row = mysqli_num_rows($result);
  
    $id = $data['id'];

		if($row == 1 && $id == $idUsuario || $row == 0){ // Estiver fazendo o UPDATE do proprio user
			$sql = "UPDATE usuarios SET	username = '$user', email = '$email', nome = '$nome', cep = '$cep', rua = '$rua', cidade = '$cidade', uf = '$uf', bairro = '$bairro',	numero = '$numero', biografia = '$biografia' WHERE id = '$idUsuario'";

			if(mysqli_query($conn, $sql)){
				$_SESSION['sucesso'] = 14;
				echo "
					<script>
						window.history.back();
					</script>";
			} else {
				$_SESSION['sucesso'] = 15;
				echo "
					<script>
						window.history.back();
					</script>";
			}

		} else if($row == 1 && $id != $idUsuario) { // Se já existir outro usuário com esse username não sendo a propria pessoa
			$_SESSION['sucesso'] = 17;
			echo "
				<script>
					window.history.back();
				</script>";
		}

	} else { // NOT POST
			$_SESSION['sucesso'] = 16;
			echo "
				<script>
					window.history.back();
				</script>";
		}
?>