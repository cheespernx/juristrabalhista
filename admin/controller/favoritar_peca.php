<?php 
	session_start();

	if(isset($_POST['id'])){
		include_once('dbcon.php');

		$id = $_POST['id'];
		$idUsuario = $_SESSION['user_id'];

		$select = "SELECT * FROM pecas_favoritas WHERE peca = '$id' AND id_usuario = '$idUsuario'";
		$exec = mysqli_query($conn, $select);
		$num = mysqli_num_rows($exec);

		if($num > 0){
			$sql = "DELETE FROM pecas_favoritas WHERE peca = '$id' AND id_usuario = '$idUsuario'";
			mysqli_query($conn, $sql);
		} else {
			$sql = "INSERT INTO pecas_favoritas (id_usuario, peca) VALUES ('$idUsuario', '$id')";
			mysqli_query($conn, $sql);
		}
		mysqli_close($conn);
	} 
?>