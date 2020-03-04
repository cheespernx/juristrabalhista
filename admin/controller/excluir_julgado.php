<?php 
	session_start();
	
	if( isset($_GET['id'])){
		include_once('dbcon.php'); // Inclusão do DBCon
		$id = $_GET['id'];

		$sql = "DELETE FROM julgados WHERE id = '$id'";
		if(mysqli_query($conn, $sql)){
			$_SESSION['sucesso'] = 4;
			header('Location: ../julgados.php');
		} else {
			$_SESSION['sucesso'] = 5;
			header('Location: ../julgados.php');
		}

		mysqli_close($conn);

	} else {
		$_SESSION['sucesso'] = 6; // Variavél de Alert
		header('Location: ../julgados.php');
	}
?>

