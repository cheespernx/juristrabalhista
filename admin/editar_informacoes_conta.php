<?php 
	session_start();
  include_once("dbcon.php");

  if($_POST){  
		$idUsuario = $_SESSION['user_id'];
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $nome = $_POST['nome'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];
    $biografia = $_POST['biografia'];

    $sql = "UPDATE usuarios SET 
		username = '$user', 
		email = '$email',
		nome = '$nome', 
		cep = '$cep', 
		rua = '$rua', 
		cidade = '$cidade', 
		uf = '$uf', 
		bairro = '$bairro', 
		numero = '$numero', 
		biografia = '$biografia' 
		WHERE id = '$idUsuario'";

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

		
	} else {
			$_SESSION['sucesso'] = 16;
			echo "
				<script>
					window.history.back();
				</script>";
		}
?>