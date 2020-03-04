<?php 
	session_start();
	$_SESSION['user_id'] = 1;

	if(isset($_GET['id'])){
		include_once('dbcon.php');

		$id = $_GET['id'];
		$idUsuario = $_SESSION['user_id'];

		$sql = "INSERT INTO julgados_favoritos (id_usuario, julgado) VALUES ('$idUsuario', '$id')";

		if(mysqli_query($conn, $sql)){
			$_SESSION['sucesso'] = 7;
			header('Location: ../julgados.php');
		} else {
			$_SESSION['sucesso'] = 8;
			header('Location: ../julgados.php');
		}
		mysqli_close($conn);

	} else {
		$_SESSION['sucesso'] = 6;
		header('Location: ../julgados.php');
	}

?>