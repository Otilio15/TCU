<?php require_once "vistas/parte_superior.php"?>
<?php 


if (!isset($_SESSION['conectado']) or $_SESSION['conectado'] == 0) {
	header("Location: login.php");	
}
if (isset($_SESSION['IdRol']) and $_SESSION['IdRol'] == 2)  {
	header("Location: index.php");
}
include('userBD.php');

if(isset($_GET['edit'])){
	$IdUser = $_GET['edit'];
	$edit_state = true;

	$sql="select * from users where IdUser= $IdUser";
	$results = mysqli_query($bdc, $sql);
	 while ($reg = mysqli_fetch_array($results)) {
		$Email = $reg['Email'];
        $Clave = $reg['Clave'];
        $IdRol = $reg['IdRol'];
	 }
}
?>
<?php 
$sql="SELECT * FROM roles";
$res = mysqli_query($bdc, $sql);

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
	<form method="post" action="userBD.php" >
	
	<legend>Datos Personales</legend>
	<input type="hidden" name="IdUser" value="<?php echo $IdUser; ?>" >
	
	<div class="form-row">
		<div class="form-group col-md-6">
			<label>Email</label>
			<input type="email" class="form-control" name="Email" value="<?php echo $Email;?>"
			required>
		</div>
		<div class="form-group col-md-6">
			<label>Clave</label>
			<input type="password" class="form-control" name="Clave" value="<?php echo $Clave; ?>"
			required>
		</div>
		
  </div>
  <div class="form-group">
      <label >Seleccionar Rol</label>
      <select  class="form-control" name="IdRol" style="text-align:center;" required>
	  <?php
			while($rows = $res->fetch_assoc())
			{
				$IdRol = $rows['IdRol'];
				$Rol = $rows['Rol'];
				echo "<option value='$IdRol'>$Rol</option>";
			}
		?>
      </select>
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
		  
   <div class="text-center back-button" role="group"  >
          <a href="index.php" class="btn btn-secondary btn-user btn-block">
                  <i class="fas fa-times"></i> Atrás
                </a>
          </div>
</div>


		
</form>



	
</div>
	
<script>
		$(function() {
		setTimeout(function() { $("#hideDiv").fadeOut(1000); }, 1000),
		setTimeout(function() { $("#de").fadeOut(1000); } ,1000)
		})
	</script>
<?php require_once "vistas/parte_inferior.php"?>



</body>


                  