<?php 
	include_once 'funcoes.php';
	if (isset($_POST['btnCad'])) {
		$id = $_POST['icod'];
		$nome = $_POST['inomep'];
		$desc = $_POST['txtdesc'];
		$preco = $_POST['ipreco'];

		if(isset($_POST['cstatus']))
		{
			$status = 1;	
		}else{
			$status =0;
		}

		$link = conectar();
		$sql = "UPDATE produto SET nome = '$nome' ,descr = '$desc',preco = $preco,status = $status ";
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