<?php 
	session_start();

	if(isset($_GET['id'])){
		include_once('dbcon.php');

		$id = $_GET['id'];

		$query = "SELECT * FROM usuarios WHERE id = '$id'";
		$exec = mysqli_query($conn, $query);
		$data = mysqli_fetch_assoc($exec);

		if($data['plano'] == 'free'){
			$sql = "UPDATE usuarios SET plano = 'premium' WHERE id = '$id'";
			$_SESSION['sucesso'] = 21;
		} else if($data['plano'] == 'premium') {
			$sql = "UPDATE usuarios SET plano = 'free' WHERE id = '$id'";
			$_SESSION['sucesso'] = 20;
		}

		if(mysqli_query($conn, $sql)){
				echo "
				<script>
					window.history.back();
					location.reload(true);
				</script>";
		} else {
			$_SESSION['sucesso'] = 16;
			echo "
		<script>
			window.history.back();
			location.reload(true);
		</script>";
		}
		
		mysqli_close($conn);

	} else {
		$_SESSION['sucesso'] = 16;
		echo "
			<script>
			  window.history.back();
				location.reload(true);
			</script>";
	}

?>