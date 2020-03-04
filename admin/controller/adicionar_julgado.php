<?php 
	session_start();

	if(isset($_POST['id'])){
		if( isset($_POST['titulo']) && isset($_POST['origem']) && isset($_POST['categoria']) && isset($_POST['subcategoria']) && isset($_POST['assunto']) && isset($_POST['ano']) && isset($_POST['conteudo']) ){
			include_once('dbcon.php'); // Inclusão do DBCon
			$id = $_POST['id'];
			$titulo = $_POST['titulo'];
			$origem = $_POST['origem'];
			$categoria = $_POST['categoria'];
			$subcategoria = $_POST['subcategoria'];
			$assunto = $_POST['assunto'];
			$ano = $_POST['ano'];
			$conteudo = $_POST['conteudo'];
	
			$sql = "UPDATE julgados SET titulo = '$titulo', origem = '$origem', categoria = '$categoria', subcategoria = '$subcategoria', assunto = '$assunto', ano = '$ano', conteudo = '$conteudo' WHERE id = '$id'";
			if(mysqli_query($conn, $sql)){
				$_SESSION['sucesso'] = 10;
				echo "
					<script>
					window.history.back();
					</script>";
			} else {
				$_SESSION['sucesso'] = 11;
				echo "
					<script>
					window.history.back();
					</script>";
			}
	
			mysqli_close($conn);
	
		} else {
			$_SESSION['sucesso'] = 2; // Variavél de Alert
			echo "
					<script>
					window.history.back();
					</script>";
		}
	} else {
		if( isset($_POST['titulo']) && isset($_POST['origem']) && isset($_POST['categoria']) && isset($_POST['subcategoria']) && isset($_POST['assunto']) && isset($_POST['ano']) && isset($_POST['conteudo']) ){
			include_once('dbcon.php'); // Inclusão do DBCon
			
			$titulo = $_POST['titulo'];
			$origem = $_POST['origem'];
			$categoria = $_POST['categoria'];
			$subcategoria = $_POST['subcategoria'];
			$assunto = $_POST['assunto'];
			$ano = $_POST['ano'];
			$conteudo = $_POST['conteudo'];
	
			$sql = "INSERT INTO julgados (titulo, origem, categoria, subcategoria, assunto, ano, conteudo) VALUES ('$titulo', '$origem', '$categoria', '$subcategoria', '$assunto', '$ano', '$conteudo')";
			if(mysqli_query($conn, $sql)){
				$_SESSION['sucesso'] = 1;
				echo "
					<script>
					window.history.back();
					</script>";
			} else {
				$_SESSION['sucesso'] = 3;
				echo "
					<script>
					window.history.back();
					</script>";
			}
	
			mysqli_close($conn);
	
		} else {
			$_SESSION['sucesso'] = 2; // Variavél de Alert
			echo "
					<script>
					window.history.back();
					</script>";
		}
	}
?>

