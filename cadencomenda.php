<?php 
require_once 'funcoes.php';
session_start();	
if (isset($_POST['btnCad'])) {
	$datap = $_POST['idataprev'];
	$fk_prod = $_POST['sproduto'];
	$fk_cli = $_POST['scliente'];
	$quantd = $_POST['iquantidade'];
	$fk_func = $_SESSION['idFunc'];
	$data = date("Y-m-d");
	
	$link = conectar();
	$sql = "INSERT INTO encomenda (data_pedido,data_prevista,quantidade,fk_func,fk_cliente,fk_prod) ";
	$sql .= "VALUES ('$data', '$datap',$quantd, $fk_func, $fk_cli, $fk_prod )";
	
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