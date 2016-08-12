<?php 
require_once 'funcoes.php';
if (isset($_POST['btnCad'])) {
	$id = $_POST['icod'];
	
	$link = conectar();
	$sql = "DELETE FROM encomenda ";
	$sql .= "WHERE codigo_enc = $id";
	
	mysqli_query($link,$sql);
	if(mysqli_affected_rows($link)==1){
		desconectar($link);
		redireciona("frmEncomenda.php?msg=1");
		//Alerte de cadastrado com sucesso
	}else{
		//alerte de erro ao cadastrar
		desconectar($link);
		redireciona("frmEncomenda.php?msg=0");
	}


}

 ?>