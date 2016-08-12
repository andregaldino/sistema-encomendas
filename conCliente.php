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
					<li class="dropdown">
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
					<li class="dropdown active">
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
					    	<input type="number" class="form-control" name="ibcpf" placeholder="CPF do Cliente">
					    </div>
					    <div class="form-group">
					        <input type="text" class="form-control" name="ibnome" placeholder="Nome do Cliente">
					    </div>
					    <div class="form-group">
					        <input type="text" class="form-control" name="ibemail" placeholder="Email do Cliente">
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
			<th>Nome</th>
			<th>CPF</th>
			<th>Residencial</th>
			<th>Celular</th>
			<th>Email</th>
			<th>Status</th>
			<th>Ações</th>
		</thead>
		<tbody>
				<?php 
				$link = conectar();
				$condicao = "";
				$and = null;
				if(isset($_POST['btnPesq'])){
					if($_POST['ibcpf'] != NULL || $_POST['ibnome'] != NULL || $_POST['ibemail'] != NULL){
						$condicao = " WHERE ";
						if($_POST['ibcpf'] != NULL){
							$condicao .= " cpf = ". $_POST['ibcpf'];
							$and = true;
						}
						if($_POST['ibnome'] != NULL){
							if($and){
								$condicao .= " AND nome LIKE '%". $_POST['ibnome']. "%'";
							}else{
								$condicao .= " nome LIKE '%". $_POST['ibnome']. "%'";
								$and = true;
							}
						}

						if($_POST['ibemail']!= NULL){
							if($and){
								$condicao .= " AND email = '". $_POST['ibemail']. "'";
							}else{
								$condicao .= " email = '". $_POST['ibemail']. "'";
								$and = true;
							}
						}

					}

				}

				$sql = "SELECT * FROM cliente " . $condicao;
				
				$res = mysqli_query($link,$sql);
				while ($dados = mysqli_fetch_array($res)){
					echo "<tr>";
					echo "<td>".$dados['codigo_cli']."</td>";
					echo "<td>".$dados['nome']."</td>";	
					echo "<td>".$dados['cpf']."</td>";	
					echo "<td>".$dados['tel_residencial']."</td>";
					echo "<td>".$dados['tel_celular']."</td>";
					echo "<td>".$dados['email']."</td>";	
					if($dados['status']==1){
						echo "<td><spam>Ativo</spam></td>";
					}else{
						echo "<td><spam>Desativado</spam></td>";	
					}
					$id = base64_encode($dados['codigo_cli']);
					echo "<td><a href='frmCliente.php?tela=editar&id=".$id."' title='Editar Cliente'> <spam class='glyphicon glyphicon-pencil'> </spam> </a>";
					
					echo "<a href='frmCliente.php?tela=excluir&id=".$id."' title='Excluir Cliente'> <spam class='glyphicon glyphicon-remove'> </spam> </a>";
					echo "</td>";
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
