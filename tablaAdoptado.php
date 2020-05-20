<?php require_once "vistas/parte_superior.php"?>

<?php 
if (!isset($_SESSION['conectado']) or $_SESSION['conectado'] == 0) {
	header("Location: login.php");
	
}
$bdc = mysqli_connect("localhost", "id13721146_pawloguser", "bBo5eq6Qn61-bR4*") or die(mysqli_error($bdc));
  $bdc -> set_charset("utf8");
    mysqli_select_db($bdc, "id13721146_pawlog") or die(mysqli_error($bdc));

$sql= "SELECT        id13721146_pawlog.animales.UltimoNombre, id13721146_pawlog.animales.Raza, id13721146_pawlog.animales.Sexo, id13721146_pawlog.animales.Foto, TIMESTAMPDIFF(YEAR,id13721146_pawlog.animales.Edad,CURDATE()) AS EdadAnimal, 
			  id13721146_pawlog.personas.PrimerNombre, id13721146_pawlog.personas.PrimerApellido, id13721146_pawlog.personas.Cedula, TIMESTAMPDIFF(YEAR,id13721146_pawlog.personas.Edad,CURDATE()) AS EdadPersona
		FROM          id13721146_pawlog.personas RIGHT OUTER JOIN
			  id13721146_pawlog.adopciones ON id13721146_pawlog.personas.IdPersona = id13721146_pawlog.adopciones.IdPersona LEFT OUTER JOIN
              id13721146_pawlog.animales ON id13721146_pawlog.adopciones.IdAnimal = id13721146_pawlog.animales.IdAnimal
		WHERE         (id13721146_pawlog.adopciones.IdAnimal IS NOT NULL)";
            $results = mysqli_query($bdc, $sql);
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
    <h2 class="m-0 font-weight-bold text-primary">Dueños y Gatitos</h2>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col" style="text-align: center">Nombre Actual</th>
            <th scope="col" style="text-align: center">Raza</th>
            <th scope="col" style="text-align: center">Sexo</th>
            <th scope="col" style="text-align: center">Edad Gatito</th>
            <th scope="col" style="text-align: center">Foto</th>
            <th scope="col" style="text-align: center">Nombre Adoptante</th>
            <th scope="col" style="text-align: center">Apellido Adoptante</th>
            <th scope="col" style="text-align: center">Cédula Adoptante</th>
            <th scope="col" style="text-align: center">Edad Adoptante</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th scope="col" style="text-align: center">Nombre Actual</th>
            <th scope="col" style="text-align: center">Raza</th>
            <th scope="col" style="text-align: center">Sexo</th>
            <th scope="col" style="text-align: center">Edad Gatito</th>
            <th scope="col" style="text-align: center">Foto</th>
            <th scope="col" style="text-align: center">Nombre Adoptante</th>
            <th scope="col" style="text-align: center">Apellido Adoptante</th>
            <th scope="col" style="text-align: center">Cédula Adoptante</th>
            <th scope="col" style="text-align: center">Edad Adoptante</th>
          </tr>
        </tfoot>
        <tbody>
            <?php while ($reg = mysqli_fetch_array($results)) { ?>
                <tr class="active">
                    
                    <td style="vertical-align: middle; text-align: center"><?php echo $reg['UltimoNombre']; ?></td>
                    
                    <td style="vertical-align: middle; text-align: center"><?php echo $reg['Raza']; ?></td>

                    <td style="vertical-align: middle; text-align: center"><?php echo $reg['Sexo']; ?></td>

                    <td style="vertical-align: middle; text-align: center"><?php echo $reg['EdadAnimal']; ?></td>
            
                    <td style="vertical-align: middle; text-align: center"><?php echo "<img src='./recursos/".$reg['Foto']."'min-width='400px'; width='40%''>" ?></td>
                    <td style="vertical-align: middle; text-align: center"><?php echo $reg['PrimerNombre']; ?></td>
                    
                    <td style="vertical-align: middle; text-align: center"><?php echo $reg['PrimerApellido']; ?></td>

                    <td style="vertical-align: middle; text-align: center"><?php echo $reg['Cedula']; ?></td>

                    <td style="vertical-align: middle; text-align: center"><?php echo $reg['EdadPersona']; ?></td>
                    
                


                </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>
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