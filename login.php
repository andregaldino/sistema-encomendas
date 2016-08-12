<?php
	include_once "funcoes.php";
	if(isset($_POST['btnLogar'])){
		$email = $_POST['iemail'];
		$senha = codificasenha($_POST['isenha']);

		$link = conectar();

		$sql = "SELECT * FROM funcionario WHERE email = '{$email}' AND senha = '{$senha}' AND status = 1 LIMIT 1";
		$res = mysqli_query($link,$sql);
		if(mysqli_affected_rows($link)==1){
			//Login permitido
			session_start();
			while ($dados = mysqli_fetch_array($res)){	
				$_SESSION['idFunc'] = $dados['codigo_func'];
				$_SESSION['nomeF'] = $dados['nome'];
				$_SESSION['emailF'] = $dados['email'];
			}
			redireciona("home.php");
		}else{
			redireciona("index.php");

		}
	}
 ?>