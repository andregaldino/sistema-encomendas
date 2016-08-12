<?php include_once 'funcoes.php'; 
if(isset($_GET['sair']))
	if($_GET['sair'] == true){
		session_destroy();
		redireciona('index.php');
		}
?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
	<title></title>
	<meta charset="UTF8"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
</head>
<body>
	<div class="navbar navbar-default" role="navigation">
	    <div class="container">
			<div class="navbar-collapse collapse">

			    <ul class="nav navbar-nav navbar-left">
					<li><a href="home.php">Home</a></li>
					<li class="dropdown active">
					    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Encomenda<b class="caret"></b></a>
					    <ul class="dropdown-menu">
						<li><a href="frmEncomenda.php">Cadastrar</a></li>
						<li><a href="conEncomenda.php">Consultar</a></li>
					    </ul>
					</li>			
					<li class="dropdown">
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


<div class="container">
	<div class="row">
		    <div class="panel-group" id="accordion">
		      	<div class="panel panel-default">
		            <div class="panel-heading">
		              <h4 class="panel-title">
		                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Busca</a>
		              </h4>
		            </div>
		            <div id="collapseOne" class="panel-collapse collapse in">
		              <div class="panel-body">
		                
		                <form class="form-inline" method="POST" action="">
							<fieldset>
								<div class="form-group">
							    	<input type="search" class="form-control"  name="icode" placeholder="Codigo da Encomenda">
							    </div>
							    <div class="form-group">
							        <input type="search" class="form-control"  name="icodp" placeholder="Codigo do Produto">
							    </div>
							    <div class="form-group">
							        <input type="search" class="form-control"  name="icpf" placeholder="CPF do Cliente">
							    </div>
							    <div class="form-group">
							            <button type="submit" class="btn btn-primary" name="btnPesq">
							            	<i class="glyphicon glyphicon-search"> Pesquisar </i>
							            </button>
							    </div>
						    </fieldset>
						</form>
		              </div>
		            </div>
		      	</div>
		    </div>
		

		<table cellpadding="0" cellspacing="0" class="table">
			<thead>
				<th>Codigo</th>
				<th>Cliente</th>
				<th>Produto</th>
				<th>Responsavel</th>
				<th>Celular</th>
				<th>Email</th>
				<th>Status</th>
				<th>Ações</th>
			</thead>
			<tbody>
					<?php 
					if(isset($_GET['tela']) && $_GET['tela'] == "entregaok" ){
						$msg=null;
						if(isset($_GET['id'])){
							$id = base64_decode($_GET['id']);
							$link = conectar();
							$sql = "UPDATE encomenda SET status = 'Entregue' WHERE codigo_enc = $id";
							$res = mysqli_query($link,$sql);
							
							desconectar($link);
							redireciona("conEncomenda.php?msg=1");
						}
					}else if(isset($_GET['tela']) && $_GET['tela'] == "entregaPos" ){
						$msg=null;
						if(isset($_GET['id'])){
							$id = base64_decode($_GET['id']);
							$link = conectar();
							$sql = "UPDATE encomenda SET status = 'Postada' WHERE codigo_enc = $id";
							$res = mysqli_query($link,$sql);
							
							desconectar($link);
							redireciona("conEncomenda.php?msg=1");
						} 
					}else if(isset($_GET['tela']) && $_GET['tela'] == "entregaTrans" ){
						$msg=null;
						if(isset($_GET['id'])){
							$id = base64_decode($_GET['id']);
							$link = conectar();
							$sql = "UPDATE encomenda SET status = 'Em Transito' WHERE codigo_enc = $id";
							$res = mysqli_query($link,$sql);
							
							desconectar($link);
							redireciona("conEncomenda.php?msg=1");
						} 
					}
					
					
					$link = conectar();

					$sql = "SELECT * FROM encomenda JOIN cliente ON fk_cliente = codigo_cli JOIN funcionario ON fk_func = codigo_func JOIN produto ON fk_prod = codigo_prod";
					$res = mysqli_query($link,$sql);
					//print_r($res);
					$dados=mysqli_fetch_array($res);
					//var_dump($dados);
					while ($dados = mysqli_fetch_array($res)){
						//print_r($dados);exit();
						echo "<tr>";
						echo "<td>".$dados['codigo_enc']."</td>";
						echo "<td>".$dados[9]."</td>";	
						echo "<td>".$dados[23]."</td>";	
						echo "<td>".$dados[16]."</td>";
						echo "<td>".$dados['tel_celular']."</td>";
						echo "<td>".$dados[10]."</td>";
						
						$stado = $dados[7];
						if(empty($stado))
							echo "<td><spam>".calcularStatus($dados['data_prevista'])."</spam></td>";
						else
							echo "<td><spam>$stado</spam></td>";
						
						$id = base64_encode($dados['codigo_enc']);
						echo "<td><a href='frmEncomenda.php?tela=excluir&id=".$id."' title='Excluir Encomenda'> <spam class='glyphicon glyphicon-remove'> </spam> </a>";
						echo "<a href='?tela=entregaPos&id=".$id."' title='Encomenda Postada'> <spam class='glyphicon glyphicon-envelope'> </spam> </a>";
						echo "<a href='?tela=entregaTrans&id=".$id."' title='Encomenda em Transito'> <spam class='glyphicon glyphicon-plane'> </spam> </a>";
						echo "<a href='?tela=entregaok&id=".$id."' title='Encomenda Entregue'> <spam class='glyphicon glyphicon-ok'> </spam> </a></td>";
						echo "</tr>";
					}
					desconectar($link);
					?>

			</tbody>

		</table>


		

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
