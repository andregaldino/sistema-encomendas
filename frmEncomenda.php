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
		<?php 
			if(isset($_GET['tela']) && $_GET['tela'] == "excluir" ){
				$msg=null;
				if(isset($_GET['id'])){
					$id = base64_decode($_GET['id']);
					$modulo = "delEncomenda.php?id=".$id;
					
						
					$link = conectar();
					$sql = "SELECT * FROM encomenda JOIN cliente ON fk_cliente = codigo_cli JOIN funcionario ON fk_func = codigo_func JOIN produto ON fk_prod = codigo_prod ";
					$sql .= " WHERE codigo_enc = $id LIMIT 1";
					$res = mysqli_query($link,$sql);
					$listaprd = array();
					$listacli = array();
					while ($dados = mysqli_fetch_array($res)){
						
						$quantEnc = $dados['quantidade'];
						$datap = $dados['data_prevista'];
						
						$produto = array();
						$produto[0] = $dados[22];
						$produto[1] = $dados[23];
						$produto[3] = $dados[25];
						array_push($listaprd, $produto);
						
						$cliente = array();
						$cliente[0] = $dados[8];
						$cliente[1] = $dados[9];
						array_push($listacli, $cliente);
						
					}
					$msg = "Exluido";
					$btn = "Exluir";
					desconectar($link);
				}
			}else{
				$msg = "Cadastrado";
				$btn = "Cadastrar";
				$link = conectar();
				$sql = "SELECT * FROM produto";
				$res = mysqli_query($link,$sql);
				$listaprd = array();
				while ($dados = mysqli_fetch_array($res)){
					$produto = array();
					$produto[0] = $dados['codigo_prod'];
					$produto[1] = $dados['nome'];
					$produto[2] = $dados['descr'];
					$produto[3] = $dados['preco'];
					$produto[4] = $dados['status'];
					
					array_push($listaprd, $produto);
				}
				
				$sql = "SELECT * FROM cliente";
				$res2 = mysqli_query($link,$sql);
				$listacli = array();
				while ($linhas = mysqli_fetch_array($res2)){
					$cliente = array();
					$cliente[0] = $linhas['codigo_cli'];
					$cliente[1] = $linhas['nome'];
					$cliente[2] = $linhas['email'];
					$cliente[3] = $linhas['cpf'];
					$cliente[4] = $linhas['tel_residencial'];
					$cliente[5] = $linhas['tel_celular'];
					$cliente[6] = $linhas['status'];
					
					array_push($listacli, $cliente);
				}
				$modulo = "cadEncomenda.php";
			}
			if(isset($_GET['msg']) && $_GET['msg'] == 1 ){
				echo "<div class='alert alert-success'> Encomenda $msg com sucesso! </div>";
			}elseif (isset($_GET['msg']) && $_GET['msg']==0) {
				echo "<div class='alert alert-danger'> Encomenda não $msg! </div>";
			}
			?>
		<form class="form-horizontal" method="POST" action="<?php echo $modulo ?>">
			<fieldset>
				<div class="form-group">
			        <label class="control-label col-xs-2">Produto</label>
			        <div class="col-xs-5">
			            <select class="form-control" name="sproduto">
	                      <?php 
							foreach($listaprd as $vetor){
								echo "<option value='$vetor[0]'> $vetor[0] - $vetor[1] : $vetor[3] </option>";
							}
						  ?>
	                    </select>
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="control-label col-xs-2">Cliente</label>
			        <div class="col-xs-5">
			            <select class="form-control" name="scliente">
	                      <?php 
							foreach($listacli as $vetorc){
								echo "<option value='$vetorc[0]'> $vetorc[0] - $vetorc[1]</option>";
							}
						  ?>
	                    </select>
			        </div>
			    </div>
				<div class="form-group">
			        <label class="control-label col-xs-2">Data Prevista</label>
			        <div class="col-xs-5">
			            <input type="date" class="form-control" required <?php echo ($btn == "Excluir") ? "value='$datap'" : ""; ?> name="idataprev">
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="control-label col-xs-2">Quantidade</label>
			        <div class="col-xs-5">
			            <input type="number" class="form-control" required <?php echo ($btn == "Excluir") ? "value='$quantEnc'" : ""; ?> name="iquantidade" placeholder="Quantidade">
						<input type="hidden" name="icod" value="<?php echo $id; ?>"/>
			        </div>
			    </div>
			 	</div>
			    <div class="form-group">
			        <div class="col-xs-offset-2 col-xs-10">
			            <button type="submit" class="btn btn-primary" name="btnCad"><?php echo $btn?></button>
			        </div>
			    </div>
		    </fieldset>
		</form>
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