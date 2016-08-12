<?php 
	include_once "funcoes.php";
	if(isset($_POST['btnCad'])){
		$id = $_POST['icod'];
		
		$link = conectar(); 

		$sql = "DELETE FROM Funcionario ";
		$sql .= " WHERE codigo_func = $id";
		//echo $sql;exit;
		mysqli_query($link,$sql);
		if(mysqli_affected_rows($link)==1){
			//Alerta de usuario cadastrado
			desconectar($link);
			redireciona("frmFuncionario.php?msg=1");

		}else{
			//Alerte de erro ao cadastrar
			desconectar($link);
			redireciona("frmFuncionario.php?msg=0");
		}


		
	}
?>