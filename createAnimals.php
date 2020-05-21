<?php require_once "vistas/parte_superior.php"?>

<?php 

session_start();
if (!isset($_SESSION['conectado']) or $_SESSION['conectado'] == 0) {
	header("Location: login.php");
	
}
include('animalsBD.php');

if(isset($_GET['edit'])){
	$IdAnimal = $_GET['edit'];
	$edit_state = true;

	$sql="select * from animales where IdAnimal= $IdAnimal";
	$results = mysqli_query($bdc, $sql);
	 while ($reg = mysqli_fetch_array($results)) {
	 	$IdAnimal = $reg['IdAnimal'];
		$IdTamañoActual = $reg['IdTamañoActual'];
        $IdTamanoProyectado = $reg['IdTamanoProyectado'];
        $IdTemperamento = $reg['IdTemperamento'];
        $NombreOriginal = $reg['NombreOriginal'];
        $UltimoNombre = $reg['UltimoNombre'];
        $Especie = $reg['Especie'];
        $Raza = $reg['Raza'];
        $Sexo = $reg['Sexo'];
        $OtrasSenas = $reg['OtrasSenas'];
        $Edad = $reg['Edad'];
        $Foto = $reg['Foto'];
	 }
}

?>
<?php 
$sql="SELECT * FROM tamanos";
$res_1 = mysqli_query($bdc, $sql);
?>

<?php 
$sql="SELECT * FROM tamanos";
$res_3 = mysqli_query($bdc, $sql);
?>
<?php 
$sql="SELECT * FROM temperamentos";
$res_2 = mysqli_query($bdc, $sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h3 text-gray-900 mb-4">Información Importante de los Gatitos</h1>
              </div>
                  <form method="post" action="animalsBD.php" enctype='multipart/form-data'>
	
	
	<input type="hidden" name="IdAnimal" value="<?php echo $IdAnimal; ?>" >
	
	<div class="form-row">
		
		<div class="form-group col-md-6">
			<label>Nombre Original</label>
			<input type="text" class="form-control" name="NombreOriginal" value="<?php echo $NombreOriginal;?>"
			required="true">
		</div>
		<div class="form-group col-md-6">
			<label>Último Nombre</label>
			<input type="text" class="form-control" name="UltimoNombre" value="<?php echo $UltimoNombre;?>" 
			required="true">
		</div>
		<div class="form-group col-md-6">
			<label>Especie</label>
			<input type="text" class="form-control" name="Especie" value="<?php echo $Especie;?>"
			required="true">
		</div>
		<div class="form-group col-md-6">
			<label>Raza del Gatito</label>
			<input type="text" class="form-control" name="Raza" value="<?php echo $Raza;?>"
			required="true">
		</div>
		<div class="form-group col-md-6">
			<label>Género</label>
			<select  id="Sexo" class="form-control" name="Sexo" value="<?php echo $Sexo;?>" required="true">
				<option hidden>Seleccione una opción</option>
				<option>Macho</option>
				<option>Hembra</option>
			</select>
		</div>
		<div class="form-group col-md-6">
			<label>Fecha Nacimiento</label>
			<input type="date" class="form-control" name="Edad" value="<?php echo $Edad; ?>" required="true">
		</div>
		<div class="form-group col-md-4">
      		<label >Tamaño Actual</label>
     	 	<select  class="form-control" name="IdTamañoActual" required="true">
	    <?php
			while($rows = $res_1->fetch_assoc())
			{
				$IdTamanos = $rows['IdTamanos'];
				$Tamano = $rows['Tamano'];
				echo "<option value='$IdTamanos'>$Tamano</option>";
			}
		?>
 </select>
    </div>

		<div class="form-group col-md-4">
      		<label >Tamaño Proyectado</label>
     	 	<select  class="form-control" name="IdTamanoProyectado" required="true">
	    <?php
			while($rows = $res_3->fetch_assoc())
			{
				$IdTamanos = $rows['IdTamanos'];
				$Tamano = $rows['Tamano'];
				echo "<option value='$IdTamanos'>$Tamano</option>";
			}
		?>
 </select>
    </div>
		
	
		<div class="form-group col-md-4">
      		<label >Temperamento</label>
     	 	<select  class="form-control" name="IdTemperamento" required="true">
	    <?php
			while($rows = $res_2->fetch_assoc())
			{
				$IdTemperamentos = $rows['IdTemperamentos'];
				$Temperamento =$rows['Temperamento'];
				echo "<option value='$IdTemperamentos'>$Temperamento</option>";
			}
		?>
      </select>
    </div>
	
</div>

    <label>Foto Gatito</label>

	<section >
       	<div>  
         <input type="file" id="image" name='Foto' class="form-control-file" style="min-width: 13rem" 
		 required="true">
      	</div>
    </section>

	<div class="form-group">
    <label>Información Adicional</label>
	<textarea type="text" class="form-control" name="OtrasSenas" rows="2"><?php echo $OtrasSenas?></textarea>
  </div>
  <div class="btn-toolbar justify-content-between" role="toolbar">
  <div class="btn-group" role="group">
    <?php if($edit_state == false):?>
			<button class="btn btn-primary " type="submit" name="save" ><i class="fas fa-folder-plus"></i> Guardar
            
		<?php else: ?>
			<button class="btn btn-success" type="submit" name="update" > <i class="fas fa-user-edit"></i> Actualizar</button>
			
		<?php endif?>
  </div>
  <div class="btn-group" role="group">
          <a href="index.php" class="btn btn-danger btn-user btn-block">
                  <i class="fas fa-times"></i> Cancelar
                </a>
          </div>
</div>

		
</form>

                  
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

    <?php require_once "vistas/parte_inferior.php"?>

  

</body>

</html>
