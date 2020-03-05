<?php 
	session_start();
	$_SESSION['user_id'] = 1;

	if(isset($_GET['id'])){
		include_once('dbcon.php');

		$id = $_GET['id'];
		$idUsuario = $_SESSION['user_id'];

		$select = "SELECT * FROM julgados_favoritos WHERE julgado = '$id' AND id_usuario = '$idUsuario'";
		$exec = mysqli_query($conn, $select);
		$num = mysqli_num_rows($exec);

		if($num > 0){
			$sql = "DELETE FROM julgados_favoritos WHERE julgado = '$id' AND id_usuario = '$idUsuario'";

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

		} else {
			$sql = "INSERT INTO julgados_favoritos (id_usuario, julgado) VALUES ('$idUsuario', '$id')";

			if(mysqli_query($conn, $sql)){
				$_SESSION['sucesso'] = 7;
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