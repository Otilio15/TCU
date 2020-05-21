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
	$IdPersona = $_GET['edit'];
	$edit_state = true;

	$sql="select * from users where IdUser= $IdUser";
	mysqli_set_charset($bdc,"utf-8");
	$results = mysqli_query($bdc, $sql);
	 while ($reg = mysqli_fetch_array($results)) {
		$Email = $reg['Email'];
        $Clave = $reg['Clave'];
        $IdRol = $reg['IdRol'];
	 }
	
}
?>
<?php 
$sql="SELECT Rol FROM roles";
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

	   
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <body>


 <div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h2 class="m-0 font-weight-bold text-primary">Usuarios</h2>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col">Email</th>
            <th scope="col">Rol</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th scope="col">Email</th>
            <th scope="col">Rol</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </tfoot>
        <tbody>
            <?php while ($reg = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td><?php echo $reg['Email']; ?></td>
                                        
                        <td><?php if ($reg['IdRol']==1) {
                           echo "Admin"; } else {echo "User";}?>
                        </td>
                                    
                        <td>
                           <a href="createUsers.php?edit=<?php echo $reg['IdUser']; ?>" class="btn btn-success" >Editar</a>
                        </td>
                        <td>
                           <a href="userBD.php?del=<?php echo $reg['IdUser']; ?>" class="btn btn-danger">Eliminar</a>
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
</body>