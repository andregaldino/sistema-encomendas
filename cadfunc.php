<?php 
	include_once "funcoes.php";
	if(isset($_POST['btnCad'])){
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
		

		if(!existeEmail($email,"funcionario")){
			$link = conectar(); 

			$sql = "INSERT INTO funcionario (nome,cpf,telefone,email,senha,status) VALUES ('{$nome}',{$cpf},{$tel},'{$email}','{$senha}',{$status})";
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

		}else{
			desconectar($link);
			redireciona("frmFuncionario.php?msg=2");
		}

		
	}
?>