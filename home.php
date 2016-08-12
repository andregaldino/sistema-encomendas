<?php
include_once 'funcoes.php'; 
if(isset($_GET['sair']))
	if($_GET['sair'] == true){
		session_destroy();
		redireciona('index.php');
		}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css\bootstrap.css">
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>

</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	    <div class="navbar navbar-default" role="navigation">
	    	<div class="container">
				<div class="navbar-collapse collapse">

				    <ul class="nav navbar-nav navbar-left">
						<li class="active"><a href="home.php">Home</a></li>
						<li class="dropdown ">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Encomenda<b class="caret"></b></a>
						    <ul class="dropdown-menu">
							<li><a href="frmEncomenda.php">Cadastrar</a></li>
							<li><a href="conEncomenda.php">Consultar</a></li>
						    </ul>
						</li>			
						<li class="dropdown ">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Produto<b class="caret"></b></a>
						    <ul class="dropdown-menu">
							<li><a href="frmProduto.php">Cadastrar</a></li>
							<li><a href="conProduto.php">Consultar</a></li>

							<li class="divider"></li>
						    </ul>
						</li>
						<li class="dropdown">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cliente<b class="caret"></b></a>
						    <ul class="dropdown-menu">
							<li><a href="frmCliente.php">Cadastrar</a></li>
							<li><a href="conCliente.php">Consultar</a></li>

							<li class="divider"></li>
						    </ul>
						</li>
						<li class="dropdown">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Funcionario<b class="caret"></b></a>
						    <ul class="dropdown-menu">
							<li><a href="frmFuncionario.php">Cadastrar</a></li>
							<li><a href="conFuncionario.php">Consultar</a></li>

							<li class="divider"></li>
						    </ul>
						</li>
						<li><a><?php echo $_SESSION['nomeF'];?></a></li>
						<li><a href="?sair=true">Sair</a></li>
				    </ul>
				</div><!--/.nav-collapse -->
	    </div>
</div>


<footer id="footer">
	<hr>
	<div class="container">
		<div class="col-lg-4 text-center"></div>
		<div class="col-lg-4 text-center">
			<h4 class='intro-text text-center'>
				Site de Controle de encomendas 
			</h4>
		</div>
		<div class="col-lg-4 text-center"></div>
	</div>
	
	<div class="container">
		<div class="col-lg-4 text-center"></div>
		<div class="col-lg-4 text-center">			
				Copyright &copy; Desenvolvido por Andre e Danilo			
		</div>
		<div class="col-lg-4 text-center"></div>
	</div>
	
	</hr>
</footer>

</body>
</html>