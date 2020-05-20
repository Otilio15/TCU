<?php

session_start();

$bdc = mysqli_connect("localhost", "id13721146_pawloguser", "bBo5eq6Qn61-bR4*") or die(mysqli_error($bdc));
mysqli_set_charset($bdc,"utf-8");
mysqli_select_db($bdc, "id13721146_pawlog") or die(mysqli_error($bdc));

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$sql="select * from users where Email='".$usuario."'AND Clave=md5('".$clave."') limit 1";

$result=mysqli_query($bdc,$sql);
while ($reg = mysqli_fetch_array($result)){
	$IdUser = $reg{0};
	$IdRol = $reg{3};
	$FechaLogin = $reg{4};
}
$_SESSION['IdRol'] = $IdRol; 
$_SESSION['result'] = $result;
$_SESSION['FechaLogin'] = $FechaLogin;

if ($FechaLogin != null and $FechaLogin < (date("Y-m-d", time() - (86400*30) ))) {
	header("Location: errorFechaLogin.php");
	exit();
}
if ( mysqli_num_rows($result)==1) {
	$_SESSION['conectado'] = 1;
	$_SESSION['usuario'] = $usuario;
	$_SESSION['intentos'] = 0;

	$actualiza="update users	set FechaLogin = curdate() where IdUser = '". $IdUser."'";
	$result=mysqli_query($bdc,$actualiza);

	header("Location: index.php");
	exit();
} else {
$_SESSION['conectado'] = 0;
if (isset($_SESSION ['intentos'])) {
	$_SESSION['intentos'] = $_SESSION['intentos'] + 1;
	if ($_SESSION['intentos']==3) {
		header("Location: error.php");
		exit;
	}
} else {
	$_SESSION['intentos']=1;
}

header("Location: login.php");
exit();	
}

?>
<?php   

if(isset($_POST['usuario']) == true && empty($_POST['usuario']) == false){
	$usuario = $_POST['Correo'];
	if (filter_var ($usuario, FILTER_VALIDATE_EMAIL) == true){
		echo 'Correo valido';
	}else{
		echo 'Correo inválido';
	}

}
?>