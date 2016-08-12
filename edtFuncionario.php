<?php 
	include_once "funcoes.php";
	if(isset($_POST['btnCad'])){
		$id = $_POST['icod'];
		$nome = $_POST['inome'];
		$email = $_POST['iemail'];
		$senha = codificasenha($_POST['ipassword']);
		$tel = $_POST['itel'];
		$cpf = $_POST['icpf'];
		if(isset($_POST['cstatus']))
		{
			$status = 1;	
		}else{
			$status =0;
		}
	
		$link = conectar(); 

		$sql = "UPDATE funcionario SET nome = '$nome',cpf = '$cpf',telefone = '$tel',email = '$email',senha = '$senha',status = '$status' ";
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