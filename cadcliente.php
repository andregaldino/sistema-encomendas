<?php
	include_once 'funcoes.php';
	if(isset($_POST['btnCad'])){
		$nome = $_POST['inome'];
		$email = $_POST['iemail'];
		$cpf = $_POST['icpf'];
		$fone_res = $_POST['ifoneres'];
		$fone_cel = $_POST['ifonecel'];
		if(isset($_POST['cstatus']))
		{
			$status = 1;	
		}else{
			$status =0;
		}


		if (!existeEmail($email,"cliente")) {
			$link  = conectar();

			$sql = "INSERT INTO cliente(nome,cpf,email,tel_residencial,tel_celular,status) VALUES('{$nome}',{$cpf},'{$email}',{$fone_res},{$fone_cel},{$status})";
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

		}else{
			desconectar($link);
			redireciona("frmCliente.php?msg=2");
		}

		
	}
 ?>