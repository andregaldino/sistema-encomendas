<?php
	include_once 'funcoes.php';
	if(isset($_POST['btnCad'])){
		
		$id = $_POST['icod'];
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

		$link  = conectar();

		$sql = "UPDATE cliente SET nome= '$nome',cpf= '$cpf',email = '$email',tel_residencial ='$fone_res',tel_celular = '$fone_cel',status = $status ";
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