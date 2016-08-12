<?php
	include_once 'funcoes.php';
	if(isset($_POST['btnCad'])){
		$id = $_POST['icod'];

		$link  = conectar();

		$sql = "DELETE FROM cliente ";
		$sql .= " WHERE codigo_cli = $id";
		//print_r($sql);exit;
		mysqli_query($link,$sql);
		if(mysqli_affected_rows($link)==1){
			desconectar($link);
			redireciona("frmCliente.php?msg=1");
			//Alerte de cadastrado com sucesso
		}else{
			//alerte de erro ao cadastrar
			desconectar($link);
			redireciona("frmCliente.php?msg=0");
		}		
	}
 ?>