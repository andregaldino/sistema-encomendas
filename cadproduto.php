<?php 
	include_once 'funcoes.php';
	if (isset($_POST['btnCad'])) {
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
		$sql = "INSERT INTO produto(nome,descr,preco,status) VALUES ('{$nome}','{$desc}',{$preco},{$status})";

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