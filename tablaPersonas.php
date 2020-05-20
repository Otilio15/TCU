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
	mysqli_set_charset($bdc,"utf-8");
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
    <h2 class="m-0 font-weight-bold text-primary">Adoptantes</h2>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="dataTable" width="90%" cellspacing="0">
        <thead>
          <tr>
          <th scope="col">Primer Nombre</th>
        <th scope="col">Primer Apellido</th>
        <th scope="col">Segundo Apellido</th>
        <th scope="col">Cédula</th>
        <th scope="col">Email</th>
        <th scope="col">Celular</th>
        <th scope="col">Editar</th>
        <th scope="col">Ver/Editar</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
             <th scope="col">Primer Nombre</th>
             <th scope="col">Primer Apellido</th>
             <th scope="col">Segundo Apellido</th>
             <th scope="col">Cédula</th>
             <th scope="col">Email</th>
             <th scope="col">Celular</th>
             <th scope="col">Editar</th>
             <th scope="col">Ver/Editar</th>
          </tr>
        </tfoot>
        <tbody>
            <?php while ($reg = mysqli_fetch_array($results)) { ?>
                <tr class="active">
                    <td><?php echo $reg['PrimerNombre']; ?></td>
                    <td><?php echo $reg['PrimerApellido']; ?></td>
                    <td><?php echo $reg['SegundoApellido']; ?></td>
                    <td><?php echo $reg['Cedula']; ?></td>
                    <td><?php echo $reg['Correo']; ?></td>
                    <td><?php echo $reg['Celular']; ?></td>
                    <td>
                        <a href="createPersonas.php?edit=<?php echo $reg['IdPersona']; ?>" class="btn btn-success" >Ver/Editar</a>
                    </td>
                    <td>
                        <a href="personaBD.php?del=<?php echo $reg['IdPersona']; ?>" class="btn btn-danger">Eliminar</a>
                    </td>
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