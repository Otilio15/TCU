<?php require_once "vistas/parte_superior.php"?>

<?php 


if (!isset($_SESSION['conectado']) or $_SESSION['conectado'] == 0) {
	header("Location: login.php");
	
}
include('personaBD.php');

if(isset($_GET['edit'])){
	$IdPersona = $_GET['edit'];
	$edit_state = true;

	$sql="select * from personas where IdPersona= $IdPersona";
	$results = mysqli_query($bdc, $sql);
	 while ($reg = mysqli_fetch_array($results)) {
		$IdPersona =  $reg['IdPersona'];
		$PrimerNombre = $reg['PrimerNombre'];
		$SegundoNombre = $reg['SegundoNombre'];
		$PrimerApellido= $reg['PrimerApellido'];
		$SegundoApellido= $reg['SegundoApellido'];
		$Cedula= $reg['Cedula'];
		$Correo= $reg['Correo'];		
		$Edad= $reg['Edad'];		
		$Sexo= $reg['Sexo'];		
		$EstadoCivil= $reg['EstadoCivil'];
		$TrabajoFijo= $reg['TrabajoFijo'];
		$Celular= $reg['Celular'];		
		$Direccion =  $reg['Direccion'];
		$IdDistrito =  $reg['IdDistrito'];
		$IdProvincia =  $reg['IdProvincia'];
		$IdCanton =  $reg['IdCanton'];
	 }
}
?>

<?php 
//coneccion para provincia canton y distrito
$connection = new mysqli("localhost", "id13721146_pawloguser", "mWUl_VeBP4WBL","id13721146_pawlog");
$connection -> set_charset("utf8");
if (! $connection){
    die("Error in connection".$connection->connect_error);
}


//clase para provincia canton y distrito

class Common {
    public function getProvincia($connection){
        $query = "SELECT * FROM tblProvincia";
        $result = $connection->query($query);
        return $result;
    }

    public function getCantonProvincia($connection,$IdProvincia) {
        $query = "SELECT * FROM tblCanton WHERE IdProvincia='$IdProvincia'";
        $result = $connection->query($query);
        return $result;
    }

    public function getDistritoCanton($connection,$IdCanton)
    {
        $query = "SELECT * FROM tblDistrito WHERE IdCanton='$IdCanton'";
        $result = $connection->query($query);
        return $result;
    }
}

//inicializa la clase y carga las provincias
$common = new Common();
$todasProvincias = $common->getProvincia($connection);

?>
<?php   

if(isset($_POST['Correo']) == true && empty($_POST['Correo']) == false){
	$Correo = $_POST['Correo'];
	if (filter_var ($Correo, FILTER_VALIDATE_EMAIL) == true){
		echo 'Correo valido';
	}else{
		echo 'Correo inválido';
	}

}
?>

<body>


<?php if (isset($_SESSION['msg'])):?>
		<div id="hideDiv">
			<?php 
			 	echo ($_SESSION['msg']); 
				unset( $_SESSION['msg']);
			?>
		</div>
	<?php endif ?>
	<?php if (isset($_SESSION['de'])):?>
		<div id="de">
				<?php 
					echo ($_SESSION['de']); 
					unset($_SESSION['de']);
				?>
		</div>
	<?php endif ?>

	

	<body class="bg-gradient-primary">
        
    <div class="container">

	<form method="post" action="personaBD.php" >
	
	<legend>Datos Personales</legend>
	<input type="hidden" name="IdPersona" value="<?php echo $IdPersona; ?>" >
	
	<div class="form-row">
		<div class="form-group col-md-6">
			<label>Primer Nombre</label>
			<input type="text" class="form-control" name="PrimerNombre" value="<?php echo $PrimerNombre;?>"
			required="true">
		</div>
		<div class="form-group col-md-6">
			<label>Segundo Nombre</label>
			<input type="text" class="form-control" name="SegundoNombre" value="<?php echo $SegundoNombre; ?>">
		</div>
		<div class="form-group col-md-6">
			<label>Primer Apellido</label>
			<input type="text" class="form-control" name="PrimerApellido" value="<?php echo $PrimerApellido;?>"
			required="true">
		</div>
		<div class="form-group col-md-6">
			<label>Segundo Apellido</label>
			<input type="text" class="form-control" name="SegundoApellido" value="<?php echo $SegundoApellido; ?>"
			required="true">
		</div>
		<div class="form-group col-md-6">
			<label>Cédula</label>
			<input type="text" class="form-control" name="Cedula" value="<?php echo $Cedula;?>"
			required="true">
		</div>
		<div class="form-group col-md-6">
			<label>Fecha Nacimiento</label>
			<input type="date" class="form-control" name="Edad" value="<?php echo $Edad; ?>"
			required="true">
		</div>
  </div>
	<div class="form-group">
			<label>Correo Electrónico</label>
			<input type="email" class="form-control" name="Correo" value="<?php echo $Correo;?>">

	</div>

<div class="form-row">
    <div class="form-group col-md-6">
      <label>Genero</label> 
    	  <select  id="Sexo" class="form-control" name="Sexo" value="<?php echo $Sexo;?>" required="true">
				<option hidden>Seleccione una opción</option>
				<option>Maculino</option>
				<option>Femenino</option>
			</select>
    </div>
	
	<div class="form-group col-md-6">
      <label>Estado Civil</label>
	  <select name="estadoCivil" id="estadoCivil" class="form-control" value="<?php echo $EstadoCivil;?>"required="true">	 
	 <option hidden>Seleccione una opción</option>
	  <option>Soltero</option>
	  <option>Casado</option>
	  <option>Viudo</option>
	  </select>
     
	</div>
	
    <div class="form-group col-md-6">
      <label>Trabajo Fijo</label>
      <input type="text" class="form-control" name="TrabajoFijo" value="<?php echo $TrabajoFijo;?>">
	</div>
	
	
    <div class="form-group col-md-6">
      <label>Celular</label>
      <input type="text" class="form-control" name="Celular" value="<?php echo $Celular;?>"
	  required="true">
	</div>

	
	<div class="form-group col-md-4">		
		<label >Provincia</label>
        <select name="provincia" id="IdProvincia" class="form-control" onchange="getCantonProvincia();" required="true">
		<option hidden>Seleccione una opción</option>
            <?php
            if ($todasProvincias->num_rows > 0 ){
                while ($provincia = $todasProvincias->fetch_object() ) {
                    $IdProvincia = $provincia->IdProvincia;
                    $NombreProvincia = $provincia->NombreProvincia;?>
                    <option value="<?php echo $IdProvincia;?>"><?php echo $NombreProvincia;?></option>
                <?php }
            }
            ?>
        </select>
    </div>

	<div class="form-group col-md-4">
      <label >Canton</label>
      <select class="form-control" name="canton" id="IdCanton" onchange="getDistritoCanton();" required="true">
	  <option hidden>Seleccione una opción</option>
        </select>
    </div>

	<div class="form-group col-md-4">
      <label >Distrito</label>
      <select class="form-control" name="distrito" id="distritoDiv" required="true">
	  <option hidden>Seleccione una opción</option>
      </select>
    </div>

</div>
        </br>
	<div class="form-group">
    <label>Indique la dirección</label>
    <textarea type="text" class="form-control" name="Direccion" rows="2" required="true"><?php echo $Direccion?></textarea>
    <div class="btn-toolbar justify-content-between buttons" role="toolbar">
  <div class="btn-group" role="group">
    <?php if($edit_state == false):?>
			<button class="btn btn-success " type="submit" name="save" ><i class="fas fa-folder-plus"></i> Guardar
            
		<?php else: ?>
			<button class="btn btn-success" type="submit" name="update" > <i class="fas fa-user-edit"></i> Actualizar</button>
			
		<?php endif?>
  </div>
  <div class="btn-group" role="group">
          <a href="tablaPersonas.php" class="btn btn-danger btn-user btn-block">
                  <i class="fas fa-times"></i> Cancelar
                </a>
          </div>
</div>
<div class="text-center back-button" role="group"  >
          <a href="index.php" class="btn btn-secondary btn-user btn-block">
                  <i class="fas fa-times"></i> Atrás
                </a>
          </div>
		
</form>

 <div class="text-center back-button">
            <a href="tablaPersonas.php" class="btn btn-primary btn-user btn-block">
                <i class="fas fa-long-arrow-alt-left">Atrás</i>    
            </a>
          </div>
</div>
<script> 
	//funciones para provincia canton y distrito
    function getCantonProvincia() {
        var IdProvincia = $("#IdProvincia").val();
        $.post("ajaxlocation.php",{getCantonProvincia:'getCantonProvincia',IdProvincia:IdProvincia},function (response) {
            //alert(response);
            var data = response.split('^');
            var cantonesData = data[1];
            $("#IdCanton").html(cantonesData);
        }).done(function(){
			$("#IdCanton").change()
		});
    }

    function getDistritoCanton() {
        var IdCanton = $("#IdCanton").val();
        $.post("ajaxlocation.php",{getDistritoCanton:'getDistritoCanton',IdCanton:IdCanton},function (response) {
            //alert(response);
            var data = response.split('^');
            var distritosData = data[1];
            $("#distritoDiv").html(distritosData);
        });
    }
</script>	
	
<script>
		$(function() {
		setTimeout(function() { $("#hideDiv").fadeOut(1000); }, 1000),
		setTimeout(function() { $("#de").fadeOut(1000); } ,1000)
		})
	</script>
  
 
<?php require_once "vistas/parte_inferior.php"?>
</body>
</html>