<?php 
define("PASSWD","123");
inicializa();

function conectar(){
	$host = "localhost";
	$db = "sist_encomenda";
	$user = "root";
	$pass = "";
		$con =	mysqli_connect($host,$user,$pass);	
		if(mysqli_connect_errno($con)){
			die('não foi possivel conectar no banco' . mysqli_connect_error());
		}
		mysqli_select_db($con,$db);
		return $con;
}

function desconectar($conexao){
	mysqli_close($conexao);
}


function codificasenha($senha){
	return md5($senha);
}

function redireciona($page){
	header("Location: ". $page);

}

function existeEmail($email,$tabela)
{
	$link = conectar();

	$sql = "SELECT * FROM {$tabela} WHERE email = {$email}";

	mysqli_query($link,$sql);
	if(mysqli_affected_rows($link)==1){
		desconectar($link);
		return true;
	}else{
		desconectar($link);
		return false;
	}

}

function geraTimestamp($data) {
	$partes = explode('-', $data);
	settype($partes[0], "integer");
	settype($partes[1], "integer");
	settype($partes[2], "integer");
	return  mktime(0, 0, 0, $partes[1], $partes[2],$partes[0]);
}

	
function calcularData($datap){
	$datahoje = date("Y-m-d");
	
	$timeprev = geraTimestamp($datap);
	$timehoje = geraTimestamp($datahoje);
	$diferenca = $timeprev - $timehoje;
	$dias =  (int)floor( $diferenca / (60 * 60 * 24)); 
	return $dias;
}


function calcularStatus($datap){
	
	$dias = calcularData($datap);
	
	if($dias == 0)
		return "Ultimo dia";
	elseif ($dias < 0)
		return "Atrasado ".($dias*1)." dias";
	else
		return "Restam ".$dias." dias";
}

function inicializa(){
	session_start();
	if(!isset($_SESSION['idFunc']) || empty($_SESSION['idFunc'])){
		redireciona("index.php");
	}
}

function md5_decrypt($enc_text, $password, $iv_len = 16)
{
   $enc_text = base64_decode($enc_text);
   $n = strlen($enc_text);
   $i = $iv_len;
   $plain_text = '';
   $iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
   while ($i < $n) {
      $block = substr($enc_text, $i, 16);
      $plain_text .= $block ^ pack('H*', md5($iv));
      $iv = substr($block . $iv, 0, 512) ^ $password;
      $i += 16;
   }
   return preg_replace('/\x13\x00*$/', '', $plain_text);
}

function get_rnd_iv($iv_len)
{
   $iv = '';
   while ($iv_len-- > 0) {
      $iv .= chr(mt_rand() & 0xff);
   }
   return $iv;
}
       
function md5_encrypt($plain_text, $password, $iv_len = 16)
{
   $plain_text .= "x13";
   $n = strlen($plain_text);
   if ($n % 16) $plain_text .= str_repeat("{TEXTO}", 16 - ($n % 16));
   $i = 0;
   $enc_text = get_rnd_iv($iv_len);
   $iv = substr($password ^ $enc_text, 0, 512);
   while ($i < $n) {
      $block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));
      $enc_text .= $block;
      $iv = substr($block . $iv, 0, 512) ^ $password;
      $i += 16;
   }

   return base64_encode($enc_text);
}





?>