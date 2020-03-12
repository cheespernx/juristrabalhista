<?php 
	session_start();
	
	if( isset($_GET['id'])){
		include_once('dbcon.php'); // Inclusão do DBCon
		$id = $_GET['id'];

		$sql = "DELETE FROM pecas WHERE id = '$id'";
		if(mysqli_query($conn, $sql)){
			$_SESSION['sucesso'] = 4;
				echo "
					<script>
					window.history.back();
					</script>";
		} else {
			$_SESSION['sucesso'] = 5;
				echo "
					<script>
					window.history.back();
					</script>";
		}

		mysqli_close($conn);

	} else {
		$_SESSION['sucesso'] = 6; // Variavél de Alert
			echo "
					<script>
					window.history.back();
					</script>";
	}
?>

