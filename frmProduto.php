<?php include_once "funcoes.php";
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
					<li class="dropdown active">
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
			$msg=null;
			$status=null;
			if(isset($_GET['tela']) && $_GET['tela'] == "editar" ){
				if(isset($_GET['id'])){
					$id = base64_decode($_GET['id']);
					$modulo = "edtproduto.php?id=".$id;

					$link = conectar();
					$sql = "SELECT * FROM Produto WHERE codigo_prod = {$id} LIMIT 1";
					$res = mysqli_query($link,$sql);
					while ($dados = mysqli_fetch_array($res)) {
						$nome = $dados['nome'];
						$desc = $dados['descr'];
						$preco = $dados['preco'];
						$stauts = $dados['status'];
						$btn = "Alterar";
						$msg = "alterado";
					}
					desconectar($link);
				}
			}elseif(isset($_GET['tela']) && $_GET['tela'] == "excluir" ){
				if(isset($_GET['id'])){
					$id = base64_decode($_GET['id']);
					$modulo = "delproduto.php?id=".$id;


					$link = conectar();
					$sql = "SELECT * FROM Produto WHERE codigo_prod = {$id} LIMIT 1";
					$res = mysqli_query($link,$sql);
					while ($dados = mysqli_fetch_array($res)) {
						$nome = $dados['nome'];
						$desc = $dados['descr'];
						$preco = $dados['preco'];
						$stauts = $dados['status'];
						$btn = "Excluir";
						$msg = "exluido";
					}
					desconectar($link);
				}
			}else{
				$nome = "";
				$desc = "";
				$preco = "";
				$status = "";
				$modulo = "cadproduto.php";
				$btn = "Cadastrar";
				$msg = "cadastrado";
			}

			if(isset($_GET['msg']) && $_GET['msg'] == 1 ){
				echo "<div class='alert alert-success'> Produto $msg com sucesso! </div>";
			}elseif (isset($_GET['msg']) && $_GET['msg']==0) {
				echo "<div class='alert alert-danger'> Produto não $msg! </div>";
			}

			 ?>
		<form class="form-horizontal" method="POST" action="<?php echo $modulo; ?>">
			<fieldset>
				<div class="form-group">
			        <label class="control-label col-xs-2">Nome</label>
			        <div class="col-xs-5">
			            <input type="text" class="form-control" <?php echo ($msg == "excluido") ? "" : "required"; ?> name="inomep" placeholder="Nome do Produto" value="<?php echo $nome; ?>">
						<input type="hidden" <?php echo ($msg == "cadastrado") ? "" : "required"; ?> name="icod" value="<?php echo $id; ?>"/>
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="control-label col-xs-2">Preço</label>
			        <div class="col-xs-5">
			            <input type="text" class="form-control" <?php echo ($msg == "excluido") ? "" : "required"; ?> name="ipreco" placeholder="Preço" value="<?php echo $preco; ?>">
			        </div>
			    </div>
			    <div class="form-group">
			    	<label class="control-label col-xs-2">Descricao</label>
			    	<div class="col-xs-5">
			    		<textarea class="form-control" name="txtdesc" placeholder="Descricao do Produto"><?php echo $desc ?></textarea>
			    	</div>
			    </div>
			    <div class="form-group">
			        <div class="col-xs-offset-2 col-xs-5">
			            <div class="checkbox">
			                <label><input type="checkbox" name="cstatus[]" <?php if($status==1) echo "checked";?> >Ativar</label>
			            </div>
			        </div>
			    </div>
			    <div class="form-group">
			        <div class="col-xs-offset-2 col-xs-10">
			            <button type="submit" class="btn btn-primary" name="btnCad"><?php echo $btn; ?></button>
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