<?php
if($_POST){
	require("../controller/dbcon.php");

	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$dias = $_POST['dias'];
	$valor = $_POST['valor'];

	$sql = "INSERT INTO plano (id, nome, dias, valor) VALUES ('$id', '$nome', '$dias', '$valor')";
	if(mysqli_query($conn, $sql)){
		$msg = 'Plano adicionado com sucesso';
	} else {
		$msg = 'Plano não adicionado';
	}
	mysqli_close();
	return $msg;
	exit();

} else {
	exit();
}