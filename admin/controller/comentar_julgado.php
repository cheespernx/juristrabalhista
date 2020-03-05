<?php 
	session_start();

	if(isset($_POST['id']) && isset($_POST['id_usuario']) && isset($_POST['comentario'])){
		include_once('dbcon.php');

		$id = $_POST['id'];
		$idUsuario = $_POST['id_usuario'];
		$comentarios = $_POST['comentario']."<br>".date('d M Y H:i:s')."<hr><br>";

		$selectComentario = "SELECT * FROM comentarios WHERE julgado = '$id' AND id_usuario = '$idUsuario'";
		$execComentario = mysqli_query($conn, $selectComentario);
		$num = mysqli_num_rows($execComentario);

		if($num > 0){
			$sqlComentario = "UPDATE comentarios SET comentario = '$comentarios' WHERE id_usuario = '$idUsuario' AND julgado = '$id'";
		} else {
			$sqlComentario = "INSERT INTO comentarios (id_usuario, julgado, comentario) VALUES ('$idUsuario', '$id', '$comentarios')";
		}

		if(mysqli_query($conn, $sqlComentario)){
			$_SESSION['sucesso'] = 12;
			header('Location: ../verjulgado.php?id='.$id);
		} else {
			$_SESSION['sucesso'] = 13;
			echo "
		<script>
			window.history.back();
			location.reload(true);
		</script>";
		}
		
		mysqli_close($conn);

	} else {
		$_SESSION['sucesso'] = 6;
		echo "
			<script>
			  window.history.back();
				location.reload(true);
			</script>";
	}

?>