<?php 
	session_start();

	if(isset($_GET['id'])){
		include_once('dbcon.php');

		$id = $_GET['id'];
		$idUsuario = $_SESSION['user_id'];

		$sql = "DELETE FROM julgados_favoritos WHERE id_usuario = '$idUsuario' AND julgado = '$id'";

		if(mysqli_query($conn, $sql)){
			$_SESSION['sucesso'] = 9;
			echo "
			<script>
			  window.history.back();
			</script>";
		} else {
			$_SESSION['sucesso'] = 8;
			echo "
			<script>
			  window.history.back();
			</script>";
		}
		mysqli_close($conn);

	} else {
		$_SESSION['sucesso'] = 6;
		echo "
			<script>
			  window.history.back();
			</script>";
	}

?>