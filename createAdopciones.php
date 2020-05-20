<?php require_once "vistas/parte_superior.php"?>


<?php 


if (!isset($_SESSION['conectado']) or $_SESSION['conectado'] == 0) {
	header("Location: login.php");
	
}
include('animalsBD.php');

if(isset($_GET['edit'])){
	$IdAnimal = $_GET['edit'];
	$edit_state = true;

	$sql="select *, TIMESTAMPDIFF(YEAR,Edad,CURDATE()) AS EdadActual from animales where IdAnimal= $IdAnimal";
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
        $FechaNacimiento = $reg['Edad'];
        $Edad = $reg['EdadActual'];
        $Foto = $reg['Foto'];
	 }
	 $_SESSION['IdAnimal'] = $IdAnimal;
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
	<form>
	
	<legend>Información Importante de los Gatitos</legend>
	<input type="hidden" name="IdAnimal" value="<?php echo $IdAnimal; ?>" >
	
	<div class="form-row">
		
		<div class="form-group col-md-6">
			<label>Nombre Original</label>
			<input disabled type="text" class="form-control" name="NombreOriginal" value="<?php echo $NombreOriginal;?>">
		</div>
		<div class="form-group col-md-6">
			<label>Último Nombre</label>
			<input disabled type="text" class="form-control" name="UltimoNombre" value="<?php echo $UltimoNombre;?>">
		</div>
		<div class="form-group col-md-6">
			<label>Especie</label>
			<input disabled type="text" class="form-control" name="Especie" value="<?php echo $Especie;?>">
		</div>
		<div class="form-group col-md-6">
			<label>Raza del Gatito</label>
			<input disabled type="text" class="form-control" name="Raza" value="<?php echo $Raza;?>">
		</div>
		<div class="form-group col-md-6">
			<label>Género</label>
			<input disabled type="text" class="form-control" name="Sexo" value="<?php echo $Sexo;?>">
		</div>
		
		<div class="form-group col-md-6">
			<label>Edad del Gatito</label>
			<input disabled type="text" class="form-control" name="Edad" value="<?php echo $Edad;?>">
		</div>

		<div class="form-group col-md-6">
			<label>Fecha de Nacimiento</label>
			<input disabled type="text" class="form-control" name="FechaNacimiento" value="<?php echo $FechaNacimiento;?>">
		</div>

		<div class="form-group col-md-6">
			<label hidden>CAMPO EN BLANCO PARA ORDENAR LOS FORMULARIOS</label>
			<input hidden type="text" class="form-control" name="Edad" value="<?php echo $Edad;?>">
		</div>

		<div class="form-group col-md-4">
      		<label >Tamaño Actual</label>
     	 	<select  class="form-control" name="IdTamañoActual" disabled>
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
     	 	<select  class="form-control" name="IdTamanoProyectado" disabled>
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
     	 	<select  class="form-control" name="IdTemperamento" disabled>
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
       	<?php echo "<img src='./recursos/".$Foto."'min-width='400px'; width='40%''>" ?>
      	</div>
    </section>

	<div class="form-group">
		<br>
    <label>Información Adicional</label>
	<textarea disabled type="text" class="form-control" name="OtrasSenas" rows="2"><?php echo $OtrasSenas?></textarea>
  </div>

 <!-- <?php /*echo $_SESSION['IdAnimal']; */?> --> 
		
	
</form>



	
<div class="btn-toolbar justify-content-between" role="toolbar">
  <div class="btn-group" role="group">
  <button class="btn btn-success btn-user btn-block" onclick="window.location='createPersona.php';" >Adoptar</button>		
  </div>
  <div class="btn-group" role="group">
  <button class="btn btn-danger btn-block" onclick="window.location='tablaAdopciones.php';" >Ir Atrás</button>
  
          </div>
</div>    

</div>

	
<script>
		$(function() {
		setTimeout(function() { $("#hideDiv").fadeOut(1000); }, 1000),
		setTimeout(function() { $("#de").fadeOut(1000); } ,1000)
		})
	</script>

 

<?php require_once "vistas/parte_inferior.php"?>
</body>
