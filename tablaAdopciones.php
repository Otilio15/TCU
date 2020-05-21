<?php require_once "vistas/parte_superior.php"?>

<?php 
if (!isset($_SESSION['conectado']) or $_SESSION['conectado'] == 0) {
	header("Location: login.php");
	
}
include('adopcionesBD.php');

if(isset($_GET['edit'])){
	$IdAnimal = $_GET['edit'];
	$edit_state = true;

	$sql="select * from animales where IdAnimal= $IdAnimal";
	mysqli_set_charset($bdc,"utf-8");
	$results = mysqli_query($bdc, $sql);
	 while ($reg = mysqli_fetch_array($results)) {
           $IdTmañoActual = $reg['IdTmañoActual'];
           $IdTamañoProyectado = $reg['IdTamañoProyectado'];
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



<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



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



    <div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h2 class="m-0 font-weight-bold text-primary">Adopciones</h2>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col" style="text-align: center">Nombre Actual</th>
            <th scope="col" style="text-align: center">Raza</th>
            <th scope="col" style="text-align: center">Edad</th>
            <th scope="col" style="text-align: center">Foto</th>
            <th scope="col" style="text-align: center">Detalles</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th scope="col" style="text-align: center">Nombre Actual</th>
            <th scope="col" style="text-align: center">Raza</th>
            <th scope="col" style="text-align: center">Edad</th>
            <th scope="col" style="text-align: center">Foto</th>
            <th scope="col" style="text-align: center">Detalles</th>
          </tr>
        </tfoot>
        <tbody>
        <?php while ($reg = mysqli_fetch_array($results)) { ?>
		<tr class="active">
			
			<td style="vertical-align: middle; text-align: center"><?php echo $reg['UltimoNombre']; ?></td>
			
			<td style="vertical-align: middle; text-align: center"><?php echo $reg['Raza']; ?></td>

			<td style="vertical-align: middle; text-align: center"><?php echo $reg['EdadActual']; ?></td>
	
			<td style="vertical-align: middle; text-align: center"><?php echo "<img src='./recursos/".$reg['Foto']."'min-width='400px'; width='40%''>" ?></td>
			
		

			<td style="vertical-align: middle; text-align: center">
				<a href="createAdopciones.php?edit=<?php echo $reg['IdAnimal']; ?>" class="btn btn-success" >Ver Gatito</a>
			</td>
	
			
		</tr>
	<?php } ?>

        </tbody>
      </table>
    </div>
  </div>

  <div class="text-center back-button" role="group"  >
          <a href="index.php" class="btn btn-secondary btn-user btn-block">
                  <i class="fas fa-times"></i> Atrás
                </a>
          </div>
</div>

</div>

<?php require_once "vistas/parte_inferior.php"?>

 <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  
  <script>
		$(function() {
		setTimeout(function() { $("#hideDiv").fadeOut(1000); }, 1000),
		setTimeout(function() { $("#de").fadeOut(1000); } ,1000)
		})
	</script>