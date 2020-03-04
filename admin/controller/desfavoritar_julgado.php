<?php 
	session_start();
	$_SESSION['user_id'] = 1;

	if(isset($_GET['id'])){
		include_once('dbcon.php');

		$id = $_GET['id'];
		$idUsuario = $_SESSION['user_id'];

		$sql = "DELETE FROM julgados_favoritos WHERE id_usuario = '$idUsuario' AND julgado = '$id'";

		if(mysqli_query($conn, $sql)){
			$_SESSION['sucesso'] = 7;
			header('Location: ../julgados_favoritos.php');
		} else {
			$_SESSION['sucesso'] = 8;
			header('Location: ../julgados_favoritos.php');
		}
		mysqli_close($conn);

	} else {
		$_SESSION['sucesso'] = 6;
		header('Location: ../julgados_favoritos.php');
	}

?>