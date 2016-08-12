<?php 
	include_once 'funcoes.php';
	if (isset($_POST['btnCad'])) {
		$id = $_POST['icod'];

		$link = conectar();
		$sql = "DELETE FROM produto ";
		$sql .= " WHERE codigo_prod = $id";

		mysqli_query($link,$sql);
		if(mysqli_affected_rows($link)==1){
			//Alerta cadastrado com sucesso
			redireciona("frmProduto.php?msg=1");

		}else{
			//Erro ao cadastrar
			redireciona("frmProduto.php?msg=0");
		}


	}
 ?>